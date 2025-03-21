<?php include_once "vistas/sidebar.php"; ?>
<div class="container">
    <label for="busqueda" class="h5">Ingrese el nombre completo:</label><br>
    <form class="d-flex" action="" method="GET">
        <input class="form-control me-2 light-table-filter" type="text" name="busqueda" id="busqueda"
            placeholder="Escriba el nombre completo..." autocomplete="off" style="width: 300px;" onKeyUp="mayusculas(this)">
        <button type="submit" class="btn btn-success">Buscar</button>
        <a href="info_alum.php" class="btn btn-primary ms-2">Mostrar Todos</a>
        <!--<button type="submit" class="btn btn-success">Buscar</button>-->
    </form>
    
    <!-- Lista de autocompletado -->
    <div id="suggestions" class="suggestions-box"></div><br><br>

    <?php
    include 'bd/conexion.php';

    if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
        $buscar = trim($_GET['busqueda']); // Elimina espacios innecesarios

        if (strpos($buscar, ' ') !== false) {
            // Si el usuario ingresó un nombre completo, buscar coincidencia exacta
            $consulta = $conexion->prepare("SELECT * FROM alumnos WHERE CONCAT(Nombre, ' ', Apellidop, ' ', Apellidom) = ? ORDER BY nivel, grado, grupo");
        } else {
            // Si solo ingresó una parte, hacer búsqueda flexible
            $consulta = $conexion->prepare("SELECT * FROM alumnos WHERE 
            Nombre LIKE ? OR Apellidop LIKE ? OR Apellidom LIKE ? ORDER BY nivel, grado, grupo");
            $buscar = "%$buscar%";
        }

        $consulta->bind_param("s", $buscar);
        $consulta->execute();
        $info = $consulta->get_result();
        
    } else {
        // Si no se busca nada, mostrar todos los alumnos ordenados
        $consulta = $conexion->prepare("SELECT * FROM alumnos ORDER BY Nivel, grado, grupo");
        $consulta->execute();
        $info = $consulta->get_result();
    }

    if ($info->num_rows > 0) { ?>
        <table class="content-table table table-bordered">
            <thead>
                <th>Matricula</th>
                <th>Nombre</th>
                <th>Nievel educativo</th>
                <th>Grado</th>
                <th>Grupo</th>
            </thead>
            <tbody class="table-group-divider">
                <?php while ($row = $info->fetch_assoc()) { ?>
                    <tr>
                    <td><?php echo $row['Matricula']; ?></td>
                        <td><?php echo $row['Nombre'] . " " . $row['Apellidop'] . " " . $row['Apellidom']; ?></td>
                        <td><?php echo $row['nivel']; ?></td>
                        <td><?php echo $row['grado']; ?>°</td>
                        <td><?php echo $row['grupo']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {
        echo "<p>No se encontraron resultados.</p>";
    }
    ?>
</div>

<?php include_once "vistas/footer.php"; ?>

<!-- JavaScript para autocompletado -->
<script>
    function mayusculas(e) {
        e.value = e.value.toUpperCase();
    }
function seleccionar(valor) {
    document.getElementById("busqueda").value = valor;
    document.getElementById("suggestions").innerHTML = "";
}

document.getElementById("busqueda").addEventListener("keyup", function() {
    let input = this.value;

    if (input.length > 1) {
        fetch("get_autocomplete_suggestions.php?q=" + input)
            .then(response => response.text())
            .then(data => {
                document.getElementById("suggestions").innerHTML = data;
            });
    } else {
        document.getElementById("suggestions").innerHTML = "";
    }
});
</script>

<style>
.suggestions-box {
    border: 1px solid #ccc;
    background: #fff;
    position: absolute;
    width: 300px;
    max-height: 150px;
    overflow-y: auto;
}

.suggestion-item {
    padding: 8px;
    cursor: pointer;
}

.suggestion-item:hover {
    background-color: #f0f0f0;
}
</style>