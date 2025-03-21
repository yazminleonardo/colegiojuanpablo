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
            $filtro_asignaturas = "id_asignatura IN (23, 24, 25, 26, 27, 28, 29, 30, 31, 32)"; // Cambia esto según tus necesidades
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

    // Consulta SQL modificada para usar la tabla `prescolar`
    $vista = $conexion->prepare("SELECT alumnos.Id_alumno, alumnos.Matricula, prescolar.id_calificaciones, alumnos.Nombre, alumnos.Apellidop, Apellidom, campos.campo_formativo, prescolar.calificacion, campos.id_asignatura
        FROM prescolar
        INNER JOIN alumnos ON prescolar.Id_alumno = alumnos.Id_alumno
        INNER JOIN campos ON prescolar.id_asignatura = campos.id_asignatura 
        WHERE prescolar.id_asignatura = ? AND Matricula = ? AND grado = ? AND id_periodo = ? 
        ORDER BY Apellidop");
    
    $vista->bind_param("isii", $asignatura, $matricula, $grado1, $periodo);
    $vista->execute();
    $resultados = $vista->get_result();
?>
<br>
<label class="form-label fw-bold">Trimestre: <?php echo "$periodo" ?>° Trimestre</label><br>
<label class="form-label fw-bold">Grado: <?php echo "$grado1" ?>°</label><br>
<br>
<form action="bd/modificarpres.php" method="POST">
    <table class="content-table table">
        <thead>
            <th>Matricula</th>
            <th>Nombre</th>

            <?php 
            $asignaturas = array(); // Array para almacenar las asignaturas únicas
            foreach ($resultados as $row) {
                $asignatura = $row['campo_formativo'];
                if (!in_array($asignatura, $asignaturas)) {
                    $asignaturas[] = $asignatura; // Agrega la asignatura al array si no existe
                    echo '<th>' . $asignatura . '</th>';
                }
            }
            ?>
            
            <th>Motivo de modificación</th>
        </thead>

        <tbody>
            <?php 
            foreach ($resultados as $alumno) {
                echo '<tr>';

                echo '<td>' . $alumno['Matricula'] . '</td>';
                echo '<td>' . $alumno['Apellidop'] . " " . $alumno['Apellidom'] . " " . $alumno['Nombre'] . '</td>';
                echo '<input type="hidden" name="id" value="' . $alumno['Id_alumno'] . '">';
                echo '<input type="hidden" name="id_calificaciones" value="' . $alumno['id_calificaciones'] . '">';
                echo '<input type="hidden" name="asignatura" value="' . $alumno['id_asignatura'] . '">';
                echo '<input type="hidden" name="periodo" value="' . $periodo . '">';
                
                $sumaCalificaciones = 0; // Variable para almacenar la suma de calificaciones
                $numCalificaciones = 0; // Variable para almacenar el número de calificaciones
                
                // Impresión de calificaciones para este alumno
                foreach ($asignaturas as $asignatura) {
                    // Busca la calificación correspondiente a la asignatura actual
                    $calificacion = '';
                    foreach ($resultados as $cal_row) {
                        if ($cal_row['Matricula'] == $alumno['Matricula'] && $cal_row['campo_formativo'] == $asignatura) {
                            $calificacion = $cal_row['calificacion'];

                            // Acumula la calificación para calcular el promedio
                            $sumaCalificaciones += floatval($calificacion);
                            $numCalificaciones++;

                            break;
                        }
                    }

                    // Imprime la calificación o celda vacía
                    echo '<td><label class="form-label fw-bold">Reescriba la calificación:</label>
                    <input type="number" value="' . $calificacion . '" name="calificacion" class="form-control" min="0" max="10" required></td>';
                    echo '<td><input type="text" name="motivo" class="form-control" required></td>';
                }
            }
            ?>
        </tbody>
    </table>
        <center><input type="submit" value="Enviar solicitud" class="btn btn-success"></center>
</form>
<?php
} else {
    echo '<td><label class="form-label fw-bold">No se encontraron datos</label>';
}
// Fin del if (isset($_POST['solicitud']))

include_once "vistas/footer.php";
?>