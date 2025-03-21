<?php include_once "vistas/sidebar.php"; ?>
<h2>Bienvenido</h2>
<br>
<div class="grey-bg container-fluid">
  <section id="minimal-statistics">
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
    </div>
  </section>
</div>
<?php include_once "vistas/footer.php"; ?>