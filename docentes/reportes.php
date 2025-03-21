<?php include_once "vistas/sidebar.php"; ?>
                <form method="post">
                    <input type="date" name="asistencia" id="">
                    <input type="date" name="asistencia1" id="">
                
                    <input type="submit" value="solicitud" name="solicitud" onclick="solicitud()"/>
                </form>
                <br>
                <?php
                session_start();
                include 'bd/conexion.php';
                $usuario = $_SESSION['usuario'];
                $cadena_query = mysqli_query($conexion, "SELECT id_grupo FROM docentes WHERE id='$usuario'");
                $cadena_row = mysqli_fetch_assoc($cadena_query);
                $cadena = $cadena_row['id_grupo'];
                if(isset($_POST['solicitud'])){
                    $asistencia=$_POST['asistencia'];
                    $asistencia1=$_POST['asistencia1'];
                    if (!strtotime($asistencia)) {
                        echo "La fecha ingresada no es válida.";
                        exit;
                    }
                    $fecha = date('Y-m-d', strtotime($asistencia));
                    $fecha = date('Y-m-d', strtotime($asistencia));
                    //  echo $fecha;
                    $vista=$conexion->prepare("SELECT Nombre,Apellidop,Apellidom,asistencia,fecha FROM asistencias INNER JOIN alumnos ON asistencias.Id_alumno=alumnos.Id_alumno WHERE grupo='$cadena' AND fecha BETWEEN '$asistencia' AND '$asistencia1'");
                    $vista->execute();
                    $resultado = $vista->get_result();


                ?>

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
                            echo '<tr>';
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
                <?php } ?>
<?php include_once "vistas/footer.php"; ?>