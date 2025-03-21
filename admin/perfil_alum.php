<?php include_once "vistas/sidebar.php"; ?>
                <div class="container">
                    <!-- Content here -->
                    <label for="exampleDataList" class="h5">Ingrese matrícula:</label>
                    <form class="d-flex" action="" method="GET">
                    <input class="form-control me-2 light-table-filter" type="text" name="busqueda" aria-label="Search" style="width: 200px;">
                    <button type="submit" class="btn btn-success">Buscar</button>
                    </form>
                    <br>
                    <?php
                    include 'bd/conexion.php';
                    if(isset($_GET['busqueda'])){
                        $buscar=$_GET['busqueda'];
                        $consulta="SELECT * FROM alumnos WHERE Matricula LIKE'%$buscar%'";
                        $dato = $conexion->query($consulta);
                        if ($fila=$dato->fetch_assoc()) {
                            ?>
                            <div class="row g-3 mx-auto p-2 bg-light rounded-4">
                                <div class="header rounded-4" style="background-color: #009d63;">
                                    <h5 class="h3 text-center text-light">Perfil del alumno</h5>
                                </div>
                                <div class="col-md-6 text-center">
                                <img src="data:image/jpg;base64,<?php echo base64_encode($fila['img_perfil'])?>" class="bg-light rounded-circle" style="width:200px; height: 200px;">
                                </div>
                                <div class="col-md-6 text-center">
                                    <br><br>
                                    <h5 class="h3 text-center"><?php echo $fila['Nombre'];?> <?php echo $fila['Apellidop']; ?></h5>
                                    <h5 class="h3 text-center"><?php echo $fila['Apellidom']; ?></h5>
                                    <p class="fs-5 fw-normal"><?php echo $fila['Matricula']; ?></p>
                                </div>
                                <div class="header rounded-4" style="background-color: #009d63;">
                                    <h5 class="h3 text-center text-light">Datos Generales del alumno</h5>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Grado:</h6><p class="fs-5"><?php echo $fila['grado']; ?>°</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Grupo:</h6><p class="fs-5"><?php echo $fila['grupo']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Curp:</h6><p class="fs-5"><?php echo $fila['Curp']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Fecha de nacimiento:</h6><p class="fs-5"><?php echo $fila['Nacimiento']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Edad:</h6><p class="fs-5"><?php echo $fila['Edad']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Talla:</h6><p class="fs-5"><?php echo $fila['Talla']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Peso:</h6><p class="fs-5"><?php echo $fila['Peso']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Género:</h6><p class="fs-5"><?php echo $fila['Genero']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Alergias:</h6><p class="fs-5"><?php echo $fila['Alergias']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Problemas de salud:</h6><p class="fs-5"><?php echo $fila['Problemas_salud']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                <?php
                                $inteligencia=$fila['id_inteligencia'];
                                $sql="SELECT * FROM inteligencias WHERE id_inteligencia = '$inteligencia'";
                                $dato1 = $conexion->query($sql);
                                if ($fila1=$dato1->fetch_assoc()) {
                                    ?>
                                    <h4 class="h5">Inteligencia:</h6><p class="fs-5"><?php echo $fila1['Inteligencia']; ?></p>
                                </div>
                                    <?php
                                }
                                ?>
                                <br><br>
                                <div class="header rounded-4 bg-light">
                                    <h5 class="h3 text-center">Datos del tutor</h5>
                                </div>
                                <?php
                                $id_p=$fila['id_padre'];
                                $sql="SELECT * FROM tutores WHERE id_padre = '$id_p'";
                                $dato2 = $conexion->query($sql);
                                if ($fila2=$dato2->fetch_assoc()) {
                                    ?>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Nombre:</h6><p class="fs-5"><?php echo $fila2['Nombre']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Apellido paterno:</h6><p class="fs-5"><?php echo $fila2['Apellidop']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Apellido materno:</h6><p class="fs-5"><?php echo $fila2['Apellidom']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Curp:</h6><p class="fs-5"><?php echo $fila2['Curp']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Fecha de nacimiento:</h6><p class="fs-5"><?php echo $fila2['Nacimiento']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Teléfono:</h6><p class="fs-5"><?php echo $fila2['Telefono']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Correo electrónico:</h6><p class="fs-5"><?php echo $fila2['Email']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Grado de estudios:</h6><p class="fs-5"><?php echo $fila2['Estudios']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Domicilio:</h6><p class="fs-5"><?php echo $fila2['Domicilio']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Ocupación:</h6><p class="fs-5"><?php echo $fila2['Ocupacion']; ?></p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4 class="h5">Tipo de familia:</h6><p class="fs-5"><?php echo $fila2['Tipo_familia']; ?></p>
                                </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <br>
                            <?php    
                        }else{
                            echo'<p class="h5 text-center">Los datos no existen</p>';
                        }
                        ?>
                        <?php
                    }
                    ?>
                    <?php
                    $visualizar="SELECT * FROM alumnos";
                    $info = $conexion->query($visualizar);
                    ?>
                    <table class="content-table table table-bordered">
                        <thead>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Grado</th>
                            <th>Grupo</th>
                            <th></th>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php while ($row1=$info->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row1['Matricula']; ?></td>
                                <td><?php echo $row1['Nombre']; ?></td>
                                <td><?php echo $row1['grado'];?>°</td>
                                <td><?php echo $row1['grupo']; ?></td>
                                <td><a href="#">Ver perfil</a></td>
                            </tr>
                        </tbody>
                        <?php
                    }
                    ?>
                    </table>
                </div>
<?php include_once "vistas/footer.php"; ?>