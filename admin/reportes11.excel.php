<?php
ob_start(); // Inicia el almacenamiento en búfer
require '../vendor/autoload.php'; // PhpSpreadsheet
include 'bd/conexion.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font;

if (isset($_POST['periodo'])) {
    $periodo = $_POST['periodo'];
    //$grado1 = $_POST['grado1'];

    // Consulta a la base de datos
    $stmt = $conexion->prepare(" 
        SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, 
               campos.campo_formativo, secu.calificaciones
        FROM secu
        INNER JOIN alumnos ON secu.id_alumnos = alumnos.Id_alumno
        INNER JOIN campos ON secu.id_asignaturas = campos.id_asignatura 
        WHERE alumnos.grado = 1 AND secu.id_periodos = ? 
        ORDER BY alumnos.Apellidop, campos.id_asignatura
    ");
    $stmt->bind_param("i", $periodo);
    $stmt->execute();
    $result = $stmt->get_result();
    $datos = $result->fetch_all(MYSQLI_ASSOC); // Guardamos todos los datos en un array

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
    $sheet->mergeCells("A1:O1");
    $sheet->setCellValue("A1", "COLEGIO JUAN PABLO II    1°    SECUNDARIA");
    $sheet->getStyle("A1")->getFont()->setSize(14);
    $sheet->getStyle("A1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Segunda fila: agrupar celdas por grupos de materias
    $sheet->mergeCells("C2:F2");
    $sheet->mergeCells("G2:I2");
    $sheet->mergeCells("J2:L2");
    $sheet->mergeCells("M2:O2");

    // Agregar saltos de línea en el texto de las celdas fusionadas
    $sheet->setCellValue("C2", "LENGUAJES");
    $sheet->setCellValue("G2", "SABERES Y\n PENSAMIENTOS\nCIENTÍFICO");
    $sheet->setCellValue("J2", "ÉTICA\nNATURALEZA Y\n SOCIEDAD");
    $sheet->setCellValue("M2", "DE LO HUMANO Y LO\nCOMUNITARIO");

    // Configurar el ajuste de texto para que el salto de línea se vea correctamente
    foreach (["C2", "G2", "J2", "M2"] as $cell) {
        $sheet->getStyle($cell)->getAlignment()->setWrapText(true); // Ajuste de texto
        $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrado horizontal
        $sheet->getStyle($cell)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);   // Centrado vertical
    }

    // Aplicar estilo a los títulos de la segunda fila
    foreach (["C2", "G2", "J2", "M2"] as $cell) {
        $sheet->getStyle($cell)->getFont()->setSize(11);
        $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    // Encabezados de la tercera fila (Nombre de materias y promedios)
    $sheet->setCellValue('A3', 'No.');
    $sheet->setCellValue('B3', 'Nombre');

    $col = 'C';
    for ($i = 0; $i < count($asignaturas); $i++) {
        $sheet->setCellValue($col . '3', $asignaturas[$i]);
        $col++;

        if ($i == 2) {
            $sheet->setCellValue($col . '3', 'Promedio');
            $col++;
        } elseif ($i == 4) {
            $sheet->setCellValue($col . '3', 'Promedio');
            $col++;
        } elseif ($i == 6) {
            $sheet->setCellValue($col . '3', 'Promedio');
            $col++;
        }elseif ($i == 8) {
            $sheet->setCellValue($col . '3', 'Promedio');
            $col++;
        }
    }

    /*if (count($asignaturas) >= 4) {
        $sheet->setCellValue($col . '3', 'Promedio');
        $col++;
    }*/

    // Agregar datos de alumnos y calificaciones
    $fila = 4;
    $contador = 1;
    $alumno_actual = '';

    // Agregar los datos de los alumnos correctamente
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
                    $calificaciones[$cal_row['campo_formativo']] = floatval($cal_row['calificaciones']);
                }
            }

            $col = 'C';
            $valores = array_values($calificaciones);
            $totalMaterias = count($valores);
            $sumaTotal = 0;
            $numMateriasTotal = 0;

            for ($i = 0; $i < $totalMaterias; $i++) {
                $sheet->setCellValue($col . $fila, $valores[$i]);
                if (!is_null($valores[$i])) {
                    $sumaTotal += $valores[$i];
                    $numMateriasTotal++;
                }
                $col++;

                if ($i == 2) {
                    $promedio1 = ($totalMaterias >= 3) ? ( ($valores[0] + $valores[1] + $valores[2]) / 3 ) : null;
                    $sheet->setCellValue($col . $fila, number_format($promedio1, 2));
                    $col++;
                } elseif ($i == 4) {
                    $promedio2 = ($totalMaterias >= 5) ? ( ($valores[3] + $valores[4]) / 2 ) : null;
                    $sheet->setCellValue($col . $fila, number_format($promedio2, 2));
                    $col++;
                } elseif ($i == 6) {
                    $promedio3 = ($totalMaterias >= 7) ? ( ($valores[5] + $valores[6]) / 2 ) : null;
                    $sheet->setCellValue($col . $fila, number_format($promedio3, 2));
                    $col++;
                }elseif ($i == 8) {
                    $promedio3 = ($totalMaterias >= 9) ? ( ($valores[7] + $valores[8]) / 2 ) : null;
                    $sheet->setCellValue($col . $fila, number_format($promedio3, 2));
                    $col++;
                }
            }

            /*if ($totalMaterias >= 4) {
                $sumaUltimas4 = 0;
                $numUltimas4 = 0;
                for ($i = max(0, $totalMaterias - 4); $i < $totalMaterias; $i++) {
                    if (!is_null($valores[$i])) {
                        $sumaUltimas4 += $valores[$i];
                        $numUltimas4++;
                    }
                }
                $promedioUltimas4 = ($numUltimas4 > 0) ? ($sumaUltimas4 / $numUltimas4) : null;
                $sheet->setCellValue($col . $fila, number_format($promedioUltimas4, 2));
                $col++;
            }*/

            $fila++;
            $contador++;
        }
    }

    // Ajustar automáticamente el ancho de las columnas
    foreach (range('A', 'B') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    $sheet->getRowDimension(2)->setRowHeight(45);
    $sheet->getRowDimension(1)->setRowHeight(50);

    // Aplicar orientación vertical a los encabezados de C3 a Q3
    $sheet->getStyle('C3:O3')->getAlignment()->setTextRotation(90);
    $sheet->getStyle('C3:O3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C3:O3')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle('C:O')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C:O')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle('A3:B3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1:O1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1:O1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    // Aplicar bordes azules a toda la tabla
    $rangoTabla = "A1:O" . ($fila - 1); // Rango de la tabla
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN, // Estilo de borde (delgado)
                'color' => ['rgb' => '0000FF'], // Color azul (código hexadecimal)
            ]
        ]
    ];
    $sheet->getStyle($rangoTabla)->applyFromArray($styleArray);

    $stmt->close();
    $conexion->close();
    ob_clean();

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte_Trimestre_'.$periodo.'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    ob_end_flush();
    exit;
} else {
    echo "Datos insuficientes para generar el reporte.";
}
?>