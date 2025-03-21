<?php include_once "vistas/sidebar.php"; ?>
            <h4>Gestor de calificaciones 3° primaria</h4>
            <br>
            <div class="container">
                <div class="row g-4">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="tcapturar3.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="subircalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
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
                        <a href="ver_calificaciones3.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
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
                        <a href="modificar_calificaciones3.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
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
            <div style="display:none;">
                <?php
                $query1="SELECT * FROM periodo WHERE nombre='captura_de_calificacion1'";
                $resultado1=$conexion->query($query1);
                if($row1=$resultado1->fetch_assoc()) {
                    ?>
                        <input id="nombre1" value="<?php echo $row1['nombre']; ?>">
                        <input id="fechaini1" type="text" value="<?php echo $row1['fecha_inicio']; ?>">
                        <input id="fechafin1" type="text" value="<?php echo $row1['fecha_fin']; ?>">
                    <?php
                }
                ?>
                <?php
                $query2="SELECT * FROM periodo WHERE nombre='captura_de_calificacion2'";
                $resultado2=$conexion->query($query2);
                while($row2=$resultado2->fetch_assoc()) {
                    ?>
                        <input id="nombre2" value="<?php echo $row2['nombre']; ?>">
                        <input id="fechaini2" type="text" value="<?php echo $row2['fecha_inicio']; ?>">
                        <input id="fechafin2" type="text" value="<?php echo $row2['fecha_fin']; ?>">
                        <?php
                }
                ?>
                <?php
                $query3="SELECT * FROM periodo WHERE nombre='captura_de_calificacion3'";
                $resultado3=$conexion->query($query3);
                while ($row3=$resultado3->fetch_assoc()) {
                    ?>
                        <input id="nombre3" value="<?php echo $row3['nombre']; ?>">
                        <input id="fechaini3" type="text" value="<?php echo $row3['fecha_inicio']; ?>">
                        <input id="fechafin3" type="text" value="<?php echo $row3['fecha_fin']; ?>">
                        <?php
                }
                ?>
            </div>
<?php include_once "vistas/footer.php"; ?>