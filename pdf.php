<?php
require_once('recursos/fpdf/fpdf.php');
include 'bd/conexion.php';

function codificarUTF8($cadena){
    $iso_string = mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
    return  $iso_string;
  }

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "escuela");

// Consulta SQL
$sql = "SELECT * FROM alumnos";
$resultado = $mysqli->query($sql);

// Creación del objeto FPDF
$pdf = new FPDF();

// Agregar una página
$pdf->AddPage();

$pdf->SetTitle(codificarUTF8('Reporte de Calificaciones  | Escuela Primaria Ignacio Zaragoza'));
$pdf->SetAuthor(codificarUTF8('Primaria Ignacio Zaragoza'));
$pdf->SetSubject(codificarUTF8('Reporte'));
$pdf->SetKeywords(codificarUTF8('Calificaciones, Reporte, Escuela'));

/* Encabezado
$pdf->SetFont('', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de datos', 0, 1, 'C');*/

// Logo o encabezado del certificado
$logoWidth = 30; 
$logoHeight = 30; 
$logoX = 15;  
$logoY = 9; 

$pdf->Image('logo.png', $logoX, $logoY, $logoWidth, $logoHeight);

// Logo o encabezado del certificado
$pdf->SetX(40);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 11, codificarUTF8('ESCUELA PRIMARIA GENERAL IGNACIO ZARAGOZA'), 0, 1, 'C');
$pdf->Ln(0);

// Linea
$pdf->SetX(60); 
$pdf->SetLineWidth(1.5); // Establecer el grosor de la línea en 15 puntos
$pdf->SetDrawColor(25, 135, 84); // Establecer el color de la línea en rojo (RGB: 255, 0, 0)
$pdf->Line(53, $pdf->GetY() + 4, $pdf->GetPageWidth() - 6, $pdf->GetY() + 4); // Dibujar la línea
$pdf->Ln(4);

// Letras chiquititas
$pdf->SetX(53); 
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(70, 13, codificarUTF8('REPORTE DE CALIFICACIONES'), 0, 1, 'C');
$pdf->Ln(5);

//Datos del alumno
// $matricula1 = $_SESSION['matricula1'];
// $sql = "SELECT * FROM alumnos WHERE Matricula = '$matricula1'";
$sql = "SELECT * FROM alumnos WHERE Matricula = 'E202301'";
$dato1 = $conexion->query($sql);
if ($fila1 = $dato1->fetch_assoc()) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 6, codificarUTF8('Nombre del alumno:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(160, -5, codificarUTF8($fila1['Nombre']. " " .$fila1['Apellidop'] . " " . $fila1['Apellidom']), 0, 1, 'C');
    $pdf->Ln(6);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(39, 6, codificarUTF8('Matrícula:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(82, -6, codificarUTF8($fila1['Matricula']), 0, 1, 'C');
    $pdf->Ln(6);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(33, 6, codificarUTF8('Grado:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(58, -6, codificarUTF8($fila1['grado']."°"), 0, 1, 'C');
    $pdf->Ln(6);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(33, 6, codificarUTF8('Grupo:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(58, -6, codificarUTF8($fila1['grupo']), 0, 1, 'C');
    $pdf->Ln(5);
}
$pdf->Ln(5);
// Tabla
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.5);
$pdf->Cell(100, 10, 'Campo formativo', 1, 0, 'C');
$pdf->Cell(50, 10, 'Materias', 1, 0, 'C');
$pdf->Cell(40, 10, codificarUTF8('Calificación'), 1, 1, 'C');
//?aqui es el inicio de todo
$consulta = "SELECT * FROM calificaciones INNER JOIN alumnos ON calificaciones.Id_alumno=alumnos.Id_alumno WHERE Matricula = 'E202301' AND id_asignatura=1 and id_periodo=1";
$datos = $conexion->query($consulta);
while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(100, 10, 'Lenguajes', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Artes', 1, 0, 'C');
    $pdf->Cell(40, 10, $calif1 = $row['calificacion'], 1, 1, 'C');
    $pdf->Cell(100, 10, '', 1, 0, 'C');
    $pdf->Cell(50, 10, codificarUTF8('Español'), 1, 0, 'C');
    $pdf->Cell(40, 10, $calif1, 1, 1, 'C');
}
$consulta = "SELECT * FROM calificaciones INNER JOIN alumnos ON calificaciones.Id_alumno=alumnos.Id_alumno WHERE Matricula = 'E202301' AND id_asignatura=2 and id_periodo=1";
$datos = $conexion->query($consulta);
while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(100, 10, 'Lenguajes', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Artes', 1, 0, 'C');
    $pdf->Cell(40, 10, $calif1 = $row['calificacion'], 1, 1, 'C');
    $pdf->Cell(100, 10, '', 1, 0, 'C');
    $pdf->Cell(50, 10, codificarUTF8('Español'), 1, 0, 'C');
    $pdf->Cell(40, 10, $calif1, 1, 1, 'C');
}
// Pie de página
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, codificarUTF8('Página ') . $pdf->PageNo() . ' de {nb}', 0, 0, 'C');

// Salida del PDF
$pdf->Output('reporte.pdf', 'I');
/* Generar el PDF
$pdf->Output("reporte.pdf", "I");*/

?>

require_once('recursos/fpdf/fpdf.php');

function codificarUTF8($cadena){
    $iso_string = mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
    return  $iso_string;
  }

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "escuela");

// Consulta SQL
$sql = "SELECT * FROM alumnos";
$resultado = $mysqli->query($sql);

// Creación del objeto FPDF
$pdf = new FPDF();

// Agregar una página
$pdf->AddPage();

// Encabezado
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de datos', 0, 1, 'C');

// Tabla
$pdf->SetFont('Arial', '', 12);
$pdf->SetLineWidth(0.5);
$pdf->Cell(40, 10, 'ID', 1, 0, 'C');
$pdf->Cell(100, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(50, 10, 'Apellido', 1, 1, 'C');

while ($fila = $resultado->fetch_assoc()) {
    $pdf->Cell(40, 10, $fila['Id_alumno'], 1, 0, 'C');
    $pdf->Cell(100, 10, $fila['Nombre'], 1, 0, 'C');
    $pdf->Cell(50, 10, $fila['Apellidop'], 1, 1, 'C');
}

// Pie de página
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, codificarUTF8('Página ') . $pdf->PageNo() . ' de {nb}', 0, 0, 'C');

// Salida del PDF
$pdf->Output('reporte.pdf', 'I');
/* Generar el PDF
$pdf->Output("reporte.pdf", "I");*/
