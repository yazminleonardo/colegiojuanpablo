<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de información escolar</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/registro.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>    
    <script src="bootstrap/js/bootstrap.min.js"></script>    
    <script src="popper/popper.min.js"></script>    
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>  
</head>
<body>
    <div class="container">
        <div class="container form-background">
            <h1>Registro</h1>
            <form id="formLogin" action="" method="post" class="row g-3 needs-validation" novalidate>
                <div class="col-md-8">
                    <label for="validationCustom01" class="form-label">Nombre(s)</label>
                    <input type="text" class="" name="nombre" id="nombre" required onKeyUp="mayusculas(this)" style="width: 100%;">
                    <div class="invalid-feedback">
                        Por favor, ingrese su nombre.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Apellido Paterno</label>
                    <input type="text" class="" name="apellidop" id="apellidop" style="width:20rem;" required onKeyUp="mayusculas(this)">
                    <div class="invalid-feedback">
                        Por favor, ingrese su apellido.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Apellido Materno</label>
                    <input type="text" class="" name="apellidom" id="apellidom" style="width:20rem;" onKeyUp="mayusculas(this)">
                </div>
                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Curp</label>
                        <input type="text" class="" name="curp" id="curp" style="width:20rem;" maxlength="16" required onKeyUp="mayusculas(this)">
                        <div class="invalid-feedback">
                            Por favor, rellene este campo.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="" name="fecha_tutor" id="fecha_tutor" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su fecha de nacimiento.
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="validationCustom01" class="form-label">Teléfono</label>
                        <input type="text" class="" name="telefono" id="telefono" maxlength="10" style="width: 100%;" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su número de teléfono.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Correo electrónico</label>
                        <input type="email" class="" name="correo" id="correo" style="width: 100%;" required>
                        <div class="invalid-feedback">
                        Por favor, ingrese su correo electrónico.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Grado de estudios</label>
                        <select class="" name="grado_estudios" id="grado_estudios" required>
                            <option selected disabled value="">Selecciona una opción</option>
                            <option>Primaria</option>
                            <option>Secundaria</option>
                            <option>Bachillerato</option>
                            <option>Licenciatura</option>
                            <option>Ingeniería</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione una opción.
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">Domicilio</label>
                        <input type="text" class="" name="domicilio" id="domicilio" style="width: 100%;" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su domicilio.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Ocupación</label>
                        <input type="text" class="" name="ocupacion" id="ocupacion" required>
                        <div class="invalid-feedback">
                            Por favor, complete el campo.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">Tipo de familia</label>
                        <select class="" name="tipof" id="tipof" required>
                            <option selected disabled value="">Selecciona una opción</option>
                            <option>Nuclear</option>
                            <option>Extendida</option>
                            <option>Monoparental</option>
                            <option>Emsamblada</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione una opción.
                        </div>
                    </div>
                <p class="h6 fw-bold" style="text-transform: none;">Cree una contraseña con la cual podra ingresar al sistema</p>
                <div class="col-md-4">
                    <label for="validationCustom" class="form-label fw-bold">Contraseña:</label> 
                    <div class="input-group col-md-3">                                       
                        <input type="password" name="password" id="password" class="form-control" id="pass1" style="height: 3rem;" required>
                        <button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword()" style="height: 3rem;"> <span class="fa fa-eye-slash icon"></span></button>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="validationCustom" class="form-label fw-bold">Confirmar contraseña:</label>
                    <div class="input-group col-md-3">
                        <input type="password" name="password1" id="password1" class="form-control" id="pass2" required style="height: 3rem;">
                        <button id="show_password1" class="btn btn-success" type="button" onclick="mostrarPassword1()"  style="height: 3rem;"> <span class="fa fa-eye-slash icon1"></span></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Usted es tutor de:</label>
                    <select class="" name="cantidad_alumnos" onchange="cantidad_tutorados(this)" required>
                        <option selected disabled value="">Selecciona una opción</option>
                        <option value="1">1 alumno</option>
                        <option value="2">2 alumnos</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione una opción.
                    </div>
                </div>
                <div class="row g-3" id="formulario_1" style="display: none;">
                    <h1>Datos del alumno 1</h1>
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">Matrícula del alumno</label>
                        <input type="text" class="" name="matricula_alumno1" id="matricula_alumno1" onKeyUp="mayusculas(this)">
                        <div class="invalid-feedback">
                            Por favor, ingrese la matrícula.
                        </div>
                    </div>
                </div>
                <div class="row g-3" id="formulario_2" style="display: none;">
                    <h1>Datos del alumno 2</h1>
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">Matrícula del alumno</label>
                        <input type="text" class="" name="matricula_alumno2" id="matricula_alumno2" onKeyUp="mayusculas(this)">
                        <div class="invalid-feedback">
                            Por favor, ingrese la matrícula.
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-success">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
<?php
if (isset($_POST['submit'])) {
    require 'bd/conexion.php';

    $nombre=$_POST['nombre'];
    $apellidop=$_POST['apellidop'];
    $apellidom=$_POST['apellidom'];
    $curp=$_POST['curp'];
    $fecha_tutor=$_POST['fecha_tutor'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $grado_estudios=$_POST['grado_estudios'];
    $domicilio=$_POST['domicilio'];
    $ocupacion=$_POST['ocupacion'];
    $tipof=$_POST['tipof'];
    $password=$_POST['password'];
    $password1=$_POST['password1'];
    $matricula1=$_POST['matricula_alumno1'];
    $matricula2=$_POST['matricula_alumno2'];
    $cantidad_alumnos=$_POST['cantidad_alumnos'];

    switch ($cantidad_alumnos){
        case 1:
        if ($password == $password1) {
                $sql="INSERT INTO tutores(Nombre, Password, Apellidop, Apellidom, Curp, Nacimiento, Telefono, Email, Estudios, Domicilio, Ocupacion, Tipo_familia, matricula_alumno) VALUES('$nombre','$password','$apellidop','$apellidom','$curp','$fecha_tutor','$telefono','$correo','$grado_estudios','$domicilio','$ocupacion','$tipof','$matricula1')";
                $resultado=$conexion->query($sql);
                if ($resultado) {
                    ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Se ha registrado exitosamente!',
                            showConfirmButton: true,
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                if(result.isConfirmed) {
                                }
                                document.location.href="login.php";
                            }
                        })
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            type: 'warning',
                            title: 'Hubo un error, intentelo de nuevo!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                    <?php
                }
        }else{
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'warning',
                    title: 'Las contraseñas no coinciden, vuelve a intentarlo!',
                    showConfirmButton: false,
                    timer: 20000
                });
            </script>
            <?php
        }              
        break;    
        case 2:
            if ($password1 == $password) {
                $sql="INSERT INTO tutores(Nombre, Password, Apellidop, Apellidom, Curp, Nacimiento, Telefono, Email, Estudios, Domicilio, Ocupacion, Tipo_familia, matricula_alumno, matricula_alumno2) VALUES('$nombre','$password','$apellidop','$apellidom','$curp','$fecha_tutor','$telefono','$correo','$grado_estudios','$domicilio','$ocupacion','$tipof','$matricula1','$matricula2')";
                $resultado=$conexion->query($sql);
                if ($resultado) {
                    ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Se ha registrado exitosamente!',
                            showConfirmButton: true,
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                if(result.isConfirmed) {
                                }
                                document.location.href="login.php";
                            }
                        })
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            type: 'warning',
                            title: 'Hubo un error, intentelo de nuevo!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                    <?php
                }
        }else{
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'warning',
                    title: 'Las contraseñas no coinciden, vuelve a intentarlo!',
                    showConfirmButton: false,
                    timer: 20000
                });
            </script>
            <?php
        }        
        break;
        }
    }
?>
</body>
</html>
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
<script>
    function cantidad_tutorados(sel){
        if(sel.value == "1"){
            div1=document.getElementById('formulario_1');
            div1.style.display="";
            div2=document.getElementById('formulario_2');
            div2.style.display="none";
        }else{
            div1=document.getElementById('formulario_1');
            div1.style.display="";
            div2=document.getElementById('formulario_2');
            div2.style.display="";
        }
    }
</script>
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
</script>