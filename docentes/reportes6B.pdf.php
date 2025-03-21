<?php
require_once('../recursos/fpdf/fpdf.php');

function codificarUTF8($cadena){
    return mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
}

class BoletaEvaluacion extends FPDF
{
    function Header()
    {
        $this->SetTitle(codificarUTF8('Boleta de Evaluación | Colegio Juan Pablo II'));
        $this->SetAuthor(codificarUTF8('Colegio Juan Pablo II'));
        $this->SetSubject(codificarUTF8('Boleta de Evaluación'));
        $this->SetKeywords(codificarUTF8('Boleta, Evaluación, Escuela'));

        $this->Image('../imagenes/logo.jpeg', 10, 6, 30, 30); // Ajustar posición y tamaño del logo
        $this->SetX(50);
        $this->SetFont('Times', 'B', 14); // Reducir tamaño de fuente
        $this->Cell(0, 6, codificarUTF8('SISTEMA EDUCATIVO NACIONAL'), 0, 1, 'C');
        $this->Cell(0, 6, codificarUTF8('EDUCACIÓN PRIMARIA'), 0, 1, 'C');
        $this->Cell(0, 6, codificarUTF8('BOLETA DE EVALUACIÓN DE 2024-2025'), 0, 1, 'C');
        $this->Ln(2); // Reducir espacio

        $this->SetFont('Arial', 'B', 10); // Reducir tamaño de fuente
        $this->Cell(0, 6, codificarUTF8('ESCUELA: COLEGIO JUAN PABLO II'), 0, 1, 'L');
        $this->Cell(0, 6, codificarUTF8('CLAVE: 13PPR0306X'), 0, 1, 'L');
        $this->Cell(0, 6, codificarUTF8('PERIODO: ' . $_POST['periodo']), 0, 1, 'L');
        $this->Cell(0, 6, codificarUTF8('GRADO:6 ' . $this->gradoAlumno . ' GRUPO:B ' . $this->grupoAlumno), 0, 1, 'L'); // Mostrar grado y grupo
        $this->Ln(2); // Reducir espacio
    }

    function Contenido()
    {
        include '../bd/conexion.php';

        $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
        $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : null;

        if (!$matricula || !$periodo) {
            $this->Cell(0, 10, "Error: Falta información en la solicitud.", 0, 1, 'C');
            return;
        }

        // Consulta SQL para obtener las calificaciones, nombre, grado, grupo y observaciones del alumno
        $stmt = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom,
                                    alumnos.Grado, alumnos.Grupo, campos.campo, campos.campo_formativo, 
                                    calificaciones.calificacion, calificaciones.observaciones
                                    FROM calificaciones
                                    INNER JOIN alumnos ON calificaciones.Id_alumno = alumnos.Id_alumno
                                    INNER JOIN campos ON calificaciones.id_asignatura = campos.id_asignatura
                                    WHERE alumnos.Matricula = ? AND calificaciones.id_periodo = ?
                                    ORDER BY campos.campo, campos.campo_formativo");

        $stmt->bind_param("si", $matricula, $periodo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            $this->Cell(0, 10, "No se encontraron calificaciones para la matrícula seleccionada.", 0, 1, 'C');
            return;
        }

        $datos = []; // Almacenará las calificaciones y observaciones agrupadas por campo
        $nombreAlumno = ''; // Almacenará el nombre completo del alumno
        $this->gradoAlumno = ''; // Almacenará el grado del alumno
        $this->grupoAlumno = ''; // Almacenará el grupo del alumno

        while ($row = $resultado->fetch_assoc()) {
            // Obtener el nombre completo del alumno
            if (empty($nombreAlumno)) {
                $nombreAlumno = $row['Apellidop'] . ' ' . $row['Apellidom'] . ' ' . $row['Nombre'];
                $this->gradoAlumno = $row['Grado']; // Obtener el grado del alumno
                $this->grupoAlumno = $row['Grupo']; // Obtener el grupo del alumno
            }

            $campo = $row['campo']; // Campo formativo (por ejemplo, "Lenguajes")
            $calificacion = $row['calificacion'];
            $observacion = $row['observaciones']; // Obtener la observación del docente

            if (!isset($datos[$campo])) {
                $datos[$campo] = [
                    'calificaciones' => [],
                    'observaciones' => []
                ];
            }
            $datos[$campo]['calificaciones'][] = $calificacion; // Agregar calificación al campo correspondiente
            $datos[$campo]['observaciones'][] = $observacion; // Agregar observación al campo correspondiente
        }

        // Mostrar encabezados de la tabla
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, codificarUTF8("ALUMNO: " . $nombreAlumno), 0, 1, 'L'); // Mostrar el nombre del alumno
        $this->Ln(2); // Reducir espacio

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(50, 6, codificarUTF8("Campo Formativo"), 1, 0, 'C');
        $this->Cell(30, 6, codificarUTF8("Promedio"), 1, 0, 'C');
        $this->Cell(200, 6, codificarUTF8("Observaciones del Docente"), 1, 0, 'C');
        $this->Ln(6);

        // Mostrar datos del alumno
        $sumaCalificacionesGenerales = 0;
        $numCalificacionesGenerales = 0;

        foreach ($datos as $campo => $info) {
            $calificaciones = $info['calificaciones']; // Calificaciones del campo
            $observaciones = $info['observaciones']; // Observaciones del campo

            $sumaCalificaciones = array_sum($calificaciones); // Sumar calificaciones del campo
            $numCalificaciones = count($calificaciones); // Contar calificaciones del campo
            $promedioCampo = ($numCalificaciones > 0) ? number_format($sumaCalificaciones / $numCalificaciones, 2) : '-';

            // Mostrar el campo formativo y su promedio
            $this->SetFont('Arial', '', 8);
            $this->Cell(50, 6, codificarUTF8($campo), 1);
            $this->Cell(30, 6, $promedioCampo, 1, 0, 'C');

            // Mostrar observaciones usando MultiCell para manejar texto largo
            $observacionesTexto = !empty($observaciones) ? implode(" ", $observaciones) : '';
            $this->SetXY(90, $this->GetY()); // Posicionar el cursor en la columna de observaciones
            $this->MultiCell(200, 4, codificarUTF8($observacionesTexto), 1); // Mostrar observaciones
            $this->SetXY(10, $this->GetY()); // Restaurar la posición X para la siguiente fila

            // Acumular para el promedio general
            if (is_numeric($promedioCampo)) {
                $sumaCalificacionesGenerales += floatval($promedioCampo);
                $numCalificacionesGenerales++;
            }
        }

        // Calcular el promedio general
        $promedioGeneral = ($numCalificacionesGenerales > 0) ? number_format($sumaCalificacionesGenerales / $numCalificacionesGenerales, 2) : '-';

        // Mostrar el promedio general en una fila adicional
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(50, 4, codificarUTF8("PROMEDIO GENERAL"), 1, 0, 'C');
        $this->Cell(30, 4, $promedioGeneral, 1, 0, 'C');
        $this->Cell(200, 6, '', 0); // Celda vacía para observaciones
        $this->Ln(6);

        // Mostrar la tabla de la imagen
        $this->Ln(4); // Reducir espacio
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 6, codificarUTF8("INNOVAMA T"), 0, 1, 'C');
        $this->Ln(2); // Reducir espacio

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(50, 6, codificarUTF8("Semáforo"), 1, 0, 'C');
        $this->Cell(50, 6, codificarUTF8("TRABAJO EN CASA"), 1, 0, 'C');
        $this->Cell(50, 6, codificarUTF8("TRABAJO EN AULA"), 1, 0, 'C');
        $this->Ln(6);

        // NO REALIZO LA ACTIVIDAD (Rojo)
        $this->SetFillColor(255, 0, 0); // Rojo
        $this->Cell(50, 6, codificarUTF8("NO REALIZO LA ACTIVIDAD"), 1, 0, 'C', true);
        $this->Cell(50, 6, '', 1, 0, 'C', false);
        $this->Cell(50, 6, '', 1, 0, 'C', false);
        $this->Ln(6);

        // ACTIVIDAD INCOMPLETA (Amarillo)
        $this->SetFillColor(255, 255, 0); // Amarillo
        $this->Cell(50, 6, codificarUTF8("ACTIVIDAD INCOMPLETA"), 1, 0, 'C', true);
        $this->Cell(50, 6, '', 1, 0, 'C', false);
        $this->Cell(50, 6, '', 1, 0, 'C', false);
        $this->Ln(6);

        // ACTIVIDAD COMPLETA (Verde)
        $this->SetFillColor(0, 255, 0); // Verde
        $this->Cell(50, 6, codificarUTF8("ACTIVIDAD COMPLETA"), 1, 0, 'C', true);
        $this->Cell(50, 6, '', 1, 0, 'C', false);
        $this->Cell(50, 6, '', 1, 0, 'C', false);
        $this->Ln(6);

        // Firmas y sellos
        $this->Ln(10); // Espacio antes de la sección de firmas y sellos
        $this->SetFont('Arial', 'B', 10);

        // Columna izquierda: Nombre y firma del director
        $this->SetX(10); // Mover a la izquierda (posición X = 10)
        $this->Cell(80, 10, codificarUTF8("NOMBRE Y FIRMA DEL DIRECTOR"), 0, 0, 'L');
        $this->Ln(6); // Espacio antes de "LUIS ALBERTO ANGELES CARRASCO"
        $this->SetX(10); // Mover a la izquierda (posición X = 10)
        $this->Cell(80, 6, codificarUTF8("LUIS ALBERTO ANGELES CARRASCO"), 0, 1, 'L');
        $this->Ln(4); // Espacio después de "LUIS ALBERTO ANGELES CARRASCO"

        // Columna central: Lugar de expedición
        $this->SetX(($this->GetPageWidth() - 80) / 2); // Centrar en la página
        $this->Cell(80, -20, codificarUTF8("IXMIQUILPAN HIDALGO, LUGAR DE EXPEDICIÓN"), 0, 1, 'C');
        $this->Ln(4); // Espacio entre secciones

        // Columna derecha: Firma del profesor y sello
        $this->SetX($this->GetPageWidth() - 90); // Mover a la derecha (posición X = ancho de la página - 90)
        $this->Cell(80, 10, codificarUTF8("FIRMA DEL PROFESOR"), 0, 1, 'R');
        $this->SetX($this->GetPageWidth() - 90); // Mover a la derecha (posición X = ancho de la página - 90)
        $this->Cell(80, 4, codificarUTF8("SELLO"), 0, 1, 'R');
    }

    function Footer()
    {
        $this->SetY(-15); // Ajustar posición del pie de página
        $this->SetLineWidth(1.5);
        $this->SetDrawColor(38, 61, 29);
        $this->Line(10, $this->GetY(), $this->GetPageWidth() - 10, $this->GetY());

        $this->SetFont('Arial', 'B', 8); // Reducir tamaño de fuente
        $this->Cell(0, 6, codificarUTF8('Colegio Juan Pablo II'), 0, 1, 'C');
    }
}

// Crear el PDF
$boleta = new BoletaEvaluacion('L');
$boleta->AddPage();
$boleta->Contenido();
ob_clean(); // Limpia cualquier salida previa
$boleta->Output('boleta_evaluacion.pdf', 'I');
?>