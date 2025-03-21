<?php include_once "vistas/sidebar.php"; ?>
            <h2>Bienvenido</h2>
            <br>
                <div class="container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card shadow-sm">
                                    <a href="calificaciones.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-right">
                                                        <h4><i class="bi bi-mortarboard-fill"></i> Consultar calificaciones</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card shadow-sm">
                                    <a href="asistencia.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-right">
                                                        <h4><i class="bi bi-clipboard-check"></i> Consultar asistencia</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                            $fecha_actual = date("Y-m-d");
                            $test="test";
                            $consulta = "SELECT * FROM periodo WHERE fecha_inicio >= '$fecha_actual' AND fecha_fin <= '$fecha_actual' AND nombre='$test'";
                            $datos = $conexion->query($consulta);                   
                            while ($row = $datos->fetch_assoc()) {
                            ?>
                                <td><?php echo $fecha_actual = date("Y-m-d");?></td>
                                <td><?php echo $row['nombre'];?></td>
                                <td><?php echo $row['fecha_inicio'];?></td>
                                <td><?php echo $row['fecha_fin']; ?></td>
                            <?php
                        
                            }
                            ?>
                            <!-- <div class="col-xl-5 col-sm-6 col-12">
                                <div class="card shadow-sm">
                                    <a href="tests.php" class="btn" id="test" style="background-color: transparent; border: none; text-decoration: none; color:black; text-align: left; max-width: auto;" onclick="consultarcalif()">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-right">
                                                        <h4><i class="bi bi-clipboard2-check"></i> Tests inteligencias múlitples</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> -->

<?php
$consulta = "SELECT * FROM periodo WHERE fecha_inicio <= CURDATE() AND fecha_fin >= CURDATE() AND nombre='test'";
$datos = $conexion->query($consulta);

while ($row = $datos->fetch_assoc()) {
    ?>
    <input type="hidden" value="<?php echo $row['fecha_inicio'];?>">
    <input type="hidden" value="<?php echo $row['fecha_fin'];?>">
    <div class="col-xl-5 col-sm-6 col-12">
        <div class="card shadow-sm">
            <a href="tests.php" class="btn" id="test" style="background-color: transparent; border: none; text-decoration: none; color:black; text-align: left; max-width: auto;" onclick="consultarcalif()">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4><i class="bi bi-clipboard2-check"></i> Tests inteligencias múlitples</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
   <?php 
}
$registros = mysqli_num_rows($datos);
if ($registros == 0) {

}
/*$fecha_actual = date('Y-m-d');

$consulta = "SELECT * FROM periodo WHERE fecha_inicio >= '$fecha_actual' AND nombre = 'test'";

$datos = $conexion->query($consulta);

while ($row = $datos->fetch_assoc()) {
    ?>
    <input type="text" value="<?php echo $row['fecha_inicio'];?>">
    <input type="text" value="<?php echo $row['fecha_fin'];?>">
   <?php 
}
$registros = mysqli_num_rows($datos);
if ($registros == 0) {
    echo 'nada';
    echo $fecha_actual = date('Y-m-d');
}*/
?>


                        </div>
                    </div>
                </div> 
<?php include_once "vistas/footer.php"; ?>