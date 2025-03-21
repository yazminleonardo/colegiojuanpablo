<?php include_once "vistas/sidebar.php"; ?>
                <div class="container">
                    <!-- Content here --> 
                    <h1 class="center">Docentes</h1>
                    <!--Button agregar-->
                    <div class="mb-3" style="text-align:right;">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregar"><i class="bi bi-plus-lg"></i>Agregar nuevo docente</button>
                    </div>
                    <!-- Modal agregar -->
                    <div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar docente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post" id="formLogin" name="fp" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="md-3">
                                            <label for="validationCustom" class="form-label fw-bold">Nombre:</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" onKeyUp="mayusculas(this)" required>
                                        </div>
                                        <div class="md-3">
                                            <label for="validationCustom" class="form-label fw-bold">Apellido Paterno:</label>
                                            <input type="text" name="apellidop" id="apellidop" class="form-control" onKeyUp="mayusculas(this)" required>
                                        </div>
                                        <div class="md-3">
                                            <label for="validationCustom" class="form-label fw-bold">Apellido Materno:</label>
                                            <input type="text" name="apellidom" id="apellidom" class="form-control" onKeyUp="mayusculas(this)" required>
                                        </div>
                                        <div class="md-3">
                                            <label for="validationCustom" class="form-label fw-bold">Correo electrónico:</label>
                                            <input type="text" name="correo" id="correo" class="form-control" required>
                                        </div>
                                            <label for="validationCustom" class="form-label fw-bold">Contraseña:</label>
                                        <div class="input-group md-3">                                         
                                            <input type="password" name="password" id="password" class="form-control" id="pass1">
                                            <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                        </div>
                                            <label for="validationCustom" class="form-label fw-bold">Confirmar contraseña:</label>
                                        <div class="input-group md-3">
                                            <input type="password" name="password1" id="password1" class="form-control" id="pass2">
                                            <button id="show_password1" class="btn btn-primary" type="button" onclick="mostrarPassword1()"> <span class="fa fa-eye-slash icon1"></span> </button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" onclick="validarPass()">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--VISUALIZAR DOCENTES Y EDITAR-->
                    <div class="container-fluid">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <?php
                            include_once('bd/conexion.php');
                            $query2="SELECT * FROM docentes order BY Apellidop_D";
                            $consulta=$conexion->query($query2);
                            while ($row=$consulta->fetch_assoc()) {
                                ?>
                                <div class="col">
                                    <div class="card card-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['Nombre_D']; ?> <?php echo $row['Apellidop_D']; ?> <?php echo $row['Apellidom_D']; ?></h5>
                                            <!-- Buttons card-->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar<?php echo $row['id']?>"><i class="bi bi-pencil-square"></i>Editar</button>
                                            <a href="bd/eliminar_docente.php?iddel=<?php echo $row['id']; ?>" class="btn btn-danger btn-del"><i class="bi bi-trash"></i>Eliminar</a>
                                            
                                            <!-- Modal editar información del docente-->
                                            <div class="modal fade" id="editar<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar información del docente</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="bd/editar_docente.php?ideditar=<?php echo $row['id']?>" method="post" enctype="multipart/form-data">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom02" class="form-label fw-bold">Nombre:</label>
                                                                    <input type="text" name="nombre_d" class="form-control" value="<?php echo $row['Nombre_D'] ?>" onKeyUp="mayusculas(this)">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="validationCustom04" class="form-label fw-bold">Apellido Paterno:</label>
                                                                    <input type="text" name="apellidop_d" class="form-control" value="<?php echo $row['Apellidop_D'] ?>" onKeyUp="mayusculas(this)">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="validationCustom04" class="form-label fw-bold">Apellido Materno:</label>
                                                                    <input type="text" name="apellidom_d" class="form-control" value="<?php echo $row['Apellidom_D'] ?>" onKeyUp="mayusculas(this)">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="validationCustom04" class="form-label fw-bold">Correo electrónico:</label>
                                                                    <input type="text" name="correo_d" class="form-control" value="<?php echo $row['Correo_D'] ?>">
                                                                </div>
                                                                <!-- Campo para editar la contraseña -->
                                                                <div class="mb-3">
                                                                    <label for="validationCustom04" class="form-label fw-bold">Contraseña:</label>
                                                                    <div class="input-group md-3">
                                                                        <input type="password" name="password_d" id='password_d' class="form-control" placeholder="Nueva contraseña">
                                                                        <button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon2"></span> </button>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary guardar-edit">Guardar</button>
                                                                </div>   
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
<?php include_once "vistas/footer.php"; ?>

<script>
    function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--REGISTRO DE DATOS-->
<script type="text/javascript">
$(document).ready(function() {
    $('#formLogin').submit(function(e) {
        e.preventDefault(); // Evita el envío tradicional del formulario

        // Obtener los valores del formulario y eliminar espacios en blanco
        var nombre = $.trim($("#nombre").val());
        var apellidop = $.trim($("#apellidop").val());
        var apellidom = $.trim($("#apellidom").val());
        var correo = $.trim($("#correo").val());
        var password = $.trim($("#password").val());
        var password1 = $.trim($("#password1").val());

        // Validaciones previas
        if (nombre === "" || apellidop === "" || apellidom === "" || correo === "" || password === "" || password1 === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campos vacíos',
                text: 'Todos los campos son obligatorios',
                showConfirmButton: false,
                timer: 2000
            });
            return;
        }

        if (password !== password1) {
            Swal.fire({
                icon: 'error',
                title: 'Error de Contraseña',
                text: 'Las contraseñas no coinciden, vuelve a intentarlo',
                showConfirmButton: false,
                timer: 2000
            });
            return;
        }

        // Enviar los datos con AJAX
        $.ajax({
            url: "bd/agregar_docente.php", // Ruta del archivo PHP que procesará la solicitud
            type: "POST",
            dataType: "json", // Indica que esperamos una respuesta en formato JSON
            data: {
                nombre: nombre,
                apellidop: apellidop,
                apellidom: apellidom,
                correo: correo,
                password: password1 // Se envía la contraseña confirmada
            },
            /*beforeSend: function() {
                Swal.fire({
                    title: 'Registrando...',
                    text: 'Por favor espera',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },*/
            success: function(response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro exitoso!',
                        text: 'El docente ha sido registrado correctamente',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    setTimeout(function() {
                        window.location.href = 'docentes.php'; // Redirigir a la página de docentes
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en el registro',
                        text: response.message || 'Ocurrió un error inesperado',
                        showConfirmButton: true
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la solicitud',
                    text: 'Hubo un problema con la conexión al servidor',
                    showConfirmButton: true
                });

                console.error("Error en AJAX: ", textStatus, errorThrown);
                console.log(jqXHR.responseText); // Para depuración en consola
            }
        });
    });
});
</script>

<!--<script type="text/javascript">
    $('#formLogin').submit(function(e){
   e.preventDefault();
   var nombre = $.trim($("#nombre").val());
   var apellidop = $.trim($("#apellidop").val());
   var apellidom = $.trim($("#apellidom").val());
   var correo = $.trim($("#correo").val());
   var password =$.trim($("#password").val());    
   var password1 =$.trim($("#password1").val());    
    
    if(password.length == "" || password1 == ""){
        Swal.fire({
                position: 'center',
                type: 'warning',
                title: 'Complete los campos correctamente',
                showConfirmButton: false,
                timer: 1500
        }) 
    }else{
        if (password == password1) {
        $.ajax({
            url:"bd/agregar_docente.php",
            type:"POST",
            datatype: "json",
            data: {nombre:nombre, apellidop:apellidop, apellidom:apellidom, correo:correo, password1:password1}, 
            success:function(data){     
                if(data){          
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Se ha registrado exitosamente!',
                    showConfirmButton: false,
                    timer: 20000
                })
                setTimeout("window.location.href = 'docentes.php'",2);
                }
            }
        });
        }else{
            Swal.fire({
                    position: 'center',
                    type: 'warning',
                    title: 'Las contraseñas no coinciden, vuelve a intentarlo',
                    showConfirmButton: false,
                    timer: 20000
                })
        }
    }     
    });
</script>-->

<!--MUESTRA LAS CONTRASEÑAS-->
<script type="text/javascript">
    function mostrarPassword(){
		var cambio = document.getElementById("password");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	}
    function mostrarPassword1(){
		var cambio = document.getElementById("password1");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
    function mostrarPassword2(){
		var cambio = document.getElementById("password_d");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	}
</script>

<!--ACTUALIZACION DE DATOS-->
<script type="text/javascript">
$(".guardar-edit").click(function (){
    Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Los datos han sido actualizados correctamente',
                showConfirmButton: false,
                timer: 20000
            })
    });
</script>

<!--ELIMINAR-->
<script>
    $('.btn-del').on('click',function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

         Swal.fire({
            title: '¿Está seguro que deseas eliminarlo?',
            text: "¡No podrás revertir esto!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si,eliminarlo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El docente ha sido eliminado correctamente',
                    'success'
                )
                if (result.isConfirmed) {
                }
                document.location.href=href;
            }
        })
    });
</script>