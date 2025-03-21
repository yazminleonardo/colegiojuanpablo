<?php include_once "vistas/sidebar.php"; ?>
<label class="form-label h5 fw-bold">Selecciona el trimestre</label>
<form method="post" class="d-flex">
    <select class="form-select" name="periodo" id="" style="width: 200px;">
        <option value="1">1° Trimestre</option>
        <option value="2">2° Trimestre</option>
        <option value="3">3° Trimestre</option>
    </select>
    <input type="submit" class="btn btn-success" value="Consultar" name="solicitud" onclick="solicitud()" />
</form>
<hr style="color: #198754; border-top-width: 4px;">
<?php
$usuario = $_SESSION['usuario'];
$matricula1 = $_SESSION['matricula1'];
$sql = "SELECT * FROM alumnos WHERE Matricula = '$matricula1'";
$dato1 = $conexion->query($sql);
if ($fila1 = $dato1->fetch_assoc()) {
?>
    <label class="h6 fw-bold">Nombre del alumno:</label> <label style="font-size: 16px;"><?php echo $fila1['Apellidop'] . ' ' . $fila1['Apellidom'] . ' ' . $fila1['Nombre']; ?></label><br>
    <label class="h6 fw-bold">Matrícula:</label> <label style="font-size: 16px;"><?php echo $fila1['Matricula']; ?></label><br>
    <label class="h6 fw-bold">Grado:</label> <label style="font-size: 16px;"><?php echo $fila1['grado']; ?>°</label><br>
    <label class="h6 fw-bold">Grupo:</label> <label style="font-size: 16px;"><?php echo $fila1['grupo']; ?></label>

    <?Php
    if (isset($_POST['solicitud'])) {

        $periodo = $_POST['periodo'];
    ?>
        <hr style="color: #198754; border-top-width: 4px;">
        <table class="content-table table table-bordered">
            <thead>
                <th style="background-color: #198754; color:white;">Campo formativo</th>
                <th style="background-color: #198754; color:white;">Materias</th>
                <th style="background-color: #198754; color:white;">Calificación</th>
            </thead>
            <tbody>
                <?php
                //?aqui es el inicio de todo
                $arsenne = "SELECT * FROM calificaciones INNER JOIN alumnos ON calificaciones.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1'  and id_periodo=$periodo";
                $orpheus = $conexion->query($arsenne);
                $xyz = mysqli_num_rows($orpheus);
                if ($xyz == 0) {?>
                <tr>
                    <th rowspan="3">Lenguajes</td>
                    <td>Artes</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>Español</td>
                    <td> </td>
                </tr>
                <tr>
                    <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                    <td style="border-left: 0px;"> </td>
                </tr>                
                <tr>
                    <th rowspan="3">Saberes y pensamiento científico</td>
                    <td>Matematicas</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>C.Medio</td>
                    <td> </td>
                </tr>
                <tr>
                    <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                    <td style="border-left: 0px;"> </td>
                </tr>
                <tr>
                    <th rowspan="2">Ética naturaleza y sociedad</td>
                        <td>F.C.E</td>
                        <td> </td>
                </tr>
                <tr>
                    <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                    <td style="border-left: 0px;"> </td>
                </tr>
                <tr>
                    <th rowspan="3">De lo humano a lo comunitario</td>
                    <td>Computación</td>
                    <td> </td>
                </tr>
                <tr>
                    <td>Educación Física</td>
                    <td> </td>
                </tr>
                <tr>                  
                    <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                    <td style="border-left: 0px;"> </td>
                </tr>
                <tr>
                    <th style="text-align: right;">Promedio final</th>
                    <td colspan="2" style="text-align: center;"> </td>
                </tr>
            </tbody>
        </table>
        <div class="container-xl" style="background-color: #198754; color:white;">
            <h5>Observaciones</h5>
        </div>                        
                    <?php  //! 
                    } 
                    else {
                $consulta = "SELECT * FROM calificaciones INNER JOIN alumnos ON calificaciones.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1' AND id_asignatura=1 and id_periodo=$periodo";
                $datos = $conexion->query($consulta);
        
                    while ($row = $datos->fetch_assoc()) {
                ?>
                <?php if(isset($_POST['solicitud'])){ ?>
                    <form method="post" action="pdf.php" class="" target="_blank">
                        <input type="hidden" name="periodo" value="<?php if(isset($_POST['periodo'])){print($_POST['periodo']);}?>"></input>
                        <input type="hidden" name="matricula1" value="<?php if(isset($_SESSION['matricula1'])){print($_SESSION['matricula1']);}?>"></input>
                        
                        <div style="text-align:right;">
                            <button type="submit" class="btn btn-danger" value="calificacionesGenerales" name="generarReporte" onclick="solicitud()"><i class="bi bi-filetype-pdf"></i>Generar Reporte</button>
                        </div>
                    </form>
                <?php } ?>
                <br>
                        <tr>
                            <th rowspan="3">Lenguajes</td>
                            <td>Artes</td>
                            <td><?php echo $calif1 = $row['calificacion']; ?></td>
                        </tr>
                        <tr>
                            <td>Español</td>
                            <td><?php echo $calif1 ?></td>
                        </tr>
                        <tr>
                            <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                            <td style="border-left: 0px;"><?php $promedio1 = ($calif1 + $calif1 + $calif1) / 3;
                                                            echo $promedio1 ?></td>
                        </tr>
                    <?php
                    }
                    // Si no hay registros, mostrar una fila en blanco
                    $registros = mysqli_num_rows($datos);
                    if ($registros == 0) {
                    ?>
                    <tr>
                        <th rowspan="3">Lenguajes</td>
                        <td>Artes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>Español</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                        <td style="border-left: 0px;"><?php $promedio1 = null; echo $promedio1 ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <!---->
                    <?php
                    $consulta = "SELECT * FROM calificaciones INNER JOIN alumnos ON calificaciones.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1' AND id_asignatura=2 and id_periodo=$periodo";
                    $datos = $conexion->query($consulta);
                    while ($row = $datos->fetch_assoc()) {
                    ?>
                        <tr>
                            <th rowspan="3">Saberes y pensamiento científico</td>
                            <td>Matematicas</td>
                            <td><?php echo $calif1 = $row['calificacion']; ?></td>
                        </tr>
                        <tr>
                            <td>C.Medio</td>
                            <td><?php echo $calif1 ?></td>
                        </tr>
                        <tr>
                            <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                            <td style="border-left: 0px;"><?php $promedio2 = ($calif1 + $calif1) / 2;
                                                            echo $promedio2 ?></td>
                        </tr>                      
                    <?php
                    }
                    // Si no hay registros, mostrar una fila en blanco
                    $registros = mysqli_num_rows($datos);
                    if ($registros == 0) {
                    ?>
                    <tr>
                        <th rowspan="3">Saberes y pensamiento científico</td>
                        <td>Matematicas</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>C.Medio</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                        <td style="border-left: 0px;"><?php $promedio2 = null; echo $promedio2 ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <!---->
                    <?php
                    $consulta = "SELECT * FROM calificaciones INNER JOIN alumnos ON calificaciones.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1' AND id_asignatura=3 and id_periodo=$periodo";
                    $datos = $conexion->query($consulta);
                    while ($row = $datos->fetch_assoc()) {
                    ?>
                        <tr>
                            <th rowspan="2">Ética naturaleza y sociedad</td>
                            <td>F.C.E</td>
                            <td><?php echo $calif1 = $row['calificacion']; ?></td>
                        </tr>
                        <tr>
                            <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                            <td style="border-left: 0px;"><?php $promedio3 = ($calif1) / 1;
                                                            echo $promedio3 ?></td>
                        </tr>
                    <?php
                    }
                    // Si no hay registros, mostrar una fila en blanco
                    $registros = mysqli_num_rows($datos);
                    if ($registros == 0) {
                    ?>
                    <tr>
                        <th rowspan="2">Ética naturaleza y sociedad</td>
                        <td>F.C.E</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                        <td style="border-left: 0px;"><?php $promedio3 = null; echo $promedio3 ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <!---->
                    <?php
                    $consulta = "SELECT * FROM calificaciones INNER JOIN alumnos ON calificaciones.Id_alumno=alumnos.Id_alumno WHERE Matricula = '$matricula1' AND id_asignatura=4 and id_periodo=$periodo";
                    $datos = $conexion->query($consulta);
                    while ($row = $datos->fetch_assoc()) {
                    ?>
                        <tr>
                            <th rowspan="3">De lo humano a lo comunitario</td>
                            <td>Computación</td>
                            <td><?php echo $calif1 = $row['calificacion']; ?></td>
                        </tr>
                        <tr>
                            <td>Educación Física</td>
                            <td><?php echo $calif1 ?></td>
                        </tr>
                        <tr>
                            <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                            <td style="border-left: 0px;"><?php $promedio4 = ($calif1 + $calif1) / 2;
                                                            echo $promedio4 ?></td>
                        </tr>
                    <?php
                    }
                    // Si no hay registros, mostrar una fila en blanco
                    $registros = mysqli_num_rows($datos);
                    if ($registros == 0) {
                    ?>
                    <tr>
                        <th rowspan="3">De lo humano a lo comunitario</td>
                        <td>Computación</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>Educación Física</td>
                        <td> </td>
                    </tr>
                    <tr>                  
                        <td style="border-right: 0px;"><strong>Promedio:</strong></td>
                        <td style="border-left: 0px;"><?php $promedio4 = null; echo $promedio4 ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <th style="text-align: right;">Promedio final</th>
                        <td colspan="2" style="text-align: center;"><?php $promedio_final = ($promedio1 + $promedio2 + $promedio3 + $promedio4) / 4;
                                                                    echo $promedio_final ?></td>
                    </tr>
            </tbody>
        </table>
        <!-- <div class="container-xl" style="background-color: #198754; color:white;">
            <h5>Observaciones</h5>
        </div> -->
<?php
    
                }
            } else {
            }
     
        }
    
?>

<?php include_once "vistas/footer.php"; ?>