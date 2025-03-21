<?php include_once "vistas/sidebar.php"; 
include "bd/conexion.php";
$vista = $conexion->prepare("SELECT alumnos.Id_alumno,calificaciones.id_calificacion ,alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, campos.campo_formativo, calificaciones.calificacion,modificar.Calificacion, modificar.motivo,modificar.id_periodo
FROM modificar
INNER JOIN calificaciones ON modificar.id_calificacion = calificaciones.id_calificacion
INNER JOIN alumnos ON modificar.Id_alumno = alumnos.Id_alumno
INNER JOIN campos ON modificar.id_asignatura = campos.id_asignatura where estado='Espera';");

$vista->execute();
$resultados = $vista->get_result();
$revision=mysqli_query($conexion,"Select id from modificar where estado='Espera'");
if(mysqli_num_rows($revision)==0){
?>
<script>
alert("No hay calificaciones por modificar");
window.location.href="index_admin.php";
</script>
<?php

}
?>
<label class="h3">Solicitudes para modificación de calificación</label>
<form action="" method="POST">
    <table class="content-table table table-bordered">
        <thead>
            <th>Matrícula</th>
            <th>Nombre</th>
            <th>Campo</th>
            <th>Periodo</th>
            <th>Calificación actual</th>
            <th>Nueva calificación</th>
            <th>Motivo</th>
            <th colspan="2">Opciones</th>
        </thead>
        <tbody class="table-group-divider">
        <?php
        foreach ($resultados as $row) {
            echo '<tr>';
            echo '<td>' . $row['Matricula'] . '</td>';
            echo '<td>' . $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre'] . '</td>';
            echo '<td>' . $row['campo_formativo'] . '</td>';
            echo '<td>' . $row['id_periodo'] . '</td>';
            echo '<td>' . $row['calificacion'] . '</td>';
            echo '<td>' . $row['Calificacion'] . '</td>';
            echo '<td>' . $row['motivo'] . '</td>';
            echo'<input type="hidden" name="xyz" value="'.$row['id_calificacion'].'">';
            echo'<input type="hidden" name="c" value="'.$row['Calificacion'].'">';
            echo '<td><button type="submit" name="aprobar" value="' . $row['Id_alumno'] . '" class="btn btn-success">Aprobar</button></td>';
            echo '<td><button type="submit" name="rechazar" value="' . $row['Id_alumno'] . '" class="btn btn-danger">Rechazar</button></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aprobar'])) {
        $id=$_POST['xyz'];
        $calficacion=$_POST['c'];
        $aceptado=mysqli_query($conexion,"UPDATE calificaciones SET calificacion=$calficacion where id_calificacion=$id");
        $cambio=mysqli_query($conexion,"Update modificar SET estado='Aprobado' WHERE id_calificacion=$id");
        ?>
        <script>
           window.location.reload();
       
        </script>
        <?php
        
    } elseif (isset($_POST['rechazar'])) {
        $id=$_POST['xyz'];
        $calficacion=$_POST['c'];
        $cambio=mysqli_query($conexion,"Update modificar SET estado='Rechazado' WHERE id_calificacion=$id");       
        ?>
        <script>
        window.location.reload();
    
        </script>
        <?php
    }
}



