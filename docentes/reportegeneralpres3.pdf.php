<?php
require_once('../recursos/fpdf/fpdf.php');

function codificarUTF8($cadena) {
    return mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
}

class ReporteGrado3 extends FPDF
{
    function Header()
    {
        $this->SetTitle(codificarUTF8('Reporte de Evaluaciones | Colegio Juan Pablo II'));
        $this->SetAuthor(codificarUTF8('Colegio Juan Pablo II'));
        $this->SetSubject(codificarUTF8('Reporte'));
        $this->SetKeywords(codificarUTF8('Evaluaciones, Reporte, Escuela'));
        
        $this->Image('../imagenes/logo.jpeg', 17, 6, 30, 35);
        $this->SetX(60); 
        $this->SetFont('times', 'B', 16);
        $this->Cell(0, 6, codificarUTF8('Colegio Juan Pablo II'), 0, 1, 'C');
        
        $this->SetX(60); 
        $this->SetLineWidth(1.5);
        $this->SetDrawColor(38, 61, 29);
        $this->Line(60, $this->GetY() + 4, $this->GetPageWidth() - 6, $this->GetY() + 4);
        $this->Ln(8);
        
        $this->SetX(60); 
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 6, codificarUTF8('REPORTE DE EVALUACIONES - GRADO 3'), 0, 1, 'C');
        $this->Ln(12);
    }

    function Contenido()
    {
        include '../bd/conexion.php';

        if (!isset($_POST['periodo'])) {
            $this->Cell(0, 10, "Error: No se proporcionó el período.", 0, 1, 'C');
            return;
        }

        $periodo = $_POST['periodo'];

        // Consulta SQL para obtener las calificaciones desde la tabla prescolar
        $vista = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, 
                                            campos.campo_formativo, prescolar.calificacion
                                     FROM prescolar
                                     INNER JOIN alumnos ON prescolar.id_alumno = alumnos.id_alumno
                                     INNER JOIN campos ON prescolar.id_asignatura = campos.id_asignatura
                                     WHERE alumnos.grado = 3 AND prescolar.id_periodo = ?
                                     ORDER BY alumnos.Apellidop, alumnos.Apellidom, campos.campo_formativo");
        $vista->bind_param('i', $periodo);
        $vista->execute();
        $resultado = $vista->get_result();

        if ($resultado->num_rows === 0) {
            $this->Cell(0, 10, "No se encontraron calificaciones para el grado 3 en el trimestre seleccionado.", 0, 1, 'C');
            return;
        }

        $alumnos = [];
        $asignaturas = [];

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
        $this->SetFont('Arial', 'B', 8);
        $this->SetX(10);
        $this->Cell(20, 6, codificarUTF8("Matrícula"), 1, 0, 'C');
        $this->Cell(60, 6, codificarUTF8("Nombre"), 1, 0, 'C'); // Reducir el ancho de la celda del nombre

        foreach ($asignaturas as $asignatura) {
            $this->Cell(20, 6, codificarUTF8($asignatura), 1, 0, 'C'); // Reducir el ancho de las celdas de las asignaturas
        }

        $this->Cell(20, 6, codificarUTF8("Promedio"), 1, 0, 'C');
        $this->Ln(6);

        // Mostrar datos de los alumnos
        $this->SetFont('Arial', '', 8);
        foreach ($alumnos as $matricula => $datos) {
            $this->SetX(10);
            $this->Cell(20, 6, $matricula, 1);
            $this->Cell(60, 6, codificarUTF8($datos['Nombre']), 1); // Reducir el ancho de la celda del nombre

            $sumaCalificaciones = 0;
            $numCalificaciones = 0;

            foreach ($asignaturas as $asignatura) {
                $calificacion = isset($datos['Calificaciones'][$asignatura]) ? $datos['Calificaciones'][$asignatura] : '-';
                $this->Cell(20, 6, $calificacion, 1, 0, 'C'); // Reducir el ancho de las celdas de las calificaciones

                if (is_numeric($calificacion)) {
                    $sumaCalificaciones += floatval($calificacion);
                    $numCalificaciones++;
                }
            }

            $promedio = ($numCalificaciones > 0) ? number_format($sumaCalificaciones / $numCalificaciones, 2) : '-';
            $this->Cell(20, 6, $promedio, 1, 0, 'C');
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
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 6, codificarUTF8('.'), 0, 1, 'C');
        $this->SetY(-15);
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(0, 0, 0);
    }
}

// Crear el PDF
$reporte = new ReporteGrado3('L');
$reporte->AddPage();
$reporte->Contenido();
ob_clean(); // Limpia cualquier salida previa
$reporte->Output('reporte_grado3_general.pdf', 'I');
?>