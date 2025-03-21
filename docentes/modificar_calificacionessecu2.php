<?php
include 'bd/conexion.php';
include_once "vistas/sidebar.php";
?>

<label class="h5 fw-bold">Ingrese los siguientes datos:</label><br>
<label class="h6 fw-bold">Trimestre:</label> <label>Trimestre escolar en el que se encuentra la calificación que desea modificar.</label><br>
<label class="h6 fw-bold">Campo formativo:</label> <label>El campo formativo a la que pertenece la calificación.</label><br>
<label class="h6 fw-bold">Matrícula:</label> <label>La matrícula del alumno a quien pertenece la calificación.</label><br><br>

<form method="post" class="d-flex row g-3">
    <div class="col-md-3">
        <label class="form-label fw-bold">Selecciona el trimestre:</label>
        <select name="periodo" id="" class="form-select">
            <option value="1">1° Trimestre</option>
            <option value="2">2° Trimestre</option>
            <option value="3">3° Trimestre</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-bold">Selecciona el campo formativo:</label>
        <select name="asignatura" id="" class="form-select">
            <?php
            // Consulta para obtener solo algunas asignaturas específicas desde la base de datos
            $filtro_asignaturas = "id_asignatura IN (1, 2, 3, 4, 42, 7, 8, 10, 11)"; // Cambia esto según tus necesidades
            $consulta_asignaturas = $conexion->query("SELECT id_asignatura, campo_formativo FROM campos WHERE $filtro_asignaturas");
            
            while ($fila = $consulta_asignaturas->fetch_assoc()) {
                echo '<option value="' . $fila['id_asignatura'] . '">' . $fila['campo_formativo'] . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="col-md-4">
        <label for="" class="form-label fw-bold">Ingrese la matrícula del alumno:</label>
        <div class="input-group">
            <input type="text" name="matricula" id="" class="form-control">
            <input type="submit" class="btn btn-success" value="Buscar" name="solicitud" onclick="solicitud()"/>
        </div>
    </div>
</form>

<?php 
if (isset($_POST['solicitud'])) {
    $matricula = $_POST['matricula'];
    $periodo = $_POST['periodo'];
    $grado1 = $_SESSION['grado1'];
    $grado2 = $_SESSION['grado2'];
    $asignatura = $_POST['asignatura'];

    // Consulta SQL modificada para usar la tabla `secu`
    $vista = $conexion->prepare("SELECT alumnos.Id_alumno, alumnos.Matricula, secu.id_notas, alumnos.Nombre, alumnos.Apellidop, Apellidom, campos.campo_formativo, secu.calificaciones, campos.id_asignatura
        FROM secu
        INNER JOIN alumnos ON secu.id_alumnos = alumnos.Id_alumno
        INNER JOIN campos ON secu.id_asignaturas = campos.id_asignatura 
        WHERE secu.id_asignaturas = ? AND Matricula = ? AND grado = ? AND id_periodos = ? 
        ORDER BY Apellidop");
    
    $vista->bind_param("isii", $asignatura, $matricula, $grado2, $periodo);
    $vista->execute();
    $resultados = $vista->get_result();

    if ($resultados->num_rows > 0) {
?>
<br>
<label class="form-label fw-bold">Trimestre: <?php echo "$periodo" ?>° Trimestre</label><br>
<label class="form-label fw-bold">Grado: <?php echo "$grado2" ?>°</label><br>
<label class="form-label fw-bold">Grupo: A</label>
<br>
<form action="bd/modificarsecu2.php" method="POST">
    <table class="content-table table">
        <thead>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Calificación</th>
            <th>Motivo de modificación</th>
        </thead>

        <tbody>
            <?php 
            while ($alumno = $resultados->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $alumno['Matricula'] . '</td>';
                echo '<td>' . $alumno['Apellidop'] . " " . $alumno['Apellidom'] . " " . $alumno['Nombre'] . '</td>';
                echo '<input type="hidden" name="id" value="' . $alumno['Id_alumno'] . '">';
                echo '<input type="hidden" name="id_notas" value="' . $alumno['id_notas'] . '">';
                echo '<input type="hidden" name="asignatura" value="' . $alumno['id_asignatura'] . '">';
                echo '<input type="hidden" name="periodo" value="' . $periodo . '">';
                
                // Mostrar la calificación y campo para el motivo de modificación
                echo '<td><label class="form-label fw-bold">Reescriba la calificación:</label>
                      <input type="number" value="' . $alumno['calificaciones'] . '" name="calificacion" class="form-control" min="0" max="10" required></td>';
                echo '<td><input type="text" name="motivo" class="form-control" required></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <center><input type="submit" value="Enviar solicitud" class="btn btn-success"></center>
</form>
<?php
    } else {
        echo '<div class="alert alert-warning">No se encontraron calificaciones para los criterios seleccionados.</div>';
    }
} else {
    echo '<div class="alert alert-info">Ingrese los datos y haga clic en "Buscar" para ver las calificaciones.</div>';
}

include_once "vistas/footer.php";
?>