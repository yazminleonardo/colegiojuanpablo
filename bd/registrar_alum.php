<?php
include "conexion.php";

$nombre=$_POST['nombre'];
$apellidop=$_POST['apellidop'];
$apellidom=$_POST['apellidom'];
$curp=$_POST['curp'];
$nacimiento=$_POST['fecha'];
$edad=$_POST['edad'];
$peso=$_POST['peso'];
$talla=$_POST['talla'];
$genero=$_POST['genero'];
$alergias=$_POST['alergias'];
$problemas=$_POST['problemas'];
$password1=$_POST['password1'];
$password=$_POST['password'];

if ($password1 == $password) {
	$sql="INSERT INTO alumnos(Nombre,Password,Apellidop,Apellidom,Curp,Nacimiento,Edad,Talla,Peso,Genero,Alergias,Problemas_salud) VALUES('$nombre','$password','$apellidop','$apellidom','$curp','$nacimiento','$edad','$talla','$peso','$genero','$alergias','$problemas')";
	$resultado=$conexion->query($sql);
	if ($resultado) {
		sleep(2);
		header('Location:../login.php');
	}else{
		echo "No se insertaron los datos";
	}
}else{
	sleep(2);
	echo "Las contraseñas no coinciden,intente de nuevo";
	header('Location: ../registro.php');
	exit;
}
?>