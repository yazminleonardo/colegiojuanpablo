<?php
ob_start(); // Inicia el almacenamiento en búfer
require '../vendor/autoload.php'; // PhpSpreadsheet
include 'bd/conexion.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

if (isset($_POST['periodo'])) {
    $periodo = $_POST['periodo'];

    // Consulta a la base de datos
    $stmt = $conexion->prepare(" 
        SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, 
               campos.campo_formativo, prescolar.calificacion
        FROM prescolar
        INNER JOIN alumnos ON prescolar.Id_alumno = alumnos.Id_alumno
        INNER JOIN campos ON prescolar.id_asignatura = campos.id_asignatura 
        WHERE alumnos.grado = 2 AND prescolar.id_periodo = ?
        ORDER BY alumnos.Apellidop, campos.id_asignatura
    ");
    $stmt->bind_param("i", $periodo);
    $stmt->execute();
    $result = $stmt->get_result();
    $datos = $result->fetch_all(MYSQLI_ASSOC);

    // Crear archivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Obtener asignaturas únicas
    $asignaturas = [];
    foreach ($datos as $row) {
        if (!in_array($row['campo_formativo'], $asignaturas)) {
            $asignaturas[] = $row['campo_formativo'];
        }
    }

    // Primera fila: título del colegio
    $sheet->mergeCells("A1:K1");
    $sheet->setCellValue("A1", "COLEGIO JUAN PABLO II    MATERNAL    PREESCOLAR");
    $sheet->getStyle("A1")->getFont()->setSize(14);
    $sheet->getStyle("A1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle("A1")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);

    // Encabezados de la tabla
    $sheet->setCellValue('A2', 'No.');
    $sheet->setCellValue('B2', 'Nombre');
    $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $col = 'C';
    foreach ($asignaturas as $asignatura) {
        $sheet->setCellValue($col . '2', $asignatura);
        $col++;
    }

    // Aplicar estilos a los encabezados
    //$sheet->getStyle('A2:I2')->getFont()->setBold(true);
    $sheet->getStyle('A2:K2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A2:K2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle('A:B')->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $sheet->getRowDimension(1)->setRowHeight(50);
    $sheet->getRowDimension(2)->setRowHeight(20);


    // Agregar datos de alumnos y calificaciones
    $fila = 3;
    $contador = 1;
    $alumno_actual = '';

    foreach ($datos as $row) {
        if ($row['Matricula'] != $alumno_actual) {
            $sheet->setCellValue('A' . $fila, $contador);
            $sheet->setCellValue('B' . $fila, $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre']);
            $alumno_actual = $row['Matricula'];

            $calificaciones = [];
            foreach ($asignaturas as $asignatura) {
                $calificaciones[$asignatura] = null;
            }

            foreach ($datos as $cal_row) {
                if ($cal_row['Matricula'] == $alumno_actual) {
                    $calificaciones[$cal_row['campo_formativo']] = $cal_row['calificacion'];
                }
            }

            $col = 'C';
            foreach ($calificaciones as $calificacion) {
                $sheet->setCellValue($col . $fila, $calificacion);
                $col++;
            }

            $fila++;
            $contador++;
        }
    }

    // Ajustar el ancho de las columnas C a I
    $columnasAnchoFijo = ['C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
    foreach ($columnasAnchoFijo as $columna) {
        $sheet->getColumnDimension($columna)->setWidth(30); // Establecer un ancho reducido para estas columnas
    }

    // Aplicar formato de texto justificado y permitir saltos de línea solo para las columnas C a I
    $sheet->getStyle('C3:K' . ($fila - 1))
        ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_JUSTIFY);
    $sheet->getStyle('C3:K' . ($fila - 1))
        ->getAlignment()->setWrapText(true);

    // Aplicar bordes a la tabla hasta la columna I
    $rangoTabla = "A1:K" . ($fila - 1);
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '0000FF'],
            ]
        ]
    ];
    $sheet->getStyle($rangoTabla)->applyFromArray($styleArray);

    // Ajustar automáticamente el ancho de las columnas
    foreach (range('A', 'B') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Cerrar conexiones
    $stmt->close();
    $conexion->close();
    ob_clean();

    // Enviar el archivo Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte_Trimestre_' . $periodo . '.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    ob_end_flush();
    exit;
} else {
    echo "Datos insuficientes para generar el reporte.";
}
?>