<?php include_once "vistas/sidebar.php"; ?>
<label class="form-label h5 fw-bold">Selecciona el bimestre</label>
    <form method="post" class="d-flex">
        <select name="calificaciones" class="form-select" id="" style="width: 200px;">
            <option value="1">1er bimestre</option>
            <option value="2">2do bimestre</option>
            <option value="3">3er bimestre</option>
            <option value="final">calificaciones finales</option>
            <option value="calificaciones1">todas las calificaciones</option>
        </select>
        <input type="submit" name="verificar" class="btn btn-success">
    </form>
    <br>
    <?php
    if(isset($_POST['verificar'])){
        $bimestre = $_POST['calificaciones']; // Corregir esta línea
        $cadena_query = mysqli_query($conexion, "SELECT id_grupo FROM docentes WHERE id='$user'");
        $cadena_row = mysqli_fetch_assoc($cadena_query);
        $cadena = $cadena_row['id_grupo'];
        $primerDigito = substr($cadena, 0, 1);
        $segundoDigito = substr($cadena, 3, 1);

        switch ($bimestre) {
            case "calificaciones1":
                $consulta = $conexion->prepare("SELECT alumnos.Id_alumno, Matricula, Nombre, Apellidop, Apellidom, ${primerDigito}calificaciones.* FROM alumnos, ${primerDigito}calificaciones WHERE grado=$primerDigito");
                $consulta2 = $conexion->prepare("SELECT alumnos.Id_alumno, Matricula, Nombre, Apellidop, Apellidom, ${segundoDigito}calificaciones.* FROM alumnos, ${segundoDigito}calificaciones WHERE grado=$segundoDigito");
            $consulta->execute();
            $resultado = $consulta->get_result();
            
            $consulta2->execute();
            $resultado2 = $consulta2->get_result();
            ?>

            <table class="table">
            <th>Matricula</th>
            <th>Nombre</th>
            <th align="center">Lenguajes 1</th>
            <th>Saberes y pensamiento 1</th>
            <th>Ética naturaleza y sociedad 1</th>
            <th>De lo humano a lo comunitario 1</th>
            <th>promedio bimestre 1 </th>
            <th>Matricula</th>
            <th>Nombre</th>
            <th align="center">Lenguajes 2</th>
            <th>Saberes y pensamiento 2</th>
            <th>Ética naturaleza y sociedad 2</th>
            <th>De lo humano a lo comunitario 2</th>
            <th>promedio bimestre 2</th>
            <th align="center">Lenguajes 3</th>
            <th>Saberes y pensamiento 3</th>
            <th>Ética naturaleza y sociedad 3</th>
            <th>De lo humano a lo comunitario 3</th>
            <th>promedio bimestre 3</th>
            <th align="center">Promedio de Lenguajes</th>
            <th>promedio de Saberes y pensamiento</th>
            <th>promedio de Ética naturaleza y sociedad</th>
            <th>promedio de De lo humano a lo comunitario</th>
            <th>promedio final </th>
            <?php foreach ($resultado as $row) { ?>
            <tr>
            <td align="center"><?php echo $row['Matricula']  ?> </td>
            <td ><?php echo $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre']; ?> </td><td> </td>
            <td ><?php echo $row["lenguaje1"]?> </td>
            <td><?php echo $row["cientifico1"]?> </td>
            <td><?php echo $row["eticahumano1"]?> </td>
            <td><?php echo $row["ser1"]?> </td>
            <td align="center"><?php echo $row["1bimestre"]?> </td>

            <td ><?php echo $row["lenguaje2"]?> </td>
            <td><?php echo $row["eticahumano2"]?> </td>
            <td><?php echo $row["cientifico2"]?> </td>
            <td><?php echo $row["ser2"]?> </td>
            <td align="center"><?php echo $row["2bimestre"]?> </td>

            <td ><?php echo $row["lenguaje3"]?> </td>
            <td><?php echo $row["cientifico3"]?> </td>
            <td><?php echo $row["eticahumano3"]?> </td>
            <td><?php echo $row["ser3"]?> </td>

            <td align="center"><?php echo $row["3bimestre"]?> </td>

            
            <td ><?php echo $row["lenguajefinal"]?> </td>
            <td><?php echo $row["cientificofinal"]?> </td>
            <td><?php echo $row["eticahumanofinal"]?> </td>
            <td><?php echo $row["serfinal"]?> </td>

            <td align="center"><?php echo $row["finalbimestre"]?> </td>
            </tr>
            <?php } ?>
            <?php foreach ($resultado2 as $row) { ?>
            <tr>
            <td align="center"><?php echo $row['Matricula']  ?> </td>
            <td ><?php echo $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre']; ?> </td><td> </td>
            <td ><?php echo $row["lenguaje1"]?> </td>
            <td><?php echo $row["cientifico1"]?> </td>
            <td><?php echo $row["eticahumano1"]?> </td>
            <td><?php echo $row["ser1"]?> </td>
            <td align="center"><?php echo $row["1bimestre"]?> </td>

            <td ><?php echo $row["lenguaje2"]?> </td>
            <td><?php echo $row["eticahumano2"]?> </td>
            <td><?php echo $row["cientifico2"]?> </td>
            <td><?php echo $row["ser2"]?> </td>
            <td align="center"><?php echo $row["2bimestre"]?> </td>

            <td ><?php echo $row["lenguaje3"]?> </td>
            <td><?php echo $row["cientifico3"]?> </td>
            <td><?php echo $row["eticahumano3"]?> </td>
            <td><?php echo $row["ser3"]?> </td>

            <td align="center"><?php echo $row["3bimestre"]?> </td>

            
            <td ><?php echo $row["lenguajefinal"]?> </td>
            <td><?php echo $row["cientificofinal"]?> </td>
            <td><?php echo $row["eticahumanofinal"]?> </td>
            <td><?php echo $row["serfinal"]?> </td>

            <td align="center"><?php echo $row["finalbimestre"]?> </td>
            </tr>
            <?php } ?>
            </table>
            <?php
            break;
            default:
            $consulta = $conexion->prepare("SELECT alumnos.Id_alumno, Matricula, Nombre, Apellidop, Apellidom, lenguaje{$bimestre}, cientifico{$bimestre}, eticahumano{$bimestre}, ser{$bimestre}, {$bimestre}bimestre FROM alumnos, {$primerDigito}calificaciones WHERE grado=?");
            $consulta->bind_param('s', $primerDigito);
            
            $consulta2 = $conexion->prepare("SELECT alumnos.Id_alumno, Matricula, Nombre, Apellidop, Apellidom, lenguaje{$bimestre}, cientifico{$bimestre}, eticahumano{$bimestre}, ser{$bimestre}, {$bimestre}bimestre FROM alumnos, {$segundoDigito}calificaciones WHERE grado=?");
            $consulta2->bind_param('s', $segundoDigito);
            
            $consulta->execute();
            $resultado = $consulta->get_result();
            
            $consulta2->execute();
            $resultado2 = $consulta2->get_result();
        ?>


    <table class="table">
    <th>Matricula</th>
            <th>Nombre</th>
            <th>Lenguajes</th>
            <th>Saberes y pensamiento</th>
            <th>Ética naturaleza y sociedad</th>
            <th>De lo humano a lo comunitario</th>
            <th>promedio  </th>
            <tr>
            <?php foreach ($resultado as $row) { ?>
            <td align="center"><?php echo $row['Matricula']  ?> </td>
            <td><?php echo $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre']; ?></td>
            <td><?php echo $row["lenguaje$bimestre"]?> </td>
            <td><?php echo $row["cientifico$bimestre"]?> </td>
            <td><?php echo $row["eticahumano$bimestre"]?> </td>
            <td><?php echo $row["ser$bimestre"]?> </td>

            <td align="center"><?php echo $row["${bimestre}bimestre"]?> </td>
            </tr>
            <?php } ?>
            <?php foreach ($resultado2 as $row) { ?>
            <tr>
            <td align="center"><?php echo $row['Matricula']  ?> </td>
            <td ><?php echo $row['Apellidop'] . " " . $row['Apellidom'] . " " . $row['Nombre']; ?></td>
            <td ><?php echo $row["lenguaje$bimestre"]?> </td>
            <td><?php echo $row["cientifico$bimestre"]?> </td>
            <td><?php echo $row["eticahumano$bimestre"]?> </td>
            <td><?php echo $row["ser$bimestre"]?> </td>

            <td align="center"><?php echo $row["${bimestre}bimestre"]?> </td>
            </tr>
            <?php } ?>
        </table>
        <?php
        break;
        }
    }
    ?>
<?php include_once "vistas/footer.php"; ?>