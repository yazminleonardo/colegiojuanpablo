<?php
include 'conexion.php';

if (isset($_GET['ideditar'])) {
    $Id = $_GET['ideditar'];
    
    // Recibir los valores del formulario
    $nombre = $_POST['nombre_d'];
    $apellidop = $_POST['apellidop_d'];
    $apellidom = $_POST['apellidom_d'];
    $correo = $_POST['correo_d'];
    $password = isset($_POST['password_d']) ? $_POST['password_d'] : '';  // Si no se ingresa una nueva contraseña, dejamos vacío

    if (!empty($password)) {
        $stmt = $conexion->prepare("UPDATE docentes SET Nombre_D = ?, Apellidop_D = ?, Apellidom_D = ?, Correo_D = ?, Password_D = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $nombre, $apellidop, $apellidom, $correo, $password, $Id);
    } else {
        // Si no se proporciona una nueva contraseña, solo actualizamos los demás campos
        $stmt = $conexion->prepare("UPDATE docentes SET Nombre_D = ?, Apellidop_D = ?, Apellidom_D = ?, Correo_D = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $apellidop, $apellidom, $correo, $Id);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        //echo "Información del docente actualizada correctamente.";
        sleep(2);
        header('Location: ../docentes.php');
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
}

$conexion->close();
?>
