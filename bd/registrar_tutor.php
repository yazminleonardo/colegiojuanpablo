<?php
include "conexion.php";

//recepción de datos enviados mediante POST desde ajax
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellidop = (isset($_POST['apellidop'])) ? $_POST['apellidop'] : '';
$apellidom = (isset($_POST['apellidom'])) ? $_POST['apellidom'] : '';
$curp = (isset($_POST['curp'])) ? $_POST['curp'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$estudios = (isset($_POST['grado_estudios'])) ? $_POST['grado_estudios'] : '';
$domicilio = (isset($_POST['domicilio'])) ? $_POST['domicilio'] : '';
$ocupacion = (isset($_POST['ocupacion'])) ? $_POST['ocupacion'] : '';
$tipof = (isset($_POST['tipof'])) ? $_POST['tipof'] : '';
$matricula1 = (isset($_POST['matricula_alumno1'])) ? $_POST['matricula_alumno1'] : '';
$password = (isset($_POST['password1'])) ? $_POST['password1'] : '';

$sql="INSERT INTO tutores(Nombre, Password, Apellidop, Apellidom, Curp, Nacimiento, Telefono, Email, Estudios, Domicilio, Ocupacion, Tipo_familia, matricula_alumno) VALUES('$nombre','$password','$apellidop','$apellidom','$curp','$fecha','$telefono','$correo','$estudios','$domicilio','$ocupacion','$tipof','$matricula1')";
$resultado=$conexion->query($sql);
if ($resultado) {
    $data = $resultado;
}
print json_encode($data);
$conexion=null;
?>