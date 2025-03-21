<?php
require_once('../recursos/fpdf/fpdf.php');

function codificarUTF8($cadena){
    return mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
}

class CertificadoMedico extends FPDF
{
    function Header()
    {
        $this->SetTitle(codificarUTF8('Reporte de Calificaciones | Colegio Juan Pablo II'));
        $this->SetAuthor(codificarUTF8('Colegio Juan Pablo II'));
        $this->SetSubject(codificarUTF8('Reporte'));
        $this->SetKeywords(codificarUTF8('Calificaciones, Reporte, Escuela'));

        // Reducir márgenes
        $this->SetMargins(10, 10, 10); // Izquierda, Arriba, Derecha
        $this->SetAutoPageBreak(true, 10); // Margen inferior de 10

        $this->Image('../imagenes/logo.jpeg', 10, 6, 30, 35); // Ajustar posición de la imagen
        $this->SetX(50); // Ajustar posición del texto
        $this->SetFont('Times', 'B', 16);
        $this->Cell(0, 6, codificarUTF8('Colegio Juan Pablo II'), 0, 1, 'C');
        $this->Ln(3);  // Reducir el espacio después del título

        $this->SetX(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 6, codificarUTF8('REPORTE DE CALIFICACIONES'), 0, 1, 'C');
        $this->Ln(1);  // Reducir el espacio después del subtítulo

        // Obtener el periodo y el grado desde los datos POST
        $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : 'Periodo no especificado';
        $grado = 'Preescolar 3';  // Puedes cambiar esto según el grado del alumno

        // Mostrar el periodo y el grado
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, codificarUTF8("Periodo: $periodo"), 0, 1, 'C');
        $this->Cell(0, 6, codificarUTF8("Grado: $grado"), 0, 1, 'C');
        $this->Ln(1);  // Reducir el espacio después del periodo y grado
    }

    function MostrarDocenteYPadre()
    {
        // Verificar si hay suficiente espacio en la página actual
        if ($this->GetY() > 250) {  // Si no hay espacio, agregar una nueva página
            $this->AddPage();
        }

        $this->SetFont('Arial', 'B', 9);  // Reducir el tamaño de la fuente
        $this->SetX(10);  // Alinear a la izquierda
        $this->Cell(0, 25, codificarUTF8("Docente de grupo: ___________________________"), 0, 1, 'L');
        $this->SetX(100);  // Alinear a la izquierda
        $this->Cell(0, -23, codificarUTF8("Padre de familia y/o tutor: ___________________________"), 0, 1, 'L');
        $this->Ln(1);  // Espaciado después de la sección
    }

    function Contenido()
    {
        include '../bd/conexion.php';

        // Validar que los datos POST existen
        $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
        $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : null;

        if (!$matricula || !$periodo) {
            $this->Cell(0, 10, "Error: Falta información en la solicitud.", 0, 1, 'C');
            return;
        }

        // Consulta SQL para la tabla `prescolar`
        $stmt = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom,
                                    campos.campo_formativo, prescolar.calificacion
                                    FROM prescolar
                                    INNER JOIN alumnos ON prescolar.id_alumno = alumnos.id_alumno
                                    INNER JOIN campos ON prescolar.id_asignatura = campos.id_asignatura
                                    WHERE alumnos.Matricula = ? AND prescolar.id_periodo = ?
                                    ORDER BY campos.campo_formativo");

        $stmt->bind_param("si", $matricula, $periodo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            $this->Cell(0, 10, "No se encontraron calificaciones para la matrícula seleccionada.", 0, 1, 'C');
            return;
        }

        $asignaturas = [];
        $datos = [];

        // Recorrer los resultados para llenar los datos
        while ($row = $resultado->fetch_assoc()) {
            $asignatura = $row['campo_formativo'];
            $datos['Matricula'] = $row['Matricula'];
            $datos['Nombre'] = "{$row['Apellidop']} {$row['Apellidom']} {$row['Nombre']}";
            $datos['Calificaciones'][$asignatura] = $row['calificacion'];

            if (!in_array($asignatura, $asignaturas)) {
                $asignaturas[] = $asignatura;
            }
        }

        // Mostrar datos del alumno (nombre y matrícula)
        $this->SetFont('Arial', 'B', 9);  // Reducir el tamaño de la fuente
        $this->SetX(10);
        $this->Cell(0, 6, codificarUTF8("Nombre del alumno (a): " . $datos['Nombre']), 0, 1, 'L');
        $this->Ln(1);  // Reducir el espacio antes de la tabla

        // Mostrar encabezados de la tabla
        $this->SetFont('Arial', 'B', 9);  // Reducir el tamaño de la fuente
        $this->SetX(10);
        $this->Cell(60, 6, codificarUTF8("Campo"), 1, 0, 'C');  // Encabezado con fondo
        $this->Cell(130, 6, codificarUTF8("Calificaciones"), 1, 0, 'C');  // Encabezado con fondo
        $this->Ln(6);  // Espaciado entre filas

        // Mostrar datos del alumno (calificaciones)
        $this->SetFont('Arial', 'B', 8);  // Reducir el tamaño de la fuente

        // Colores de relleno para las celdas de "Campo"
        $colores = [
            [255, 99, 71],    // Rojo coral
            [50, 205, 50],    // Verde lima
            [30, 144, 255],   // Azul dodger
            [255, 215, 0],    // Oro
            [255, 0, 255],    // Magenta
            [0, 255, 255],    // Cian
            [255, 69, 0],     // Rojo naranja
            [0, 255, 127],    // Verde primavera
            [138, 43, 226],   // Azul violeta
            [255, 140, 0],    // Naranja oscuro
        ];

        $colorIndex = 0;  // Índice para alternar colores

        foreach ($asignaturas as $asignatura) {
            $calificacion = isset($datos['Calificaciones'][$asignatura]) ? $datos['Calificaciones'][$asignatura] : '-';

            // Establecer el color de relleno para la celda de "Campo"
            $this->SetFillColor($colores[$colorIndex][0], $colores[$colorIndex][1], $colores[$colorIndex][2]);
            $colorIndex = ($colorIndex + 1) % count($colores);  // Alternar colores

            // Guardar la posición Y inicial
            $yInicial = $this->GetY();

            // Calcular el alto necesario para la celda de "Campo"
            $altoCampo = $this->GetMultiCellHeight(60, 5, codificarUTF8($asignatura), 1);

            // Dibujar la celda de "Campo" con MultiCell
            $this->SetX(10);
            $this->MultiCell(60, 5, codificarUTF8($asignatura), 1, 'L', true);  // Columna "Campo" con relleno

            // Obtener la posición Y después de dibujar la celda de "Campo"
            $yPosAfterCampo = $this->GetY();

            // Calcular el alto necesario para la celda de "Calificaciones"
            $altoCalificaciones = $this->GetMultiCellHeight(130, 5, codificarUTF8($calificacion), 1);

            // Dibujar la celda de "Calificaciones" con MultiCell
            $this->SetXY(70, $yInicial);  // Posición X e Y inicial para "Calificaciones"
            $this->MultiCell(130, 5, codificarUTF8($calificacion), 1, 'L');  // Alto reducido a 5 para menos espacio

            // Obtener la posición Y después de dibujar la celda de "Calificaciones"
            $yPosAfterCalificaciones = $this->GetY();

            // Ajustar la posición Y para la siguiente fila
            $this->SetY(max($yPosAfterCampo, $yPosAfterCalificaciones));

            // Verificar si se necesita una nueva página
            if ($this->GetY() > 250) {
                $this->AddPage();
            }
        }

        // Mostrar la sección de Docente y Padre de familia en la misma página
        $this->MostrarDocenteYPadre();
    }

    function Footer()
    {
        $this->SetY(-10);  // Reducir el margen inferior
        $this->SetLineWidth(1.5);
        $this->SetDrawColor(38, 61, 29);
        $this->Line(12, $this->GetY(), $this->GetPageWidth() - 6, $this->GetY());

        $this->Ln(1);
        $this->SetFont('Arial', 'B', 8);  // Reducir el tamaño de la fuente
        $this->Cell(0, 6, codificarUTF8(''), 0, 1, 'C');

        $this->SetY(-8);  // Reducir el margen inferior
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(0, 0, 0);
        $this->Cell(0, 6, codificarUTF8('Calle Clavel 3, Ixmiquilpan, México'), 0, 1, 'C');
    }

    // Función para calcular el alto necesario para una celda MultiCell
    function GetMultiCellHeight($width, $lineHeight, $text, $border)
    {
        $text = codificarUTF8($text);
        $nb = $this->NbLines($width, $text);
        return $nb * $lineHeight + $border * 2;
    }

    // Función para calcular el número de líneas que ocupará un texto en una celda MultiCell
    function NbLines($width, $text)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($width == 0) {
            $width = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($width - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $text);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }
}

// Crear el PDF (sin mostrar nada en pantalla antes de `Output`)
// Genera y muestra el PDF en el navegador
$certificado = new CertificadoMedico('P');  // Orientación vertical
$certificado->AddPage();
$certificado->Contenido();
ob_clean(); // 🔴 Limpia cualquier salida previa
$certificado->Output('reporte_calificaciones.pdf', 'I');
?>