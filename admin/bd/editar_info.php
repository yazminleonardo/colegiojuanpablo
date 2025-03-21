
<?php
include 'conexion.php';

if (!isset($_POST['nombre'], $_POST['apellidop'], $_POST['apellidom'],$_POST['nivel'], $_POST['grado'], $_POST['grupo'])) {
    die("Error: Datos incompletos.");
}

$Id = $_REQUEST['ideditar'];
$nombre = $_POST['nombre'];
$apellidop = $_POST['apellidop'];
$apellidom = $_POST['apellidom'];
$nivel = $_POST['nivel'];
$grado = $_POST['grado'];
$grupo = $_POST['grupo'];

// Consulta de actualización con grado y grupo
$sql = "UPDATE alumnos SET Nombre=?, Apellidop=?, Apellidom=?, Nivel=?, grado=?, grupo=? WHERE Id_alumno=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssssi", $nombre, $apellidop, $apellidom, $nivel, $grado, $grupo, $Id);

if ($stmt->execute()) {
    //echo "<script>alert('Alumno eliminado exitosamente.'); window.location.href = '../editar_info.php';</script>";
    sleep(2);
    header('Location: ../editar_info.php');
    //exit();
} else {
    echo "Error al actualizar: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
