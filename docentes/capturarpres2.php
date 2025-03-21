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

// Definimos el nivel que queremos filtrar (en este caso, "Preescolar")
$nivel_filtrado = "Preescolar"; // Puedes cambiar esto o pasarlo como parámetro

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
    $grado1 = $_SESSION['grado1'];

    // Consulta para obtener los alumnos del nivel "Preescolar", del grado específico y del grupo correcto
    $alumnos2 = "SELECT * FROM alumnos WHERE grado IN ($grado1) AND nivel = '$nivel_filtrado' AND grupo = '$grupo_filtrado'";
    $resultado = $conexion->query($alumnos2);

    // Consulta para verificar si las calificaciones ya fueron capturadas
    $query = "SELECT alumnos.Id_alumno, Nombre, grado, nivel, grupo, Id_asignatura, Id_periodo 
              FROM alumnos 
              INNER JOIN prescolar ON alumnos.Id_alumno = prescolar.id_alumno 
              WHERE grado = ? AND id_asignatura = ? AND id_periodo = ? 
              AND nivel = ? AND grupo = ?
              ORDER BY Apellidop;";
    $stmt = $conexion->prepare($query);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }
    $stmt->bind_param("iiiss", $grado1, $id_campo, $numero, $nivel_filtrado, $grupo_filtrado);
    $stmt->execute();
    $teku = $stmt->get_result();

    // Consulta para obtener todos los alumnos del grado, nivel y grupo específico
    $alumnos = mysqli_query($conexion, "SELECT Id_alumno FROM alumnos WHERE grado = $grado1 AND nivel = '$nivel_filtrado' AND grupo = '$grupo_filtrado'");

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
        <form action="" method="post" onsubmit="return validarCalificaciones()">
            <table class="table">
                <thead>
                    <tr>
                        <th style="display: none;">Id_alumno</th>
                        <th>Matrícula</th>
                        <th>Nombre del alumno</th>
                        <th>Grado</th>
                        <th>Grupo</th>
                        <th>Nivel</th>
                        <th style="display: none;">id_asignatura</th>
                        <th style="display: none;">id_periodo</th>
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
                                <textarea class="form-control" name='calificacion[]' rows="3" required></textarea>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <center>
                <input type="submit" value="Capturar calificaciones" name="calificar" class="btn btn-success">
            </center>
        </form>

        <!-- Validación en el frontend con JavaScript -->
        <script>
            function validarCalificaciones() {
                var inputs = document.querySelectorAll('textarea[name="calificacion[]"]');
                var valid = true;
                inputs.forEach(function(input) {
                    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s.,;:!?()-1234567890]+$/.test(input.value.trim())) {
                        valid = false;
                        input.style.borderColor = 'red';
                    } else {
                        input.style.borderColor = '';
                    }
                });
                if (!valid) {
                    alert('Por favor, ingrese solo letras, espacios y signos de puntuación en las calificaciones.');
                    return false;
                }
                return true;
            }
        </script>
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
            $calificacion = trim($calificaciones[$i]); // Eliminar espacios en blanco al inicio y final
            $id_periodo = $id_periodos[$i];
            $id_campo = $id_campos[$i];

            // Validar que la calificación no esté vacía y sea un texto válido
            if (!empty($calificacion) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s.,;:!?()-1234567890]+$/', $calificacion)) {
                $calificar = mysqli_query($conexion, "INSERT INTO prescolar (id_alumno, id_asignatura, id_periodo, calificacion, fecha_captura) 
                                                      VALUES ($Id_alumno, $id_campo, $id_periodo, '$calificacion', NOW())");
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
            window.location.href = "capturapres1.php";
        </script>
        <?php
    }
    ?>
</div>