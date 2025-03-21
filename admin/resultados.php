<?php include_once "vistas/sidebar.php"; ?>
                <div class="container">
                    <!-- Content here -->
                    <label for="exampleDataList" class="h5">Ingrese matrícula:</label>
                    <form class="d-flex" action="" method="GET">
                    <input class="form-control me-2 light-table-filter" type="text" name="busqueda" aria-label="Search" style="width: 200px;" onKeyUp="mayusculas(this)">
                    <button type="submit" class="btn btn-success">Buscar</button>
                    </form>
                    <br>
                    <?php
                    include 'bd/conexion.php';
                    if(isset($_GET['busqueda'])){
                        $buscar=$_GET['busqueda'];
                        $consulta="SELECT * FROM alumnos WHERE Nombre LIKE'%$buscar%'";
                        $info = $conexion->query($consulta);
                            ?>
                    <table class="content-table table table-bordered">
                        <thead>
                            <th>Matrícula</th>
                            <th>Nombre</th>
                            <th>Grado</th>
                            <th>Tipo de inteligencia</th>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php while ($row1=$info->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row1['Matricula']; ?></td>
                                <td><?php echo $row1['Nombre']; ?></td>
                                <td><?php echo $row1['grado'];?>°</td>
                                <?php
                                $inteligencia=$row1['id_inteligencia'];
                                $sql="SELECT * FROM inteligencias WHERE id_inteligencia = '$inteligencia'";
                                $dato1 = $conexion->query($sql);
                                if ($fila1=$dato1->fetch_assoc()) {
                                    ?>
                                    <td>Inteligencia <?php echo $fila1['Inteligencia']; ?></td>
                                    <?php
                                }else{
                                    ?>
                                    <td></td>
                                    <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                        <?php
                    }
                    ?>
                    </table>

                            <?php    
                        }
                        else{
                           
                            $visualizar="SELECT * FROM alumnos order BY Nombre";
                            $info1 = $conexion->query($visualizar);
                                ?>
                                <table class="content-table table table-bordered">
                            <thead>
                                <th>Matrícula</th>
                                <th>Nombre</th>
                                <th>Grado</th>
                                <th>Grupo</th>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php while ($row=$info1->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['Matricula']; ?></td>
                                    <td><?php echo $row['Nombre'];?> <?php echo $row['Apellidop'];?> <?php echo $row['Apellidom'];?></td>
                                    <td><?php echo $row['grado'];?>°</td>
                                    <td><?php echo $row['grupo']; ?></td>
                                </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                        </table>
                        
                        <?php
                    }
                    ?>
                </div>
<?php include_once "vistas/footer.php"; ?>
<script>
    function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

</script>