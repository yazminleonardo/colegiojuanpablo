<?php
include 'conexion.php';

if (isset($_POST['editar'])) {
    $asistencias = $_POST['asistencia'];
    $fecha = $_POST['f'];

    // Iterar sobre el array de asistencias
    foreach ($asistencias as $id => $valor) {
        // Actualizar la base de datos con $valor para el alumno con $id en la fecha proporcionada
        $editar = mysqli_query($conexion, "UPDATE `asistencias` SET `asistencia`='$valor' WHERE Id_alumno=$id AND fecha='$fecha'");
    }

    // Resto del código...
    ?>
    <script>
        alert("Asistencias actualizadas");
        window.location.href = "../editar_asistencia.php";
    </script>
    <?php
}
?>