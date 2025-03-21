<?php include_once "vistas/sidebar.php"; ?>            
                <h5 class="form-label fw-bold">Selecciona un periodo de fechas:</h5>
                <form method="post" class="d-flex" style="max-width: 500px;">
                    <input class="form-control" type="date" name="asistencia" id="">
                    <input class="form-control" type="date" name="asistencia1" id="">
                
                    <input class="btn btn-success" type="submit" value="Consultar" name="solicitud" onclick="solicitud()"/>
                </form>
                <br>
                <?php if(isset($_POST['solicitud'])){ ?>

                <form method="post" action="reportesAsistencia.pdf.php" class="" target="_blank">

                    <input type="hidden" name="usuario" value="<?php if(isset($_SESSION['usuario'])){print($_SESSION['usuario']);}?>"></input>
                    <input type="hidden" name="grado1" value="<?php if(isset($_SESSION['grado1'])){print($_SESSION['grado1']);}?>"></input>
                    <input type="hidden" name="grado2" value="<?php if(isset($_SESSION['grado2'])){print($_SESSION['grado2']);}?>"></input>
                    <input type="hidden" name="asistencia" value="<?php if(isset($_POST['asistencia'])){print($_POST['asistencia']);}?>"></input>
                    <input type="hidden" name="asistencia1" value="<?php if(isset($_POST['asistencia1'])){print($_POST['asistencia1']);}?>"></input>
                    <div style="text-align:right;">
                        <button type="submit" class="btn btn-danger" name="generarReporte" onclick="solicitud()"><i class="bi bi-filetype-pdf"></i> Generar reporte</button>
                    </div>
                    </form>
                    <?php 
                } 
                ?>
                <?php
                
                include 'bd/conexion.php';
                $usuario = $_SESSION['usuario'];
                $grado1 = $_SESSION['grado1'];
                $grado2 = $_SESSION['grado2'];


                if(isset($_POST['solicitud'])){
                    $asistencia=$_POST['asistencia'];
                    $asistencia1=$_POST['asistencia1'];
                    if (!strtotime($asistencia)) {
                        echo "La fecha ingresada no es válida.";
                        exit;
                    }
                    $fecha = date('Y-m-d', strtotime($asistencia));
                    $fecha = date('Y-m-d', strtotime($asistencia1));
                    $verificar=mysqli_query($conexion, "SELECT Matricula,Nombre,Apellidop,Apellidom,asistencia,fecha FROM asistencias INNER JOIN alumnos ON asistencias.Id_alumno=alumnos.Id_alumno WHERE grado in($grado1,$grado2) AND fecha BETWEEN '$asistencia' AND '$asistencia1'");
                    if(mysqli_num_rows($verificar)==0){
                        ?>
                        <script type="text/javascript">
                    Swal.fire({
                        position: 'center',
                        type: 'warning',
                        title: 'Lo sentimos aun no hay registros en ese periodo de tiempo!',
                        showConfirmButton: false,
                        timer: 10000
                    })
                    //alert("Lo sentimos aun no hay registros en ese periodo de tiempo");
                
                </script>  
                <?php
                        
                    }
                    else{
                    //  echo $fecha;
                    $vista=$conexion->prepare("SELECT Matricula,Nombre,Apellidop,Apellidom,asistencia,fecha FROM asistencias INNER JOIN alumnos ON asistencias.Id_alumno=alumnos.Id_alumno WHERE grado in($grado1,$grado2) AND fecha BETWEEN '$asistencia' AND '$asistencia1'order BY Apellidop");
                    $vista->execute();
                    $resultado = $vista->get_result();


                ?>
                <br>
                <table class="content-table table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <?php
                            $fechasMostradas = array();
                            foreach ($resultado as $row) {
                                $fecha = $row['fecha'];
                                // Mostrar la fecha solo si no se ha mostrado antes
                                if (!in_array($fecha, $fechasMostradas)) {
                                    echo '<th>' . date('d-m-Y', strtotime($fecha)) . '</th>';
                                    array_push($fechasMostradas, $fecha);
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nombresAsistencia = array();

                        foreach ($resultado as $row) {
                            $nombreCompleto = $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre'];

                            // Inicializar la fila si es la primera vez que se encuentra el nombre
                            if (!array_key_exists($nombreCompleto, $nombresAsistencia)) {
                                $nombresAsistencia[$nombreCompleto] = array_fill_keys($fechasMostradas, ''); // Inicializar todas las asistencias como vacías
                            }

                            // Asignar la asistencia a la fecha correspondiente
                            $nombresAsistencia[$nombreCompleto][$row['fecha']] = $row['asistencia'];
                        }

                        // Mostrar las filas
                        foreach ($nombresAsistencia as $nombre => $asistencias) {
                            //echo '<tr>''</td>';
                            echo '<td>' . $nombre . '</td>';
                            foreach ($asistencias as $asistencia) {
                                // Aplicar estilos según el estado de asistencia
                                $claseAsistencia = ($asistencia == 'asistio') ? 'asistio' : 'falta';
                                echo '<td class="' . $claseAsistencia . '">' . $asistencia . '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <?php } }?>
<?php include_once "vistas/footer.php"; ?>