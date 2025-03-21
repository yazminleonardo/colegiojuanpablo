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
                    <!-- Content here --> 
                    <h1 class="center">Registrar alumno</h1>

                    <div class="row g-3 mx-auto p-2">
                        <form action="" class="row g-3" method="post" id="formLogin" name="fp" enctype="multipart/form-data">
                            <div class="col-md-4 text-center">
                                <label for="validationCustom01" class="form-label fw-bold">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" onKeyUp="mayusculas(this)" required>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="validationCustom" class="form-label fw-bold">Apellido Paterno:</label>
                                <input type="text" name="apellidop" id="apellidop" class="form-control" onKeyUp="mayusculas(this)" required>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="validationCustom" class="form-label fw-bold">Apellido Materno:</label>
                                <input type="text" name="apellidom" id="apellidom" class="form-control" onKeyUp="mayusculas(this)" required>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="validationCustom04" class="form-label fw-bold">Nivel educativo</label>
                                <select class="form-select" name="nivel" id="nivel" required>
                                    <option selected disabled value="">Selecciona una opción</option>
                                    <option>PREESCOLAR</option>
                                    <option>PRIMARIA</option>
                                    <option>SECUNDARIA</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="validationCustom04" class="form-label fw-bold">Grado</label>
                                <select class="form-select" name="grado" id="grado" required>
                                    <option selected disabled value="">Selecciona una opción</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="validationCustom04" class="form-label fw-bold">Grupo</label>
                                <select class="form-select" name="grupo" id="grupo" required>
                                    <option selected disabled value="">Selecciona una opción</option>
                                    <option>M</option>
                                    <option>A</option>
                                    <option>B</option>
                                </select>
                            </div>
                            <br><br> 
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" onclick="validarPass()"><i class="bi bi-person-add"></i> Registrar alumno</button>
                            </div>
                        </form>
                    </div>
                </div>
<script>
(() => {
  'use strict'

  const forms = document.querySelectorAll('.needs-validation')

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
<script>
    function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>
<script type="text/javascript">
  $('#formLogin').submit(function(e){
    e.preventDefault(); 

    var nombre = $.trim($("#nombre").val());
    var apellidop = $.trim($("#apellidop").val());
    var apellidom = $.trim($("#apellidom").val());
    var nivel = $.trim($("#nivel").val());
    var grado = $.trim($("#grado").val());
    var grupo = $.trim($("#grupo").val());

    if (nombre === "" || apellidop === "" || apellidom === "" || nivel === "" || grado === "" || grupo === "") {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Complete los campos correctamente',
            showConfirmButton: false,
            timer: 1500
        });
    } else {
        $.ajax({
            url: "bd/agregar_alumno.php",
            type: "POST",
            dataType: "json",
            data: {nombre: nombre, apellidop: apellidop, apellidom: apellidom, nivel: nivel, grado: grado, grupo: grupo},
            success: function(response) {
                if (response.status === "success") {     
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Se ha registrado exitosamente',
                        showConfirmButton: true,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "info_alum.php";  
                        }
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        type: 'error',
                        title: 'Error en el registro',
                        text: response.message,
                        showConfirmButton: true
                    });
                }
            },
            error: function() {
                Swal.fire({
                    position: 'center',
                    type: 'error',
                    title: 'No se pudo conectar al servidor',
                    showConfirmButton: true
                });
            }
        });
    }
});
</script>
<?php include_once "vistas/footer.php"; ?>