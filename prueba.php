<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>IGNACIO ZARAGOZA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/product/">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
   
      nav {
        margin: 0;
    padding: 0;
     }

     .primera-seccion {
      background: linear-gradient(rgba(1, 7, 26, 0.65),rgba(4, 77, 15, 0.46)),url(imagenes/FONDO.png) no-repeat center/cover;
      background-attachment: fixed;
      height: 70vh;
    }

    .logo-container {
      margin-top: -20vh; /* Experimenta con valores negativos para subir el logo */
    }


    @media (max-width: 768px) {
      .primera-seccion {
        height: 70vh; /* Cambiar el tamaño para pantallas más pequeñas */
      }
      .img-fluid{
        width: 100%;
      }
      .logo-container {
      margin-top: 10vh; /* Experimenta con valores negativos para subir el logo */
    }

    }
  </style>
</head>
<body>
<main>
  
  <div class="position-relative primera-seccion">
    <nav class="navbar navbar-expand-lg bg-transparent barra-navegacion">
			<div class="container-fluid">
				<a href="index.php" class="navbar-brand link-light" style="font-weight: 900;">IGNACIO ZARAGOZA</a>
				<button class="navbar-toggler btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="box-shadow: none; border: none;">
				<span class="navbar-toggler-icon text-white"></span><!--url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")-->
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle link-light" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2rem; font-weight: bold;">
							Estudiantes
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">Calendario escolar</a></li>
							<li><a class="dropdown-item" href="#">Avisos importantes</a></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="login.php">Sistema</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="#eventosdest" class="nav-link link-light" aria-current="page" style="font-size: 1.2rem; font-weight: bold;">Eventos destacados</a>
					</li>
				</ul>
			</div>
		</nav>
    <br><br><br>
    <div class="col-md-6 p-lg-5 mx-auto text-center logo-container">
      
      <div class="d-flex justify-content-center mb-3">
        <img src="imagenes/logo.png" style="width: 50%;   filter: drop-shadow(12px 12px 5px rgba(0, 0, 0, 0.397));
        " class="img-fluid" alt="Logo">
      </div>
      <!-- <div>
        Descubriendo el mundo a través del 
			conocimiento y los valores.
      </div> -->
      </div>
    </div>
  </div>
</main>
<br>
<div class="container-fluid marketing text-center">
  <img src="imagenes/eventoss.png" class="img-fluid" style="height: 115px;" alt="Eventos Escolares">
</div>
<div class="container marketing text-center">
    <br>
    <div class="container-fluid" id="eventosdest">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
        include('bd/conexion.php');
        $query = "SELECT * FROM eventos";
        $resultado = $conexion->query($query);
        while ($row = $resultado->fetch_assoc()) {
        ?>
        <div class="col">
            <div class="card h-100" style="background: linear-gradient(45deg, rgba(0, 0, 0, 0.459) 0%, rgba(0, 0, 0, 0.514) 100%), url('data:image/jpg;base64,<?php echo base64_encode($row['img_evento']) ?>'); background-size: cover;">
                <br><br><br><br><br><br>
            
                <div class="card-body text-center d-flex flex-column justify-content-between">
                <div>
                <h2 class="card-title text-white" style="text-transform: uppercase;"><?php echo $row['nom_evento']; ?></h2>
                <p class="card-text text-white"><?php echo $row['desc_evento']; ?></p>
                </div>
                <div class="mt-auto"></div>
            </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    </div>
</div>

<footer class="container py-5 ">
  <div class="row">
    <div class="col-12 col-md">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
      <small class="d-block mb-3 text-body-secondary">&copy; 2017–2023</small>
    </div>

    <div class="col-6 col-md">
      <h5>Features</h5>
      <ul class="list-unstyled text-small">
        <li><a class="link-secondary text-decoration-none" href="#">Cool stuff</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Random feature</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Team feature</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Stuff for developers</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Another one</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Last time</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>Resources</h5>
      <ul class="list-unstyled text-small">
        <li><a class="link-secondary text-decoration-none" href="#">Resource name</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Resource</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Another resource</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Final resource</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>Resources</h5>
      <ul class="list-unstyled text-small">
        <li><a class="link-secondary text-decoration-none" href="#">Business</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Education</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Government</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Gaming</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>About</h5>
      <ul class="list-unstyled text-small">
        <li><a class="link-secondary text-decoration-none" href="#">Team</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Locations</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Privacy</a></li>
        <li><a class="link-secondary text-decoration-none" href="#">Terms</a></li>
      </ul>
    </div>
  </div>
</footer>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
