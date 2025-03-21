<?php
include_once('conexion.php');

if (isset($_GET['iddel'])) {
    $id = $_GET['iddel'];

    $query = "DELETE FROM docentes WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        /*echo "<script>
            alert('Docente eliminado correctamente');
            window.location.href = '../docentes.php';
        </script>";*/
        sleep(2);
        header('Location: ../docentes.php');
    } else {
        /*echo "<script>
            alert('Error al eliminar el docente');
            window.history.back();
        </script>";*/
        echo "Error al actualizar: " . $conexion->error;
    }
    $stmt->close();
}
$conexion->close();
?>
