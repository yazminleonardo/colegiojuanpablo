<?php 
ob_start(); // Inicia el búfer de salida

include_once "vistas/sidebar.php"; 
include "bd/conexion.php";

// Consulta para obtener las calificaciones a modificar
$vista = $conexion->prepare("
    SELECT 
        alumnos.Id_alumno, secu.id_notas, alumnos.Matricula, alumnos.Nombre, 
        alumnos.Apellidop, alumnos.Apellidom, campos.campo_formativo, 
        secu.calificaciones, modificarsecu.calificacion, 
        modificarsecu.motivo, modificarsecu.id_periodo
    FROM modificarsecu
    INNER JOIN secu ON modificarsecu.id_calificacion = secu.id_notas
    INNER JOIN alumnos ON modificarsecu.id_alumno = alumnos.Id_alumno
    INNER JOIN campos ON modificarsecu.id_asignatura = campos.id_asignatura 
    WHERE estado='Espera';
");

$vista->execute();
$resultados = $vista->get_result();

// Verifica si hay calificaciones pendientes de modificación
$revision = mysqli_query($conexion, "SELECT id FROM modificarsecu WHERE estado='Espera'");
if (mysqli_num_rows($revision) == 0) {
    echo "<script>
        alert('No hay calificaciones por modificar');
        window.location.href='index_admin.php';
    </script>";
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
        $id = $_POST['xyz'];
        $calificacion = $_POST['c'];

        if (isset($_POST['aprobar'])) {
            $aceptado = mysqli_query($conexion, "UPDATE secu SET calificaciones=$calificacion WHERE id_notas=$id");
            $cambio = mysqli_query($conexion, "UPDATE modificarsecu SET estado='Aprobado' WHERE id_calificacion=$id");
        } elseif (isset($_POST['rechazar'])) {
            $cambio = mysqli_query($conexion, "UPDATE modificarsecu SET estado='Rechazado' WHERE id_calificacion=$id");
        }

        // Redirigir a la misma página para evitar reenvío del formulario
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

ob_end_flush(); // Envía el búfer de salida al navegador
?>

<label class="h3">Solicitudes para modificación de calificación</label>
<form action="" method="POST">
    <table class="content-table table table-bordered">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Campo</th>
                <th>Periodo</th>
                <th>Calificación actual</th>
                <th>Nueva calificación</th>
                <th>Motivo</th>
                <th colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php foreach ($resultados as $row): ?>
            <tr>
                <td><?= $row['Matricula']; ?></td>
                <td><?= $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre']; ?></td>
                <td><?= $row['campo_formativo']; ?></td>
                <td><?= $row['id_periodo']; ?></td>
                <td><?= $row['calificaciones']; ?></td>
                <td><?= $row['calificacion']; ?></td>
                <td><?= $row['motivo']; ?></td>
                <td>
                    <input type="hidden" name="xyz" value="<?= $row['id_notas']; ?>">
                    <input type="hidden" name="c" value="<?= $row['calificacion']; ?>">
                    <button type="submit" name="aprobar" value="<?= $row['Id_alumno']; ?>" class="btn btn-success">Aprobar</button>
                </td>
                <td>
                    <button type="submit" name="rechazar" value="<?= $row['Id_alumno']; ?>" class="btn btn-danger">Rechazar</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</form>