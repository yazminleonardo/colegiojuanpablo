<?php include_once "vistas/sidebar.php"; ?>
            <h4>Gestor de calificaciones 3° secundaria</h4>
            <br>
            <div class="container">
                <div class="row g-4">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="capturasecu3.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="subircalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h5><i class="bi bi-file-earmark-arrow-up"></i> Capturar calificaciones</h5>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="vercalificacion_secu3.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h5><i class="bi bi-search"></i> Consultar calificaciones</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="modificar_calificacionessecu3.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h5><i class="bi bi-pencil-square"></i> Modificar calificaciones</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <br>      
<?php include_once "vistas/footer.php"; ?>
