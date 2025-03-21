<?php
    include 'bd/conexion.php';
    session_start();
    ?>
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
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>    
    <script src="bootstrap/js/bootstrap.min.js"></script>    
    <script src="popper/popper.min.js"></script>    
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>  
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fw-bold text-uppercase border-bottom">
                <a class="sidebar-brand" href="#">Ignacio Zaragoza</a>
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="index_tutor.php" class="list-group-item list-group-item-action second-text fw-bold">
                    <i class="bi bi-house-fill"></i> Inicio
                </a>
                <a href="calificaciones.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="bi bi-mortarboard-fill"></i> Consultar calificaciones
                </a>
                <a href="asistencia.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="bi bi-clipboard2-check"></i>Consultar asistencia
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
        <?php
        $usuario=$_SESSION['usuario'];
        $sql=mysqli_query($conexion,"SELECT * FROM tutores WHERE id_padre='$usuario'");
        while ($consulta=mysqli_fetch_array($sql)) {
            ?> 
            <nav class="navbar navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                </div>
                
                <ul style="list-style-type: none;">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $consulta['Nombre'];?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item close" href="../bd/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </li>
                </ul>
                    <?php
                }
                ?>
            </nav>
            <!--Vista contenido-->
            <div class="container-fluid px-4">

    <script>
        $('.close').on('click',function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: '¿Cerrar sesión?',
                text: false,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Salir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                    }
                    document.location.href=href;
                }
            })
        })
    </script>