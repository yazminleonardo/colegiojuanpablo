<?php
include'conexion.php'; 
$calificaion=$_POST['calificacion'];
$id=$_POST['id'];
$periodo=$_POST['periodo'];
$asignatura=$_POST['asignatura'];
$motivo=$_POST['motivo'];
$id_calificaion=$_POST['id_calificacion'];
$editar=mysqli_query($conexion,"INSERT INTO modificar values (NULL,$calificaion,$periodo,'Espera',$asignatura,'$motivo',$id,$id_calificaion)");
?>
<script>
alert("Solicitud enviada, espere su respuesta.");
window.location.href = "../modificar_calificaciones5.php";
</script>