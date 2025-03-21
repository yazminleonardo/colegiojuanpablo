<?php

require_once('../recursos/fpdf/fpdf.php');


function codificarUTF8($cadena){
  $iso_string = mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
  return  $iso_string;
}

      // Crear una clase extendida de FPDF para personalizar el certificado
class CertificadoMedico extends FPDF
{
    function Header()
    {

      
      $this->SetTitle(codificarUTF8('Reporte de Calificaciones  | Escuela Primaria Ignacio Zaragoza'));
      $this->SetAuthor(codificarUTF8('Primaria Ignacio Zaragoza'));
      $this->SetSubject(codificarUTF8('Reporte'));
      $this->SetKeywords(codificarUTF8('Calificaciones, Reporte, Escuela'));

    
         
        // Logo o encabezado del certificado
        $logoWidth = 30; 
        $logoHeight = 35; 
        $logoX = 17;  
        $logoY = 10; 
        
        $this->Image('../imagenes/logo.jpeg', $logoX, $logoY, $logoWidth, $logoHeight);


        // Logo o encabezado del certificado
        $this->SetX(60); 
        $this->SetFont('times', 'B', 16);
        $this->Cell(0, 10, codificarUTF8('ESCUELA PRIMARIA IGNACIO ZARAGOZA'), 0, 1, 'C');
        $this->Ln(0);
        // Letras chiquititas

        /*
        $this->SetX(60); 
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, codificarUTF8('REPORTE DE CALIFICACIONES'), 0, 1, 'C');
        $this->Ln(0);
        */
        // Linea roja
        $this->SetX(60); 
        $this->SetLineWidth(1.5); // Establecer el grosor de la línea en 15 puntos
        $this->SetDrawColor(38, 101, 29); // Establecer el color de la línea en rojo (RGB: 255, 0, 0)
        $this->Line(60, $this->GetY() + 4, $this->GetPageWidth() - 10, $this->GetY() + 4); // Dibujar la línea
        $this->Ln(8);
        
        // Letras chiquititas
        $this->SetX(60); 
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, codificarUTF8('REPORTE DE ASISTENCIAS'), 0, 1, 'C');
        $this->Ln(10);

       
    }


    function Contenido()
    {
 /*
      $this->SetFont('Arial', '', 11);
      $this->Cell(0, 10, codificarUTF8('SE HACE CONSTAR QUE AL ALUMNO _________________________________________________'), 0, 1, 'C');
      $this->Ln(15); 
      */ 


      include '../bd/conexion.php';

      $usuario = $_POST['usuario'];
      $grado1 =  $_POST['grado1'];
      $grado2 =  $_POST['grado2'];
      $asistencia= $_POST['asistencia'];
      $asistencia1= $_POST['asistencia1'];



       $vista=$conexion->prepare("SELECT Nombre,Apellidop,Apellidom,asistencia,fecha FROM asistencias INNER JOIN alumnos ON asistencias.Id_alumno=alumnos.Id_alumno WHERE grado in($grado1,$grado2) AND fecha BETWEEN '$asistencia' AND '$asistencia1'");
       $vista->execute();
       $resultado = $vista->get_result();

        $asignaturas = array();

 // Set headers for Matricula and Nombre
 $this->SetFont('Arial', 'B', 8);
 $this->SetX(25);
 $this->Cell(80, 10, "Nombre", 1);

 $fechasMostradas = array();
 foreach ($resultado as $row) {
     $fecha = $row['fecha'];

     if (!in_array($fecha, $fechasMostradas)) {
     
      $this->Cell(20, 10, date('d-m-Y', strtotime($fecha)), 1, 0, '');
      array_push($fechasMostradas, $fecha);
     }

 }

 $nombresAsistencia = array();

 foreach ($resultado as $row) {
  $nombreCompleto = $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre'];

     // Inicializar la fila si es la primera vez que se encuentra el nombre
      if (!array_key_exists($nombreCompleto, $nombresAsistencia)) {
          $nombresAsistencia[$nombreCompleto] = array_fill_keys($fechasMostradas, ''); // Inicializar todas las asistencias como vacías
      }
  
 // Asignar la asistencia a la fecha correspondiente
 $nombresAsistencia[$nombreCompleto][$row['fecha']] = $row['asistencia'];
 
 }

 $this->Ln(10);

    // Mostrar las filas
    foreach ($nombresAsistencia as $nombre => $asistencias) {
      $this->SetX(25);
      $this->Cell(80, 10, codificarUTF8($nombre), 1);
      foreach ($asistencias as $asistencia) {
          // Aplicar estilos según el estado de asistencia
          $claseAsistencia = ($asistencia == 'Asistencia') ? 'Asistencia' : 'Falta';
          $this->Cell(20, 10, $claseAsistencia, 1);
          $this->Ln(10);
      }
    
  }



}

    function Footer(){
      $this->SetY(-20); // Establecer la posición vertical a 15 mm desde la parte inferior de la página
      
      $this->SetLineWidth(1.5); // Establecer el grosor de la línea en 1.5 puntos
      $this->SetDrawColor(38, 101, 29); // Establecer el color de la línea en rojo (RGB: 255, 0, 0)
      
      $this->Line(12, $this->GetY(), $this->GetPageWidth() - 10, $this->GetY()); // Dibujar la línea horizontal en la posición actual
      
      $this->Ln(1); // Saltar una línea
      $this->SetFont('Arial', 'B', 9); // Establecer la fuente
      $this->Cell(0, 10, codificarUTF8('DOMICILIO CONOCIDO S/N, DECA, ALFAJAYUCAN, HIDALGO.'), 0, 1, 'C'); // Agregar el texto centrado
      $this->Ln(0); // Saltar una línea
      /*$this->SetFont('Arial', '', 9); // Establecer la fuente
      $this->Cell(0, 0, codificarUTF8('email: cruzrojaactopan@hotmail.com'), 0, 1, 'C'); // Agregar el texto centrado */
      
      // Restaurar la posición y los valores por defecto
      $this->SetY(-15);
      $this->SetLineWidth(0.2);
      $this->SetDrawColor(0, 0, 0);
  }
  
}



  // Crear una instancia del certificado
  $certificado = new CertificadoMedico('L');

  // Agregar una página
  $certificado->AddPage();
  // Generar el contenido del certificado, pasando el nombre como parámetro
  $certificado->Contenido();


  $certificado->Output('certificado_medico.pdf', 'I');

  
?>