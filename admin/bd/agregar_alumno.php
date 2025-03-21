<?php
header('Content-Type: application/json');
include("conexion.php");

// Recibir datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$apellidop = isset($_POST['apellidop']) ? trim($_POST['apellidop']) : '';
$apellidom = isset($_POST['apellidom']) ? trim($_POST['apellidom']) : '';
$nivel = isset($_POST['nivel']) ? trim($_POST['nivel']) : '';
$grado = isset($_POST['grado']) ? trim($_POST['grado']) : '';
$grupo = isset($_POST['grupo']) ? trim($_POST['grupo']) : '';

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($apellidop) || empty($apellidom) || empty($nivel) || empty($grado) || empty($grupo)) {
    echo json_encode(["status" => "error", "message" => "Faltan datos"]);
    exit;
}

// Generar matrícula automáticamente
$anio_actual = date("Y");

// Obtener el último número de matrícula registrado en el mismo año
$query = "SELECT matricula FROM alumnos WHERE matricula LIKE ? ORDER BY matricula DESC LIMIT 1";
$stmt = mysqli_prepare($conexion, $query);
$prefix = $anio_actual . "%";  // Prefijo basado en el año
mysqli_stmt_bind_param($stmt, "s", $prefix);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $last_matricula);
mysqli_stmt_fetch($stmt);

if ($last_matricula) {
    // Extraer el número secuencial y sumarle 1
    $ultimo_numero = intval(substr($last_matricula, 4)) + 1;
} else {
    // Primera matrícula del año
    $ultimo_numero = 1;
}

// Formatear matrícula (ejemplo: 20240001)
$matricula = $anio_actual . str_pad($ultimo_numero, 4, "0", STR_PAD_LEFT);

mysqli_stmt_close($stmt);

// Insertar en la base de datos con la nueva matrícula
$query = "INSERT INTO alumnos (matricula, nombre, apellidop, apellidom, nivel, grado, grupo) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "sssssss", $matricula, $nombre, $apellidop, $apellidom, $nivel, $grado, $grupo);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status" => "success", "message" => "Registro exitoso", "matricula" => $matricula]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conexion)]);
}

// Cerrar conexión
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>

