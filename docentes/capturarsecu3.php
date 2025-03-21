<?php
include_once "vistas/sidebar.php";
include 'bd/conexion.php';

// Recibimos las variables de la URL
$numero = isset($_GET["id_periodo"]) ? $_GET["id_periodo"] : null;
$id_campo = isset($_GET['campo']) ? $_GET['campo'] : null;
$campo = isset($_GET["campo_formativo"]) ? $_GET["campo_formativo"] : null;

// Verificamos que las variables necesarias estén definidas
if ($numero === null || $id_campo === null || $campo === null) {
    die("");
}

// Definimos el nivel que queremos filtrar (en este caso, "Secundaria")
$nivel_filtrado = "Secundaria"; // Puedes cambiar esto o pasarlo como parámetro

// Obtenemos el grupo desde la URL o la sesión
$grupo_filtrado = isset($_GET['grupo']) ? $_GET['grupo'] : 'A'; // Valor por defecto 'A'
?>

<div class="container">
    <p class="h6">Periodo: <?php echo htmlspecialchars($numero); ?>° trimestre</p>
    <p class="h6">Campo formativo: <?php echo htmlspecialchars($campo); ?></p>
    <p class="h6">Nivel: <?php echo htmlspecialchars($nivel_filtrado); ?></p>
    <p class="h6">Grupo: <?php echo htmlspecialchars($grupo_filtrado); ?></p>

    <?php
    $usuario = $_SESSION['usuario'];
    $grado3 = $_SESSION['grado3'];

    // Consulta para obtener los alumnos del nivel "Secundaria", del grado específico y del grupo correcto
    $alumnos2 = "SELECT * FROM alumnos WHERE grado IN ($grado3) AND nivel = '$nivel_filtrado' AND grupo = '$grupo_filtrado'";
    $resultado = $conexion->query($alumnos2);

    // Consulta para verificar si las calificaciones ya fueron capturadas
    $query = "SELECT alumnos.Id_alumno, Nombre, grado, nivel, grupo, id_asignaturas, id_periodos 
              FROM alumnos 
              INNER JOIN secu ON alumnos.Id_alumno = secu.id_alumnos 
              WHERE grado = ? AND id_asignaturas = ? AND id_periodos = ? 
              AND nivel = ? AND grupo = ?
              ORDER BY Apellidop;";
    $stmt = $conexion->prepare($query);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }
    $stmt->bind_param("iiiss", $grado3, $id_campo, $numero, $nivel_filtrado, $grupo_filtrado);
    $stmt->execute();
    $teku = $stmt->get_result();

    // Consulta para obtener todos los alumnos del grado, nivel y grupo específico
    $alumnos = mysqli_query($conexion, "SELECT Id_alumno FROM alumnos WHERE grado = $grado3 AND nivel = '$nivel_filtrado' AND grupo = '$grupo_filtrado'");

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
                        <th>Grupo</th>
                        <th>Nivel</th>
                        <th style="display: none;">id_asignaturas</th>
                        <th style="display: none;">id_periodos</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td style="display: none;">
                                <input type="hidden" name='Id_alumno[]' value="<?php echo $row['Id_alumno']; ?>">
                            </td>
                            <td><?php echo htmlspecialchars($row['Matricula']); ?></td>
                            <td><?php echo htmlspecialchars($row['Apellidop'] . ' ' . $row['Apellidom'] . ' ' . $row['Nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['grado']); ?></td>
                            <td><?php echo htmlspecialchars($row['grupo']); ?></td>
                            <td><?php echo htmlspecialchars($row['nivel']); ?></td>
                            <td style="display: none;">
                                <input type="hidden" name="id_campo[]" value='<?php echo htmlspecialchars($id_campo); ?>'>
                            </td>
                            <td style="display: none;">
                                <input type="hidden" name="periodo[]" value='<?php echo htmlspecialchars($numero); ?>'>
                            </td>
                            <td>
                                <input type="number" class="form-control" min="5" max="10" name='calificacion[]' required>
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

        for ($i = 0; $i < count($Id_alumnos); $i++) {
            $Id_alumno = $Id_alumnos[$i];
            $calificacion = $calificaciones[$i];
            $id_periodo = $id_periodos[$i];
            $id_campo = $id_campos[$i];

            if ($calificacion >= 5 && $calificacion <= 10) {
                $fecha_captura = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual
                $calificar = mysqli_query($conexion, "INSERT INTO secu (id_alumnos, id_asignaturas, id_periodos, calificaciones, fecha_captura) 
                                                      VALUES ($Id_alumno, $id_campo, $id_periodo, $calificacion, '$fecha_captura')");
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
            alert('¡Se ha realizado la captura de calificaciones correctamente!');
            window.location.href = "capturasecu3.php";
        </script>
    <?php
    }
    ?>
</div>