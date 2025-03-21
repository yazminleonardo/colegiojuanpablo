<?php
require_once('../recursos/fpdf/fpdf.php');
include 'bd/conexion.php';

function codificarUTF8($cadena){
    $iso_string = mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
    return  $iso_string;
  }

// Creación del objeto FPDF
$pdf = new FPDF();

// Agregar una página
$pdf->AddPage();

$pdf->SetTitle(codificarUTF8('Reporte de Asistencias  | Escuela Primaria Ignacio Zaragoza'));
$pdf->SetAuthor(codificarUTF8('Primaria Ignacio Zaragoza'));
$pdf->SetSubject(codificarUTF8('Reporte'));
$pdf->SetKeywords(codificarUTF8('Asistencias, Reporte, Escuela'));

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
$pdf->Cell(70, 13, codificarUTF8('REPORTE DE ASISTENCIAS'), 0, 1, 'C');
$pdf->Ln(5);

//Datos del alumno
$periodo = $_POST['periodo'];
$matricula1 = $_POST['matricula1'];
$sql = "SELECT * FROM alumnos WHERE Matricula = '$matricula1'";
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
$pdf->Cell(100, 10, 'FECHA', 1, 0, 'C', true);
$pdf->Cell(90, 10, 'ASISTENCIA', 1, 1, 'C', true);
//?aqui es el inicio de todo
$periodo = $_POST['periodo'];
switch ($periodo) {
    case 1:
        $consulta = "SELECT * FROM asistencias INNER JOIN alumnos ON asistencias.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '08' AND '12'";
        break;
    case 2:
        $consulta = "SELECT * FROM asistencias INNER JOIN alumnos ON asistencias.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '01' AND '03'";
        break;
    case 3:
        $consulta = "SELECT * FROM asistencias INNER JOIN alumnos ON asistencias.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '04' AND '06'";
    break;
  }
$datos = $conexion->query($consulta);
while ($row = $datos->fetch_assoc()) {
    $fecha1=$row['fecha'];
    $fecha= date("d/m/y", strtotime($fecha1));
    $pdf->Cell(100, 10, $fecha, 1, 0, 'L');
    $pdf->Cell(90, 10, $row['asistencia'], 1, 1, 'L');
}
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