<?php
include "conexion.php";

$Id=$_REQUEST['ideditar'];

$fechai=$_POST['fecha_inicio'];
$fechaf=$_POST['fecha_fin'];

$sql="UPDATE periodo SET fecha_inicio='$fechai', fecha_fin='$fechaf' WHERE id_periodo='".$Id."'";
$resultado=$conexion->query($sql);
if ($resultado) {
	sleep(2);
	header('Location:../inteligencias.php');
}else{
	echo'<script>alert("No se registraron los datos, vuelve a intentarlo");</script>';
}
?>