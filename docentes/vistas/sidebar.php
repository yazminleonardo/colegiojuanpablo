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
    <title>Sistema escolar</title>
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
        <?php
        $usuario=$_SESSION['usuario'];
        $sql=mysqli_query($conexion,"SELECT * FROM docentes WHERE id='$usuario'");
        while ($consulta=mysqli_fetch_array($sql)) {
            ?> 
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fw-bold text-uppercase border-bottom">
                <a class="sidebar-brand">Colegio Juan Pablo II</a>
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="index_docente.php" class="list-group-item list-group-item-action second-text fw-bold">
                    <i class="bi bi-house-fill"></i>Inicio
                </a>
                <a href="#" class="list-group-item list-group-item-action second-text fw-bold dropdown-toggle"  data-bs-toggle="collapse" data-bs-target="#dashboard-collapse">
                    <i class="bi bi-people-fill"></i>Preescolar 
                </a>
                <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="maternal.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado1'];?>° Maternal</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="perfil_alum.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado1'];?>° Grado</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificacionespres2.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado2'];?>° Grado</a></li>
                    </ul>
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificacionespres3.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado3'];?>° Grado</a></li>
                    </ul>
                </div>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse1">
                    <i class="bi bi-mortarboard-fill"></i>Primaria
                </a>
                <div class="collapse" id="dashboard-collapse1">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones1.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado1'];?>° Grado A</a></li>
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones1B.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado1'];?>° Grado B</a></li>
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones2.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado2'];?>° Grado A</a></li>
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones3.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado3'];?>° Grado A</a></li>
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones4.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado4'];?>° Grado A</a></li>
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones5.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado5'];?>° Grado A</a></li>
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones6.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado6'];?>° Grado A</a></li>
                        <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificaciones6B.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado6'];?>° Grado B</a></li>
                    </ul>
                </div>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold  dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse2">
                    <i class="bi bi-clipboard2-check"></i>Secundaria 
                </a>
                <div class="collapse" id="dashboard-collapse2">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="insertar_asistencia.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado1'];?>° Grado A</a></li>
                    <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="editar_asistencia.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado2'];?>° Grado A</a></li>
                    <li class="list-alum"><a class="list-group-item list-group-item-action second-text fw-bold" href="calificacionessecu3.php" style="padding: 5px 30px;"><i class="bi bi-clipboard-fill"></i> <?php echo $consulta['grado3'];?>° Grado A</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color: #e0f7fa; color: black;">
            <nav class="navbar navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                </div>
                <ul style="list-style-type: none;">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $consulta['Nombre_D'];?>
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