<?php
include "conexion.php";

$nombre=$_POST['nombre_tutor'];
$apellidop=$_POST['apellidop_tutor'];
$apellidom=$_POST['apellidom_tutor'];
/*$password1=$_POST['password1'];
$password=$_POST['password'];*/
$cantidad=$_POST['cantidad_alumnos'];

if ($cantidad == 1) {
	$sql="INSERT INTO alumnos(Nombre,Apellidop,Apellidom) VALUES('$nombre','$password','$apellidop','$apellidom','$curp','$nacimiento','$edad','$talla','$peso','$genero','$alergias','$problemas')";
	$resultado=$conexion->query($sql);
	if ($resultado) {
		sleep(2);
		header('Location:../login.php');
	}else{
		echo "No se insertaron 
		los datos";
	}
}else{
	sleep(2);
	echo "Las contraseñas no coinciden,intente de nuevo";
	header('Location: ../registro.php');
	exit;
}
/*if ($password1 == $password) {
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
}*/
?>