<style>
.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    max-width: 80%;
    font-size: 1.25rem;
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    padding: 0.625rem 1.25rem;
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    margin-right: 0.25em;
}

.iborrainputfile {
	font-size:16px; 
	font-weight:normal;
	font-family: 'Lato';
}
/* style 1 */
.inputfile-1 + label {
    color: #fff;
    background-color: #009d63;
}

.inputfile-1:focus + label,
.inputfile-1.has-focus + label,
.inputfile-1 + label:hover {
    border-color: gray;
    outline: none;
}
</style>

<?php include_once "vistas/sidebar.php"; ?>
<div class="container">
    <!-- Formulario de búsqueda -->
    <label for="busqueda" class="h5">Ingrese Nombre:</label>
    <form class="d-flex" action="" method="GET">
        <input id="busqueda" class="form-control me-2 light-table-filter" type="text" name="busqueda" aria-label="Search" style="width: 300px;" onKeyUp="mayusculas(this)">
        <button type="submit" class="btn btn-success">Buscar</button>
        <a href="info_alum.php" class="btn btn-primary ms-2">Mostrar Todos</a>
    </form>
    
    <!-- Lista de autocompletado -->
    <div id="suggestions" class="suggestions-box"></div>

    <?php
    include 'bd/conexion.php';

    if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
        $buscar = trim($_GET['busqueda']); // Elimina espacios innecesarios

        if (strpos($buscar, ' ') !== false) {
            $consulta = $conexion->prepare("SELECT * FROM alumnos WHERE CONCAT(Nombre, ' ', Apellidop, ' ', Apellidom) = ?");
            $consulta->bind_param("s", $buscar);
        } else {
            $buscar_like = "%$buscar%";
            $consulta = $conexion->prepare("SELECT * FROM alumnos WHERE Nombre LIKE ? OR Apellidop LIKE ? OR Apellidom LIKE ?");
            $consulta->bind_param("sss", $buscar_like, $buscar_like, $buscar_like);
        }

        $consulta->execute();
        $info = $consulta->get_result();

        if ($fila = $info->fetch_assoc()) {
            // Si hay un solo resultado, mostrar el formulario de edición
    ?>
    <div class="row g-3 mx-auto p-2">
        <form class="row g-3" action="bd/editar_info.php?ideditar=<?php echo $fila['Id_alumno']; ?>" method="post">
            <div class="header rounded-4 bg-light">
                <h5 class="h4 text-center">Datos Generales</h5>
            </div>
            <div class="col-md-4 text-center">
                <h4 class="h5">Nombre:</h4>
                <input type="text" class="form-control" name="nombre" value="<?php echo htmlspecialchars($fila['Nombre']); ?>" onKeyUp="mayusculas(this)">
            </div>
            <div class="col-md-4 text-center">
                <h4 class="h5">Apellido paterno:</h4>
                <input type="text" class="form-control" name="apellidop" value="<?php echo htmlspecialchars($fila['Apellidop']); ?>" onKeyUp="mayusculas(this)">
            </div>
            <div class="col-md-4 text-center">
                <h4 class="h5">Apellido Materno:</h4>
                <input type="text" class="form-control" name="apellidom" value="<?php echo htmlspecialchars($fila['Apellidom']); ?>" onKeyUp="mayusculas(this)">
            </div>
            <div class="col-md-4 text-center">
                <label for="grupo" class="form-label fw-bold">Nivel educativo</label>
                <select class="form-select" name="nivel" id="nivel" required>
                    <option selected disabled>Selecciona una opción</option>
                    <option value="PREESCOLAR" <?php echo ($fila['nivel'] == 'PREESCOLAR') ? 'selected' : ''; ?>>PREESCOLAR</option>
                    <option value="PRIMARIA" <?php echo ($fila['nivel'] == 'PRIMARIA') ? 'selected' : ''; ?>>PRIMARIA</option>
                    <option value="SECUNDARIA" <?php echo ($fila['nivel'] == 'SECUNDARIA') ? 'selected' : ''; ?>>SECUNDARIA</option>
                </select>
            </div>
            <div class="col-md-4 text-center">
                <label for="grado" class="form-label fw-bold">Grado</label>
                <select class="form-select" name="grado" id="grado" required>
                    <option selected disabled>Selecciona una opción</option>
                    <?php for ($i = 1; $i <= 6; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php echo ($fila['grado'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 text-center">
                <label for="grupo" class="form-label fw-bold">Grupo</label>
                <select class="form-select" name="grupo" id="grupo" required>
                    <option selected disabled>Selecciona una opción</option>
                    <option value="A" <?php echo ($fila['grupo'] == 'A') ? 'selected' : ''; ?>>A</option>
                    <option value="B" <?php echo ($fila['grupo'] == 'B') ? 'selected' : ''; ?>>B</option>
                </select>
            </div>
            <hr>
            <div class="text-center">
                <button type="submit" id="btn_1" class="btn btn-success" style="width: 15rem;"><i class="bi bi-floppy"></i> Guardar cambios</button>
                <a href="bd/eliminar_info.php?iddel=<?php echo $fila['Id_alumno']; ?>" class="btn btn-danger btn-del"><i class="bi bi-trash"></i>Eliminar</a>
            </div>
        </form>
    </div>
    <?php
        } else {
            echo '<p class="h5 text-center">Los datos no existen</p>';
          }
    }
    ?>
</div>

<?php include_once "vistas/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

<script type="text/javascript">
        $("#btn_1").click(function (){
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Los datos han sido actualizados correctamente',
                showConfirmButton: false,
                timer: 20000
            })
        });
</script>

<script>
        $('.btn-del').on('click',function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({ 
                title: '¿Está seguro que desea eliminar los datos?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,eliminar datos!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Eliminado!',
                        text: 'Los datos han sido eliminados correctamente',
                        type: 'success',
                        showConfirmButton: false,
                        timer: 20000
                    })
                    if (result.isConfirmed) {
                    }
                    document.location.href=href;
                }
            })
        })
</script>

<!--ESTILO DE AUTOCOMPLETADO-->
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