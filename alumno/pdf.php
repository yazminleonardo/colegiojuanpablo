<?php
require_once('../recursos/fpdf/fpdf.php');
include 'BD/conexion1.php';

function codificarUTF8($cadena){
    $iso_string = mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
    return  $iso_string;
  }

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

$pdf->Image('../logo.png', $logoX, $logoY, $logoWidth, $logoHeight);

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
$periodo = $_POST['periodo'];
$usuario = $_POST['usuario'];
$sql = "SELECT * FROM alumnos WHERE Id_alumno = '$usuario'";
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
    $pdf->Ln(6);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 6, codificarUTF8('Trimestre:'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(68, -6, codificarUTF8($periodo), 0, 1, 'C');
    $pdf->Ln(5);
}
$pdf->Ln(5);
// Tabla
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.5);
$pdf->SetFillColor(25, 135, 84);
$pdf->Cell(100, 10, 'Campo formativo', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Materias', 1, 0, 'C', true);
$pdf->Cell(40, 10, codificarUTF8('Calificación'), 1, 1, 'C', true);
//?aqui es el inicio de todo
$consulta = "SELECT * FROM calificaciones WHERE Id_alumno = '$usuario' AND id_asignatura=1 AND id_periodo=$periodo";
$datos = $conexion->query($consulta);
while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(100, 30, 'Lenguajes', 1, 0, 'L');
    $pdf->Cell(50, 10, 'Artes', 1, 0, 'L');
    $pdf->Cell(40, 10, $calif1 = $row['calificacion'], 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(50, 10, codificarUTF8('Español'), 1, 0, 'L');
    $pdf->Cell(40, 10, $calif1, 1, 1, 'L');  
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p1=($calif1+$calif1)/2, 1, 1, 'L');
}
// Si no hay registros, mostrar una fila en blanco
$registros = mysqli_num_rows($datos);
if ($registros == 0) {
    $pdf->Cell(100, 30, 'Lenguajes', 1, 0, 'L');
    $pdf->Cell(50, 10, 'Artes', 1, 0, 'L');
    $pdf->Cell(40, 10, '', 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(50, 10, codificarUTF8('Español'), 1, 0, 'L');
    $pdf->Cell(40, 10, '', 1, 1, 'L');  
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p1=null, 1, 1, 'L');
}
$consulta = "SELECT * FROM calificaciones WHERE Id_alumno = '$usuario' AND id_asignatura=2 AND id_periodo=$periodo";
$datos = $conexion->query($consulta);
while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(100, 30, codificarUTF8('Saberes y pensamiento científico'), 1, 0, 'L');
    $pdf->Cell(50, 10, 'Matematicas', 1, 0, 'L');
    $pdf->Cell(40, 10, $calif1 = $row['calificacion'], 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'L');
    $pdf->Cell(50, 10, 'C.Medio', 1, 0, 'L');
    $pdf->Cell(40, 10, $calif1, 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p2=($calif1+$calif1)/2, 1, 1, 'L');
}
// Si no hay registros, mostrar una fila en blanco
$registros = mysqli_num_rows($datos);
if ($registros == 0) {
    $pdf->Cell(100, 30, codificarUTF8('Saberes y pensamiento científico'), 1, 0, 'L');
    $pdf->Cell(50, 10, 'Matematicas', 1, 0, 'L');
    $pdf->Cell(40, 10, '', 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'L');
    $pdf->Cell(50, 10, 'C.Medio', 1, 0, 'L');
    $pdf->Cell(40, 10, '', 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p2=null, 1, 1, 'L');
}
$consulta = "SELECT * FROM calificaciones WHERE Id_alumno = '$usuario' AND id_asignatura=3 and id_periodo=$periodo";
$datos = $conexion->query($consulta);
while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(100, 20, codificarUTF8('Ética naturaleza y sociedad'), 1, 0, 'L');
    $pdf->Cell(50, 10, 'F.C.E', 1, 0, 'L');
    $pdf->Cell(40, 10, $calif1 = $row['calificacion'], 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p3=($calif1)/1, 1, 1, 'L');
}
// Si no hay registros, mostrar una fila en blanco
$registros = mysqli_num_rows($datos);
if ($registros == 0) {
    $pdf->Cell(100, 20, codificarUTF8('Ética naturaleza y sociedad'), 1, 0, 'L');
    $pdf->Cell(50, 10, 'F.C.E', 1, 0, 'L');
    $pdf->Cell(40, 10, '', 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p3=null, 1, 1, 'L');
}
$consulta = "SELECT * FROM calificaciones WHERE Id_alumno = '$usuario' AND id_asignatura=4 and id_periodo=$periodo";
$datos = $conexion->query($consulta);
while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(100, 30, 'De lo humano a lo comunitario', 1, 0, 'L');
    $pdf->Cell(50, 10, codificarUTF8('Computación'), 1, 0, 'L');
    $pdf->Cell(40, 10, $calif1 = $row['calificacion'], 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'L');
    $pdf->Cell(50, 10, codificarUTF8('Educación Física'), 1, 0, 'L');
    $pdf->Cell(40, 10, $calif1, 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p4=($calif1+$calif1)/2, 1, 1, 'L');
}
// Si no hay registros, mostrar una fila en blanco
$registros = mysqli_num_rows($datos);
if ($registros == 0) {
    $pdf->Cell(100, 30, 'De lo humano a lo comunitario', 1, 0, 'L');
    $pdf->Cell(50, 10, codificarUTF8('Computación'), 1, 0, 'L');
    $pdf->Cell(40, 10, '', 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'L');
    $pdf->Cell(50, 10, codificarUTF8('Educación Física'), 1, 0, 'L');
    $pdf->Cell(40, 10, '', 1, 1, 'L');
    $pdf->Cell(100, 0, '', 0, 0, 'C');
    $pdf->Cell(90, 10, 'Promedio:'."                          ".$p4=null, 1, 1, 'L');
}
$pdf->Cell(100, 0, '', 0, 0, 'C');
$pdf->Cell(90, 10, 'Promedio Final:'."                 ".($p1+$p2+$p3+$p4)/4, 1, 1, 'L');
// Pie de página
$pdf->SetY(-26); // Establecer la posición vertical a 15 mm desde la parte inferior de la página
      
$pdf->SetLineWidth(1); // Establecer el grosor de la línea en 1.5 puntos
$pdf->SetDrawColor(25, 135, 84); // Establecer el color de la línea en rojo (RGB: 255, 0, 0)
      
$pdf->Line(12, $pdf->GetY(), $pdf->GetPageWidth() - 6, $pdf->GetY()); // Dibujar la línea horizontal en la posición actual
      
$pdf->SetFont('Arial', 'B', 9); // Establecer la fuente
$pdf->Cell(0, 5, codificarUTF8('DOMICILIO CONOCIDO S/N, DECA, ALFAJAYUCAN, HIDALGO.'), 0, 1, 'C'); // Agregar el texto centrado
$pdf->Ln(0); // Saltar una línea
 
// Restaurar la posición y los valores por defecto
$pdf->SetY(-15);
$pdf->SetLineWidth(0.2);
$pdf->SetDrawColor(0, 0, 0);

// Salida del PDF
$pdf->Output('reporte.pdf', 'I');
?>