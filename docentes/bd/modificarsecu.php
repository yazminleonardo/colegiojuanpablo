<?php
include 'conexion.php'; 

// Verificar si los valores existen en $_POST antes de asignarlos
$calificacion = isset($_POST['calificacion']) ? $_POST['calificacion'] : 0;
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$periodo = isset($_POST['periodo']) ? $_POST['periodo'] : 0;
$asignatura = isset($_POST['asignatura']) ? $_POST['asignatura'] : '';
$motivo = isset($_POST['motivo']) ? $_POST['motivo'] : '';
$id_calificacion = isset($_POST['id_notas']) ? $_POST['id_notas'] : 0; // Asignamos 0 si no existe

// Verificar si la conexión es válida
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Preparar la consulta para evitar inyección SQL
$stmt = $conexion->prepare("INSERT INTO modificarsecu VALUES (NULL, ?, ?, 'Espera', ?, ?, ?, ?)");
$stmt->bind_param("iissii", $calificacion, $periodo, $asignatura, $motivo, $id, $id_calificacion);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    echo "<script>
        alert('Solicitud enviada, espere su respuesta.');
        window.location.href = '../modificar_calificacionessecu1.php';
    </script>";
} else {
    echo "<script>
        alert('Error al enviar la solicitud. Por favor, intente de nuevo.');
        window.history.back();
    </script>";
}

// Cerrar la consulta y la conexión
$stmt->close();
$conexion->close();
?>