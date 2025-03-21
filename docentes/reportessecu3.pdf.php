<?php
require_once('../recursos/fpdf/fpdf.php');

function codificarUTF8($cadena){
    return mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
}

class CertificadoMedico extends FPDF {
    function Header() {
        $this->SetTitle(codificarUTF8('Reporte de Calificaciones | Colegio Juan Pablo II'));
        $this->SetAuthor(codificarUTF8('Colegio Juan Pablo II'));
        $this->SetSubject(codificarUTF8('Reporte'));
        $this->SetKeywords(codificarUTF8('Calificaciones, Reporte, Escuela'));

        $this->Image('../imagenes/logo.jpeg', 17, 6, 30, 35);
        $this->SetX(60);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 6, codificarUTF8('Colegio Juan Pablo II'), 0, 1, 'C');
        $this->Ln(8);

        $this->SetX(60);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 6, codificarUTF8('REPORTE DE CALIFICACIONES'), 0, 1, 'C');
        $this->Ln(12);
    }

    function Contenido() {
        include '../bd/conexion.php';

        error_log("Datos recibidos: " . print_r($_POST, true));

        $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
        $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : null;

        if (!$matricula || !$periodo) {
            $this->Cell(0, 10, "Error: Falta información en la solicitud.", 0, 1, 'C');
            return;
        }

        // Consulta SQL para obtener las calificaciones
        $stmt = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, alumnos.Grado,
                                    campos.campo, campos.campo_formativo, secu.calificaciones, secu.id_periodos
                                    FROM secu
                                    INNER JOIN alumnos ON secu.id_alumnos = alumnos.Id_alumno
                                    INNER JOIN campos ON secu.id_asignaturas = campos.id_asignatura
                                    WHERE alumnos.Matricula = ?
                                    ORDER BY campos.campo, campos.campo_formativo");

        $stmt->bind_param("s", $matricula);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            $this->Cell(0, 10, "No se encontraron calificaciones para la matrícula seleccionada.", 0, 1, 'C');
            return;
        }

        $datos = []; // Almacenará las calificaciones agrupadas por materia y periodo
        $nombreAlumno = ''; // Almacenará el nombre completo del alumno
        $gradoAlumno = ''; // Almacenará el grado del alumno
        $trimestresCalificados = []; // Almacenará los trimestres que tienen calificaciones

        while ($row = $resultado->fetch_assoc()) {
            // Obtener el nombre completo del alumno
            if (empty($nombreAlumno)) {
                $nombreAlumno = $row['Apellidop'] . ' ' . $row['Apellidom'] . ' ' . $row['Nombre'];
                $gradoAlumno = $row['Grado']; // Obtener el grado del alumno
            }

            $campo = $row['campo']; // Campo (por ejemplo, "Lenguajes")
            $materia = $row['campo_formativo']; // Materia (por ejemplo, "Español")
            $calificacion = $row['calificaciones'];
            $periodo = $row['id_periodos']; // Periodo (1, 2, 3)

            // Mapear el periodo a texto (1ER, 2DO, 3ER)
            $periodoTexto = $this->mapearPeriodo($periodo);

            if (!isset($datos[$campo])) {
                $datos[$campo] = [];
            }
            if (!isset($datos[$campo][$materia])) {
                $datos[$campo][$materia] = ['1ER' => '-', '2DO' => '-', '3ER' => '-'];
            }
            $datos[$campo][$materia][$periodoTexto] = $calificacion; // Agregar calificación al periodo correspondiente

            // Registrar el trimestre si tiene calificación
            if ($calificacion != '-') {
                $trimestresCalificados[$periodoTexto] = true;
            }
        }

        // Mostrar encabezados de la tabla
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 0, codificarUTF8('BOLETA DE EVALUACION INTERNA'), 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 6, codificarUTF8('C.C.T. 13PES0191F'), 0, 1, 'C');
        $this->Cell(0, 6, codificarUTF8('CICLO ESCOLAR 2024-2025'), 0, 1, 'C');
        $this->Ln(5);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, codificarUTF8('Nombre del Alumno: ' . $nombreAlumno), 0, 1, 'L');
        $this->Cell(0, 0, codificarUTF8('Grado: ' . $gradoAlumno), 0, 1, 'L'); // Mostrar el grado del alumno
        $this->Ln(5);

        // Mostrar la tabla de calificaciones
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(10);
        $this->Cell(80, 8, codificarUTF8("Campo Formativo"), 1, 0, 'C');
        $this->Cell(50, 8, codificarUTF8("Materia"), 1, 0, 'C');

        // Mostrar solo los trimestres calificados
        $columnasTrimestres = [];
        if (isset($trimestresCalificados['1ER'])) {
            $this->Cell(30, 8, codificarUTF8("1ER"), 1, 0, 'C');
            $columnasTrimestres[] = '1ER';
        }
        if (isset($trimestresCalificados['2DO'])) {
            $this->Cell(30, 8, codificarUTF8("2DO"), 1, 0, 'C');
            $columnasTrimestres[] = '2DO';
        }
        if (isset($trimestresCalificados['3ER'])) {
            $this->Cell(30, 8, codificarUTF8("3ER"), 1, 0, 'C');
            $columnasTrimestres[] = '3ER';
        }

        $this->Cell(30, 8, codificarUTF8("PROMEDIO"), 1, 0, 'C');
        $this->Ln(8);

        // Mostrar datos del alumno
        $sumaCalificacionesGenerales = 0;
        $numCalificacionesGenerales = 0;

        foreach ($datos as $campo => $materias) {
            $primeraFila = true; // Bandera para controlar la primera fila de cada campo

            foreach ($materias as $materia => $calificaciones) {
                $this->SetFont('Arial', '', 10);

                // Mostrar el campo formativo solo en la primera fila del grupo
                if ($primeraFila) {
                    $this->SetX(10);
                    $this->Cell(80, 8, codificarUTF8($campo), 1);
                    $primeraFila = false;
                } else {
                    $this->SetX(10);
                    $this->Cell(80, 8, '', 1); // Dejar vacío para las filas siguientes
                }

                $this->Cell(50, 8, codificarUTF8($materia), 1);

                $sumaCalificaciones = 0;
                $numCalificaciones = 0;

                // Mostrar solo los trimestres calificados
                foreach ($columnasTrimestres as $trimestre) {
                    $calificacion = $calificaciones[$trimestre];
                    $this->Cell(30, 8, $calificacion, 1, 0, 'C');

                    if (is_numeric($calificacion)) {
                        $sumaCalificaciones += floatval($calificacion);
                        $numCalificaciones++;
                    }
                }

                // Calcular el promedio de la materia
                $promedioMateria = ($numCalificaciones > 0) ? number_format($sumaCalificaciones / $numCalificaciones, 1) : '-';
                $this->Cell(30, 8, $promedioMateria, 1, 0, 'C');
                $this->Ln(8);

                if (is_numeric($promedioMateria)) {
                    $sumaCalificacionesGenerales += floatval($promedioMateria);
                    $numCalificacionesGenerales++;
                }
            }
        }

        // Calcular y mostrar el promedio general
        $promedioGeneral = ($numCalificacionesGenerales > 0) ? number_format($sumaCalificacionesGenerales / $numCalificacionesGenerales, 1) : '-';
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(10);
        $this->Cell(170, 8, codificarUTF8("PROMEDIO FINAL"), 1, 0, 'C');
        $this->Cell(30, 8, $promedioGeneral, 1, 0, 'C');
        $this->Ln(8);
    }

    function Footer() {
        $this->SetY(-20);
        $this->SetLineWidth(1.5);
        $this->SetDrawColor(38, 61, 29);
        $this->Line(12, $this->GetY(), $this->GetPageWidth() - 6, $this->GetY());

        $this->Ln(1);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 6, codificarUTF8('Colegio Juan Pablo II'), 0, 1, 'C');

        $this->SetY(-15);
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(0, 0, 0);
        $this->Cell(0, 6, codificarUTF8('Calle Clavel 3, Ixmiquilpan, México'), 0, 1, 'C');
    }

    // Función para mapear el periodo numérico a texto
    function mapearPeriodo($periodo) {
        switch ($periodo) {
            case 1:
                return '1ER';
            case 2:
                return '2DO';
            case 3:
                return '3ER';
            default:
                return '-';
        }
    }
}

$certificado = new CertificadoMedico('L');
$certificado->AddPage();
$certificado->Contenido();
ob_clean();
$certificado->Output('reporte_calificaciones.pdf', 'I');
?>