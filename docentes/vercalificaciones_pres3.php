<?php
include 'bd/conexion.php';
include_once "vistas/sidebar.php";
?>

<!-- Formulario para consultar un alumno por matrícula -->
<label class="form-label h5 fw-bold">Ingrese la matrícula del alumno</label>
<form method="post" class="d-flex">
    <input type="text" class="form-control" name="matricula" placeholder="Matrícula" style="width: 200px;"/>
    <select class="form-select mx-2" name="periodo" style="width: 200px;">
        <option value="1">1° Trimestre</option>
        <option value="2">2° Trimestre</option>
        <option value="3">3° Trimestre</option>
    </select>
    <input type="submit" class="btn btn-success" value="Consultar" name="consultarAlumno"/>
</form>

<!-- Formulario para consultar todas las calificaciones del trimestre -->
<label class="form-label h5 fw-bold mt-3">Selecciona el trimestre</label>
<form method="post" class="d-flex">
    <select class="form-select" name="periodo" style="width: 200px;">
        <option value="1">1° Trimestre</option>
        <option value="2">2° Trimestre</option>
        <option value="3">3° Trimestre</option>
    </select>
    <input type="submit" class="btn btn-success" value="Consultar" name="solicitud"/>
</form>

<?php
if (isset($_POST['consultarAlumno']) && !empty($_POST['matricula'])) {
    $matricula_alumno = $_POST['matricula'];
    $periodo = $_POST['periodo'];

    // Consulta SQL para obtener las calificaciones de la tabla prescolar
    $vista = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, 
                                        campos.campo_formativo, prescolar.calificacion
                                 FROM prescolar
                                 INNER JOIN alumnos ON prescolar.id_alumno = alumnos.Id_alumno
                                 INNER JOIN campos ON prescolar.id_asignatura = campos.id_asignatura
                                 WHERE alumnos.Matricula = ? AND prescolar.id_periodo = ?
                                 ORDER BY campos.campo_formativo");

    $vista->bind_param("si", $matricula_alumno, $periodo);
    $vista->execute();
    $resultado = $vista->get_result();

    $calificaciones = [];
    while ($row = $resultado->fetch_assoc()) {
        $calificaciones[] = $row;
    }

    if (empty($calificaciones)) {
        echo "<p class='text-warning'>No se encontraron calificaciones para esta matrícula en el trimestre seleccionado.</p>";
    } else {
        ?>
        <br>
        <form action="reportespres3.pdf.php" method="post" target="_blank">
            <input type="hidden" name="matricula" value="<?= htmlspecialchars($matricula_alumno) ?>">
            <input type="hidden" name="periodo" value="<?= htmlspecialchars($periodo) ?>">

            <table class="content-table table">
                <thead>
                    <tr>
                        <th class="vertical-text">Matricula</th>
                        <th class="vertical-text">Nombre</th>
                        <?php 
                        $asignaturas = array_unique(array_column($calificaciones, 'campo_formativo'));
                        foreach ($asignaturas as $asignatura) {
                            echo '<th class="vertical-text">' . htmlspecialchars($asignatura) . '</th>';
                        }
                        //echo '<th>Promedio</th>';
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($calificaciones[0]['Matricula']) ?></td>
                        <td><?= htmlspecialchars($calificaciones[0]['Apellidop'] . " " . $calificaciones[0]['Apellidom'] . " " . $calificaciones[0]['Nombre']) ?></td>
                        <?php 
                        $sumaCalificaciones = 0;
                        $numCalificaciones = 0;

                        foreach ($asignaturas as $asignatura) {
                            $calificacion = '';
                            foreach ($calificaciones as $cal_row) {
                                if ($cal_row['campo_formativo'] == $asignatura) {
                                    $calificacion = $cal_row['calificacion'];
                                    $sumaCalificaciones += floatval($calificacion);
                                    $numCalificaciones++;
                                    break;
                                }
                            }
                            echo '<td class="vert-text">' . htmlspecialchars($calificacion) . '</td>';
                        }
                        /*$promedio = ($numCalificaciones > 0) ? $sumaCalificaciones / $numCalificaciones : 0;
                        echo '<td>' . number_format($promedio, 2) . '</td>';*/
                        ?>
                    </tr>
                </tbody>
            </table>

            <div style="text-align:right;">
                <button type="submit" class="btn btn-danger" name="generarReporte">
                    <i class="bi bi-filetype-pdf"></i> Generar reporte individual
                </button>
            </div>
        </form>
        <?php
    }
}

if (isset($_POST['solicitud'])) {
    $periodo = $_POST['periodo'];
    /*$grado1 = $_SESSION['grado1'];
    $grado2 = $_SESSION['grado2'];
    $grado3 = $_SESSION['grado3'];*/

    // Consulta SQL para obtener las calificaciones de la tabla prescolar
    $vista = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, 
                                        campos.campo_formativo, prescolar.calificacion
                                 FROM prescolar
                                 INNER JOIN alumnos ON prescolar.id_alumno = alumnos.Id_alumno
                                 INNER JOIN campos ON prescolar.id_asignatura = campos.id_asignatura
                                 WHERE grado = 3 AND prescolar.id_periodo = ?
                                 ORDER BY Apellidop");
    $vista->bind_param("i", $periodo);
    $vista->execute();
    $resultado = $vista->get_result();

    ?>
    <br>
    <form action="" method="POST">
    <div class="table-responsive">
        <table class="content-table table">
            <thead>
                <th class="vertical-text">Matricula</th>
                <th class="vertical-text">Nombre</th>
                <?php 
                $asignaturas = array(); // Array para almacenar las asignaturas únicas
                foreach ($resultado as $row) {
                    $asignatura = $row['campo_formativo'];
                    if (!in_array($asignatura, $asignaturas)) {
                        $asignaturas[] = $asignatura; // Agrega la asignatura al array si no existe
                        echo '<th class="vertical-text">' . $asignatura . '</th>';
                    }
                }
                //echo '<th>Promedio</th>'; // Agrega la columna para el promedio
                ?>
            </thead>

            <tbody>
                <?php 
                $alumno_actual = null; // Variable para almacenar el ID del alumno actual
                foreach ($resultado as $row) { 
                    if ($row['Matricula'] != $alumno_actual) {
                        // Imprime la información del alumno solo si ha cambiado
                        echo '<tr>';
                        echo '<td>' . $row['Matricula'] . '</td>';
                        echo '<td>' . $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre'] . '</td>';
                        $alumno_actual = $row['Matricula'];
                        $sumaCalificaciones = 0; // Variable para almacenar la suma de calificaciones
                        $numCalificaciones = 0; // Variable para almacenar el número de calificaciones

                        // Impresión de calificaciones para este alumno
                        foreach ($asignaturas as $asignatura) {
                            // Busca la calificación correspondiente a la asignatura actual
                            $calificacion = '';
                            foreach ($resultado as $cal_row) {
                                if ($cal_row['Matricula'] == $alumno_actual && $cal_row['campo_formativo'] == $asignatura) {
                                    $calificacion = $cal_row['calificacion'];
                                    
                                    // Acumula la calificación para calcular el promedio
                                    $sumaCalificaciones += floatval($calificacion);
                                    $numCalificaciones++;
                                    break;
                                }
                            }
                            
                            // Imprime la calificación o celda vacía
                            echo '<td class="vert-text">' . $calificacion . '</td>';
                        }
                        // Calcula el promedio y lo imprime
                        /*$promedio = ($numCalificaciones > 0) ? $sumaCalificaciones / $numCalificaciones : 0;
                        echo '<td>' . number_format($promedio, 2) . '</td>';*/
                        // Cierra la fila del alumno
                        echo '</tr>';
                    }
                } ?>
            </tbody>
        </table>
    </form>
    <?php
}

include_once "vistas/footer.php";
?>
<style>
    .vertical-text {
        text-align: center;
        font-size: 15px;
}
.vert-text {
    text-align: justify;
    font-size: 13px;
}

/* Estilo para la tabla */
th, td {
    min-width: 50px; /* Ancho uniforme */
    padding: 5px;
    border: 1px solid #ccc; /* Bordes para mejor visualización */
}
.table-responsive {
    overflow-x: auto; /* Permite el scroll horizontal */
    max-width: 100%; /* Evita que la tabla se salga del contenedor */
}
</style>