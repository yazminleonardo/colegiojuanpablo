<?php include_once "vistas/sidebar.php"; 
include "bd/conexion.php";
$grado1=$_SESSION['grado1'];
$grado2=$_SESSION['grado2'];
$vista = $conexion->prepare("SELECT alumnos.Id_alumno,estado,calificaciones.id_calificacion ,alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, campos.campo_formativo, calificaciones.calificacion,modificar.Calificacion, modificar.motivo,modificar.id_periodo
FROM modificar
INNER JOIN calificaciones ON modificar.id_calificacion = calificaciones.id_calificacion
INNER JOIN alumnos ON modificar.Id_alumno = alumnos.Id_alumno
INNER JOIN campos ON modificar.id_asignatura = campos.id_asignatura WHERE grado in ($grado1,$grado2);");

$vista->execute();
$resultados = $vista->get_result();
$revision=mysqli_query($conexion,"SELECT alumnos.Id_alumno,calificaciones.id_calificacion ,alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, campos.campo_formativo, calificaciones.calificacion,modificar.Calificacion, modificar.motivo
FROM modificar
INNER JOIN calificaciones ON modificar.id_calificacion = calificaciones.id_calificacion
INNER JOIN alumnos ON modificar.Id_alumno = alumnos.Id_alumno
INNER JOIN campos ON modificar.id_asignatura = campos.id_asignatura WHERE grado in ($grado1,$grado2);");
if(mysqli_num_rows($revision)==0){
?>
<script>
alert("No hay calificaciones quue se hayan modificado");
window.location.href="index_docente.php ";
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
            <th>Campo formativo</th>
            <th>Calificación actual</th>
            <th>Estado</th>
            <th>Trimestre</th>

        </thead>
        <tbody class="table-group-divider">
        <?php
        foreach ($resultados as $row) {
            echo '<tr>';
            echo '<td>' . $row['Matricula'] . '</td>';
            echo '<td>' . $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre'] . '</td>';
            echo '<td>' . $row['campo_formativo'] . '</td>';
            echo '<td>' . $row['calificacion'] . '</td>';
            echo '<td>' . $row['estado'] . '</td>';
            echo '<td>' . $row['id_periodo'] . '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</form>
<?php



