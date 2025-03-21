<?php
include 'conexion.php';

if (isset($_GET['iddel'])) {
    $id = $_GET['iddel'];
    $stmt = $conexion->prepare("DELETE FROM alumnos WHERE Id_alumno = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        sleep(2);
        header('Location: ../editar_info.php');
        //echo "<script>alert('Alumno eliminado exitosamente.'); window.location.href = '../editar_info.php';</script>";
    } else {
        echo "Error al actualizar: " . $conexion->error;
        //echo "<script>alert('Error al eliminar alumno.'); window.location.href = '../editar_info.php';</script>";
    }
}
$stmt->close();
$conexion->close();
?>
