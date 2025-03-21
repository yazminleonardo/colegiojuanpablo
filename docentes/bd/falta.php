<?php
require 'conexion.php';
session_start();
$alumno=$_GET['id'];
$grado1= $_SESSION['grado1'];
$grado2= $_SESSION['grado2'];
$count=mysqli_query($conexion,"UPDATE  alumnos set contador_asistencias=1  WHERE alumnos.Id_alumno =$alumno");
$sql=mysqli_query($conexion,"INSERT INTO asistencias values($alumno,CURDATE(),'Falta',null)");
$verificacion=mysqli_query($conexion,"SELECT Id_alumno ,Nombre, ApellidoP,Apellidom FROM alumnos WHERE contador_asistencias=0 and (grado=$grado1 or grado=$grado2)");

?>
<?php
if(mysqli_num_rows($verificacion)==0){
    $count=mysqli_query($conexion,"UPDATE  alumnos set contador_asistencias=0  WHERE grado=$grado1 or grado=$grado2");
    ?>
    <script type="text/javascript">

    alert("El registro de asistencia se ha realizado con éxito!");
    window.location.href = "../insertar_asistencia.php";
    </script>    
    <?php } 
    else{
    ?>
<script type="text/javascript">
alert("Registrado!");
window.location.href = "../insertar_asistencia.php";
</script>
<?php } ?>
