<?php
include_once('conexion.php'); // Conexión a la base de datos

// Configurar el tipo de respuesta JSON
header('Content-Type: application/json');

try {
    // Verificar si la solicitud es POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
        exit();
    }

    // Recibir los datos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $apellidop = isset($_POST['apellidop']) ? trim($_POST['apellidop']) : null;
    $apellidom = isset($_POST['apellidom']) ? trim($_POST['apellidom']) : null;
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($apellidop) || empty($apellidom) || empty($correo) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        exit();
    }

    // Validar formato de correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Correo electrónico no válido']);
        exit();
    }

    // **Aquí definimos los valores de grado1 a grado6 automáticamente**
    $grado1 = 1;
    $grado2 = 2;
    $grado3 = 3;
    $grado4 = 4;
    $grado5 = 5;
    $grado6 = 6;

    // Insertar el docente en la base de datos junto con los grados asignados
    $stmt = $conexion->prepare("INSERT INTO docentes (Nombre_D, Apellidop_D, Apellidom_D, Correo_D, Password_D, grado1, grado2, grado3, grado4, grado5, grado6) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $nombre, $apellidop, $apellidom, $correo, $password, $grado1, $grado2, $grado3, $grado4, $grado5, $grado6);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Docente registrado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar el docente']);
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error interno: ' . $e->getMessage()]);
}
?>