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
	<link rel="stylesheet" href="css/login.css">
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
            <h1>Iniciar sesión</h1>
            <form id="formLogin" action="" method="post">
                <div class="mb-3">
                    <input type="text" id="usuario" name="usuario" placeholder="Correo" >
                </div>
                <div class="mb-3">
                    <input type="password" id="password" name="password" placeholder="Contraseña">
                </div>
                <input type="submit" value="ingresar" name="submit" class="btn-ingresar">
            </form>
        </div>
        <!-- <div class="login">
            <p>¿Necesitas una cuenta?<a href="registro.php" style="font-weight: bold;">Registrarse</a></p>
        </div> -->
    </div>
    <?php
if (isset($_POST['submit'])) {
    require 'bd/conexion.php';
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    //Verificar si el usuario es docente
    $sql = "SELECT id, grado1, grado2, grado3, grado4, grado5, grado6 FROM docentes WHERE Correo_D='$usuario' AND Password_D='$password'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        $session_row = mysqli_fetch_assoc($result);
        //$session = $session_row['id'];
        session_start();
        $_SESSION['usuario'] = $session_row['id'];
        $_SESSION['grado1'] = $session_row['grado1'];
        $_SESSION['grado2'] = $session_row['grado2'];
        $_SESSION['grado3'] = $session_row['grado3'];
        $_SESSION['grado4'] = $session_row['grado4'];
        $_SESSION['grado5'] = $session_row['grado5'];
        $_SESSION['grado6'] = $session_row['grado6'];
        //$_SESSION['usuario'] = $session;
        header('location:docentes/index_docente.php');
        exit();
    }

    //Verificar si el usuario es administrador
    $sql = "SELECT correo FROM admin WHERE Password='$password' AND correo ='$usuario'";
            $result = mysqli_query($conexion, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $session_query=mysqli_query($conexion,"SELECT id_admin FROM admin WHERE correo='$usuario'");
                $session_row=mysqli_fetch_assoc($session_query);
                $session=$session_row['id_admin'];
                session_start();
                $_SESSION['usuario']=$session;
            header('location:admin/index_admin.php');
            } 
            else {
                ?>
                <script type="text/javascript">
                    Swal.fire({
                        position: 'center',
                        type: 'warning',
                        title: '¡Matrícula y/o contraseña incorrecta, inténtelo de nuevo!',
                        showConfirmButton: true,
                        confirmButtonText: 'Aceptar',
                        timer: 20000
                    });
                </script>
                <?php
            }

    //Si no coincide con ningún usuario
    ?>
    <script type="text/javascript">
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: '¡Correo y/o contraseña incorrectos!',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            timer: 20000
        });
    </script>
    <?php
}
?>

</body>
</html>