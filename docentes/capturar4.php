<?php
include_once "vistas/sidebar.php";
include 'bd/conexion.php';

// Recibimos las variables de la URL
$numero = $_GET["id_periodo"];
$id_campo = $_GET['campo'];
$campo = $_GET["campo_formativo"];

// Definimos el nivel que queremos filtrar (en este caso, "Primaria")
$nivel_filtrado = "Primaria"; // Puedes cambiar esto o pasarlo como parámetro

// Obtenemos el grupo desde la URL o la sesión
$grupo_filtrado = isset($_GET['grupo']) ? $_GET['grupo'] : 'A'; // Valor por defecto 'A'
?>

<div class="container">
    <p class="h6">Periodo: <?php echo "$numero"; ?>° trimestre</p>
    <p class="h6">Campo formativo: <?php echo "$campo"; ?></p>
    <p class="h6">Nivel: <?php echo $nivel_filtrado; ?></p> <!-- Mostramos el nivel filtrado -->
    <p class="h6">Grupo: <?php echo $grupo_filtrado; ?></p> <!-- Mostramos el grupo filtrado -->

    <?php
    $usuario = $_SESSION['usuario'];
    $grado4 = $_SESSION['grado4'];

    // Consulta para obtener los alumnos del nivel "Primaria", del grado específico y del grupo correcto
    $alumnos2 = "SELECT * FROM alumnos WHERE grado IN ($grado4) AND nivel = '$nivel_filtrado' AND grupo = '$grupo_filtrado'";
    $resultado = $conexion->query($alumnos2);

    // Consulta para verificar si las calificaciones ya fueron capturadas
    $teku = mysqli_query($conexion, "SELECT alumnos.Id_alumno, Nombre, grado, nivel, grupo, Id_asignatura, Id_periodo 
                                     FROM alumnos 
                                     INNER JOIN calificaciones ON alumnos.Id_alumno = calificaciones.id_alumno 
                                     WHERE grado = $grado4 AND id_asignatura = $id_campo AND id_periodo = $numero 
                                     AND nivel = '$nivel_filtrado' AND grupo = '$grupo_filtrado'
                                     ORDER BY Apellidop;");

    // Consulta para obtener todos los alumnos del grado, nivel y grupo específico
    $alumnos = mysqli_query($conexion, "SELECT Id_alumno FROM alumnos WHERE grado = $grado4 AND nivel = '$nivel_filtrado' AND grupo = '$grupo_filtrado'");

    if (mysqli_num_rows($teku) == mysqli_num_rows($alumnos)) {
    ?>
        <script type="text/javascript">
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '¡Las calificaciones ya fueron capturadas!',
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                timer: 20000
            });
        </script>
    <?php
    } else {
    ?>
        <br>
        <form action="" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th style="display: none;">Id_alumno</th>
                        <th>Matrícula</th>
                        <th>Nombre del alumno</th>
                        <th>Grado</th>
                        <th>Grupo</th> <!-- Columna: grupo -->
                        <th>Nivel</th>
                        <th style="display: none;">id_asignatura</th>
                        <th style="display: none;">id_periodo</th>
                        <th>Calificación</th>
                        <th>Observaciones</th> <!-- Nueva columna para observaciones -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td style="display: none;">
                                <input type="hidden" name='Id_alumno[]' value="<?php echo $row['Id_alumno']; ?>">
                            </td>
                            <td><?php echo $row['Matricula']; ?></td>
                            <td><?php echo $row['Apellidop'] . ' ' . $row['Apellidom'] . ' ' . $row['Nombre']; ?></td>
                            <td><?php echo $row['grado']; ?></td> <!-- Columna: grado -->
                            <td><?php echo $row['grupo']; ?></td> <!-- Columna: grupo -->
                            <td><?php echo $row['nivel']; ?></td> <!-- Columna: nivel -->
                            <td style="display: none;">
                                <input type="hidden" name="id_campo[]" value='<?php echo $id_campo; ?>'>
                            </td>
                            <td style="display: none;">
                                <input type="hidden" name="periodo[]" value='<?php echo $numero; ?>'>
                            </td>
                            <td>
                                <input type="number" class="form-control" min="5" max="10" name='calificacion[]' required>
                            </td>
                            <td>
                                <textarea class="form-control" name="observaciones[]" rows="1"></textarea> <!-- Campo de texto para observaciones -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <center>
                <input type="submit" value="Capturar calificaciones" name="calificar" class="btn btn-success">
            </center>
        </form>
    <?php
    }

    // Procesar el formulario de calificaciones
    if (isset($_POST['calificar'])) {
        $Id_alumnos = $_POST['Id_alumno'];
        $calificaciones = $_POST['calificacion'];
        $id_periodos = $_POST['periodo'];
        $id_campos = $_POST['id_campo'];
        $observaciones = $_POST['observaciones']; // Recuperar las observaciones

        for ($i = 0; $i < count($Id_alumnos); $i++) {
            $Id_alumno = $Id_alumnos[$i];
            $calificacion = $calificaciones[$i];
            $id_periodo = $id_periodos[$i];
            $id_campo = $id_campos[$i];
            $observacion = mysqli_real_escape_string($conexion, $observaciones[$i]); // Escapar la observación para evitar SQL injection

            if ($calificacion >= 5 && $calificacion <= 10) {
                $calificar = mysqli_query($conexion, "INSERT INTO calificaciones (Id_alumno, id_asignatura, id_periodo, calificacion, observaciones) 
                                                       VALUES ($Id_alumno, $id_campo, $id_periodo, $calificacion, '$observacion')");
            } else {
            ?>
                <script type="text/javascript">
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: '¡Hubo un error inténtelo de nuevo!',
                        showConfirmButton: true,
                        confirmButtonText: 'Aceptar',
                        timer: 20000
                    });
                </script>
            <?php
            }
        }
        ?>
        <script>
            alert('¡Se ha realizado la captura de calificaciones y observaciones correctamente!');
            window.location.href = "tcapturar4.php";
        </script>
    <?php
    }
    ?>
</div>