<?php include_once "vistas/sidebar.php"; ?>
<?php
$sql = "SELECT * FROM periodo WHERE fecha_inicio <= CURDATE() AND fecha_fin >= CURDATE() AND id_periodo=4";
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
  $periodo = null; // Para evitar valores indefinidos
  $datos = mysqli_fetch_assoc($resultado);
  
  if ($datos) {
      $periodo = $datos["nombre"];
  } else {
      echo "";
  }  
  //echo $periodo;
  ?>
<div class="grey-bg container-fluid">
  <section id="minimal-statistics">
    <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h4>Bienvenido</h4>
      </div>
    </div>
    <br>
    <div class="row"> <!-- Inicia la fila que contendrá los 3 apartados -->
      <!-- Apartado de Prescolar -->
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-sm">
            <a href="perfil_alum.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4><i class="bi bi-person"></i> Preescolar</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
      </div>

      <!-- Apartado de Primaria -->
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-sm">
            <a href="calificaciones1.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4><i class="bi bi-mortarboard-fill"></i> Primaria</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
      </div>

      <!-- Apartado de Secundaria -->
      <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-sm">
            <a href="insertar_asistencia.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-right">
                                <h4><i class="bi bi-clipboard-check"></i> Secundaria</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
      </div>
    </div> <!-- Cierra la fila -->
  </section>
</div>

  <?php
} else {
  $periodo = null;
}
?>
<?php include_once "vistas/footer.php"; ?>