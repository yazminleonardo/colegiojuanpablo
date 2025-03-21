<?php

require 'conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el array 'asistencia' está presente en $_POST
    if (isset($_POST['asistencia']) && is_array($_POST['asistencia'])) {
        foreach ($_POST['asistencia'] as $id_alumno => $asistencia_data) {
            // Validar y procesar los datos según tus necesidades
            $id_alumno = $asistencia_data['id_alumno'];
            $estado = $asistencia_data['estado'];

            // Realizar las operaciones en la base de datos
            
            $sql = mysqli_query($conexion, "INSERT INTO asistencias VALUES ($id_alumno, CURDATE(), '$estado', null)");
        }

        // Hacer redirección o mostrar mensajes según tus necesidades
        if ( $sql) {
            ?>
            <script>
                alert('las asistencias han sido registradas');
                window.location.href = "../insertar_asistencia.php";
            </script>
            <?php
        } else {
            echo "Error al insertar el registro.";
        }
    } else {
        echo "No se recibieron datos de asistencia.";
    }
} else {
    echo "Acceso no permitido.";
}

?>