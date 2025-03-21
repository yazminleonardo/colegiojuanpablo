<?php
include "conexion.php";

$Id=$_REQUEST['ideditarimg'];

$imag=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

$sql="UPDATE eventos SET img_evento='$imag' WHERE id_evento='".$Id."'";
$resultado=$conexion->query($sql);
if ($resultado) {
	header('Location:../eventos.php');
}else{
	echo "No se insertaron los datos";
}
?>