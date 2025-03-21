<?php
require_once('../recursos/fpdf/fpdf.php');

function codificarUTF8($cadena){
    return mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
}

class ReporteCalificaciones extends FPDF
{
    function Header()
    {
        $this->SetTitle(codificarUTF8('Reporte de Calificaciones | Colegio Juan Pablo II'));
        $this->SetAuthor(codificarUTF8('Colegio Juan Pablo II'));
        $this->SetSubject(codificarUTF8('Reporte'));
        $this->SetKeywords(codificarUTF8('Calificaciones, Reporte, Escuela'));

        $this->Image('../imagenes/logo.jpeg', 10, 6, 25, 30); // Ajustar posición y tamaño del logo
        $this->SetX(40); // Ajustar posición del título
        $this->SetFont('Times', 'B', 14); // Reducir tamaño de la fuente del título
        $this->Cell(0, 6, codificarUTF8('Colegio Juan Pablo II'), 0, 1, 'C');
        $this->Ln(5); // Reducir espacio después del título

        $this->SetX(40);
        $this->SetFont('Arial', 'B', 12); // Reducir tamaño de la fuente del subtítulo
        $this->Cell(0, 6, codificarUTF8('REPORTE DE CALIFICACIONES - GRADO 1 (GRUPO A)'), 0, 1, 'C');
        $this->Ln(8); // Reducir espacio después del subtítulo
    }

    function Contenido()
    {
        include '../bd/conexion.php';

        // Validar que los datos POST existen
        $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : null;

        if (!$periodo) {
            $this->Cell(0, 10, "Error: Falta información en la solicitud.", 0, 1, 'C');
            return;
        }

        // Consulta SQL para obtener las calificaciones del grado 1 y grupo A usando la tabla prescolar
        $stmt = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom,
                                    campos.campo_formativo, prescolar.calificacion
                                    FROM prescolar
                                    INNER JOIN alumnos ON prescolar.id_alumno = alumnos.Id_alumno
                                    INNER JOIN campos ON prescolar.id_asignatura = campos.id_asignatura
                                    WHERE alumnos.grado = 1 AND prescolar.id_periodo = ? AND alumnos.grupo = 'A'
                                    ORDER BY alumnos.Apellidop, alumnos.Apellidom, campos.campo_formativo");

        $stmt->bind_param("i", $periodo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            $this->Cell(0, 10, "No se encontraron calificaciones para el grado 1 (Grupo A) en el trimestre seleccionado.", 0, 1, 'C');
            return;
        }

        $alumnos = [];
        $asignaturas = [];

        // Organizar los datos por alumno
        while ($row = $resultado->fetch_assoc()) {
            $matricula = $row['Matricula'];
            $nombreCompleto = "{$row['Apellidop']} {$row['Apellidom']} {$row['Nombre']}";
            $asignatura = $row['campo_formativo'];
            $calificacion = $row['calificacion'];

            if (!isset($alumnos[$matricula])) {
                $alumnos[$matricula] = [
                    'Nombre' => $nombreCompleto,
                    'Calificaciones' => []
                ];
            }

            $alumnos[$matricula]['Calificaciones'][$asignatura] = $calificacion;

            if (!in_array($asignatura, $asignaturas)) {
                $asignaturas[] = $asignatura;
            }
        }

        // Mostrar encabezados de la tabla
        $this->SetFont('Arial', 'B', 7); // Reducir tamaño de la fuente
        $this->SetX(10);
        $this->Cell(15, 6, codificarUTF8("Matrícula"), 1, 0, 'C'); // Reducir ancho de la celda
        $this->Cell(50, 6, codificarUTF8("Nombre"), 1, 0, 'C'); // Reducir ancho de la celda

        foreach ($asignaturas as $asignatura) {
            $this->Cell(20, 6, codificarUTF8($asignatura), 1, 0, 'C'); // Reducir ancho de la celda
        }

        $this->Cell(15, 6, codificarUTF8("Promedio"), 1, 0, 'C'); // Reducir ancho de la celda
        $this->Ln(6);

        // Mostrar datos de los alumnos
        $this->SetFont('Arial', '', 7); // Reducir tamaño de la fuente
        foreach ($alumnos as $matricula => $datos) {
            $this->SetX(10);
            $this->Cell(15, 6, $matricula, 1); // Reducir ancho de la celda
            $this->Cell(50, 6, codificarUTF8($datos['Nombre']), 1); // Reducir ancho de la celda

            $sumaCalificaciones = 0;
            $numCalificaciones = 0;

            foreach ($asignaturas as $asignatura) {
                $calificacion = isset($datos['Calificaciones'][$asignatura]) ? $datos['Calificaciones'][$asignatura] : '-';
                $this->Cell(20, 6, $calificacion, 1, 0, 'C'); // Reducir ancho de la celda

                if (is_numeric($calificacion)) {
                    $sumaCalificaciones += floatval($calificacion);
                    $numCalificaciones++;
                }
            }

            $promedio = ($numCalificaciones > 0) ? number_format($sumaCalificaciones / $numCalificaciones, 2) : '-';
            $this->Cell(15, 6, $promedio, 1, 0, 'C'); // Reducir ancho de la celda
            $this->Ln(6);
        }
    }

    function Footer()
    {
        $this->SetY(-20);
        $this->SetLineWidth(1.5);
        $this->SetDrawColor(38, 61, 29);
        $this->Line(12, $this->GetY(), $this->GetPageWidth() - 6, $this->GetY());

        $this->Ln(1);
        $this->SetFont('Arial', 'B', 7); // Reducir tamaño de la fuente
        $this->Cell(0, 6, codificarUTF8('.'), 0, 1, 'C');

        $this->SetY(-15);
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(0, 0, 0);
        $this->Cell(0, 6, codificarUTF8('.'), 0, 1, 'C');
    }
}

// Crear el PDF (sin mostrar nada en pantalla antes de `Output`)
$reporte = new ReporteCalificaciones('L'); // Orientación horizontal
$reporte->AddPage();
$reporte->Contenido();
ob_clean(); // Limpia cualquier salida previa
$reporte->Output('reporte_prescolar_grado1.pdf', 'I');
?>