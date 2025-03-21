<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de información escolar</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../jquery/jquery-3.3.1.min.js"></script>    
    <script src="../bootstrap/js/bootstrap.min.js"></script>    
    <script src="../popper/popper.min.js"></script>    
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>  
</head>
<style>
    body{
        background-image: linear-gradient(
        to right,
        #baf3d7,
        #c2f5de,
        #cbf7e4,
        #d4f8ea,
        #ddfaef
        );
    }
</style>
<body>
    <div class="d-flex" id="wrapper">
<?php
session_start();
require '../BD/conexion.php';
$linguistica = $_SESSION['linguistica'];
$matematicas = $_SESSION['mate'];
$musica = $_SESSION['musica'];
$visual = $_SESSION['visual'];
$corporal = $_SESSION['corporal'];
$interpersonal = $_SESSION['interpersonal'];
$naturalista = $_SESSION['naturalista'] ;
$intrapersonal = $_SESSION['intrapersonal'];
$usuario=$_SESSION['usuario'];

$mayor=max($linguistica,$matematicas,$musica,$visual,$corporal,$interpersonal,$naturalista,$interpersonal,$intrapersonal);

switch($mayor){
    case $linguistica:
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=1 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia lingüística!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
    case $matematicas:
        //echo"felicidades tienes una inteligencia lógica matematica";
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=2 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia lógica matemática!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
    case $musica:
        //echo"felicidades tienes una inteligencia musical";
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=3 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia musical!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.value) {
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
    case $visual:
        //echo"felicidades tienes una inteligencia visual";
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=4 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia visual!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.value) {
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
    case $corporal:
        //echo"felicidades tienes una inteligencia cinestetica corporal";
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=5 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia corporal!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
    case $naturalista:
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=6 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia naturalista!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
    case $interpersonal:
        //echo"felicidades tienes una inteligencia interpersonal";
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=7 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia interpersonal!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) { 
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
    case $intrapersonal:
        //echo"felicidades tienes una inteligencia intra personal";
        $insertar=mysqli_query($con,"UPDATE alumnos SET id_inteligencia=8 where Id_alumno='$usuario'");
        if($insertar) {
            ?>
            <script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Felicidades tienes una inteligencia intrapersonal!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        if(result.isConfirmed) {
                        }
                        document.location.href="../index_alumno.php";
                    }
                })
            </script>
            <?php
            }?>
        <?php
        break;
}
?>
    </div>
</body>
</html>