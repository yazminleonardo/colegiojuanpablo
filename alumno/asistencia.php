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
$sql="SELECT * FROM alumnos WHERE Id_alumno = '$usuario'";
$dato1 = $conexion->query($sql);
if ($fila1=$dato1->fetch_assoc()) {
?>
    <label class="h6 fw-bold">Nombre del alumno:</label> <label style="font-size: 16px;"><?php echo $fila1['Apellidop'].' '.$fila1['Apellidom'].' '.$fila1['Nombre']; ?></label><br>
    <label class="h6 fw-bold">Matrícula:</label> <label style="font-size: 16px;"><?php echo $fila1['Matricula']; ?></label><br>
    <label class="h6 fw-bold">Grado:</label> <label style="font-size: 16px;"><?php echo $fila1['grado']; ?>°</label><br>
    <label class="h6 fw-bold">Grupo:</label> <label style="font-size: 16px;"><?php echo $fila1['grupo']; ?></label>
    
    <?php
    if (isset($_POST['solicitud'])) {

    $periodo = $_POST['periodo'];
    ?>
        <hr style="color: #198754; border-top-width: 4px;">
        <?php if(isset($_POST['solicitud'])){ ?>
            <form method="post" action="pdf_asistencias.php" class="" target="_blank">
                <input type="hidden" name="periodo" value="<?php if(isset($_POST['periodo'])){print($_POST['periodo']);}?>"></input>
                <input type="hidden" name="usuario" value="<?php if(isset($_SESSION['usuario'])){print($_SESSION['usuario']);}?>"></input>
                    
                <div style="text-align:right;">
                    <button type="submit" class="btn btn-danger" value="calificacionesGenerales" name="generarReporte" onclick="solicitud()"><i class="bi bi-filetype-pdf"></i> Generar Reporte</button>
                </div>
            </form>
        <?php } ?>
        <br>
        <table class="content-table table table-bordered">
            <thead>
                <tr style="text-align: center;">
                    <th style="background-color: #198754; color:white;">Fecha</th>
                    <th style="background-color: #198754; color:white;">Asistencia</th>
                </tr>
            </thead>
            <tbody>
            <?php
                switch ($periodo) {
                    case 1:
                        $arsenne = "SELECT * FROM asistencias WHERE Id_alumno = '$usuario' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '08' AND '12'";
                        break;
                    case 2:
                        $arsenne = "SELECT * FROM asistencias WHERE Id_alumno = '$usuario' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '01' AND '03'";
                        break;
                    case 3:
                        $arsenne = "SELECT * FROM asistencias WHERE Id_alumno = '$usuario' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '04' AND '06'";
                    break;
                  }
                $orpheus = $conexion->query($arsenne);
                $xyz = mysqli_num_rows($orpheus);
                if ($xyz == 0) {?>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>                        
                    <?php
                }else {
                switch ($periodo) {
                    case 1:
                        $consulta = "SELECT * FROM asistencias WHERE Id_alumno = '$usuario' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '08' AND '12'";
                        break;
                    case 2:
                        $consulta = "SELECT * FROM asistencias WHERE Id_alumno = '$usuario' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '01' AND '03'";
                        break;
                    case 3:
                        $consulta = "SELECT * FROM asistencias WHERE Id_alumno = '$usuario' AND DATE_FORMAT(asistencias.fecha, '%m') BETWEEN '04' AND '06'";
                        break;
                    }
                $datos = $conexion->query($consulta);
        
                while ($row = $datos->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php $fecha1=$row['fecha'];
                    $fecha= date("d/m/y", strtotime($fecha1));
                    echo $fecha; ?></td>
                    <td><?php echo $row['asistencia']; ?></td>
                </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
            <?php
            }
        } else {
    }

}
?>
<?php include_once "vistas/footer.php"; ?>