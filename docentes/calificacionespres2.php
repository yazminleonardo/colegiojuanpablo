<?php
include 'bd/conexion.php';
include_once "vistas/sidebar.php";
?>

<h4>Gestor de calificaciones 2° preescolar</h4>
<br>
    <div class="row g-4">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-sm">
                <a href="capturapres2-5.php" class="text-decoration-none text-dark">
                    <div class="card-content">
                        <div class="card-body">
                            <h5><i class="bi bi-file-earmark-arrow-up"></i> Capturar calificaciones</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-sm">
                <a href="vercalificaciones_pres2.php" class="text-decoration-none text-dark">
                    <div class="card-content">
                        <div class="card-body">
                            <h5><i class="bi bi-search"></i> Consultar calificaciones</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!--<div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-sm">
                <a href="modificar_calificacionespres2.php" class="text-decoration-none text-dark">
                    <div class="card-content">
                        <div class="card-body">
                            <h5><i class="bi bi-pencil-square"></i> Modificar calificaciones</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>-->
    </div>
</div>

<?php if(isset($_POST['solicitud'])) {
    $periodo = $_POST['periodo'];
    $grado2 = $_SESSION['grado2'];
    
    $vista = $conexion->prepare("SELECT alumnos.Matricula, alumnos.Nombre, alumnos.Apellidop, alumnos.Apellidom, campos.campo_formativo, calificaciones.calificacion
        FROM calificaciones
        INNER JOIN alumnos ON calificaciones.Id_alumno = alumnos.Id_alumno
        INNER JOIN campos ON calificaciones.id_asignatura = campos.id_asignatura
        WHERE grado=? AND id_periodo=?
        ORDER BY Apellidop");
    $vista->bind_param("ii", $grado2, $periodo);
    $vista->execute();
    $resultado = $vista->get_result();
    ?>
    <br>
    <form action="" method="POST">
        <table class="table">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <?php 
                    $asignaturas = [];
                    foreach ($resultado as $row) {
                        if (!in_array($row['campo_formativo'], $asignaturas)) {
                            $asignaturas[] = $row['campo_formativo'];
                            echo '<th>' . $row['campo_formativo'] . '</th>';
                        }
                    }
                    echo '<th>Promedio</th>';
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $alumnos = [];
                foreach ($resultado as $row) {
                    $alumnos[$row['Matricula']]['info'] = $row;
                    $alumnos[$row['Matricula']]['calificaciones'][$row['campo_formativo']] = $row['calificacion'];
                }
                foreach ($alumnos as $matricula => $datos) {
                    echo '<tr>';
                    echo '<td>' . $matricula . '</td>';
                    echo '<td>' . $datos['info']['Apellidop'] . ' ' . $datos['info']['Apellidom'] . ' ' . $datos['info']['Nombre'] . '</td>';
                    $suma = 0; $cantidad = 0;
                    foreach ($asignaturas as $asignatura) {
                        $calif = $datos['calificaciones'][$asignatura] ?? '';
                        echo '<td>' . $calif . '</td>';
                        if ($calif !== '') {
                            $suma += floatval($calif);
                            $cantidad++;
                        }
                    }
                    $promedio = ($cantidad > 0) ? $suma / $cantidad : 0;
                    echo '<td>' . number_format($promedio, 2) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </form>
<?php } ?>

<?php include_once "vistas/footer.php"; ?>
