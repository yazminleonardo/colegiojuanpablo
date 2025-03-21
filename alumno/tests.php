<?php
// Inicia sesión si aún no está iniciada
include_once "vistas/sidebar.php";
?>

<div class="container">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            // Array con los títulos de los tests y sus URLs
            $tests = array(
                "Test de Inteligencia Corporal" => "testcorp.php",
                "Test de Inteligencia Interpersonal" => "testinter.php",
                "Test de Inteligencia Intrapersonal" => "testintra.php",
                "Test de Inteligencia Linguistica" => "testlin.php",
                "Test de Inteligencia Matemática" => "testmat.php",
                "Test de Inteligencia Músical" => "testmusic.php",
                "Test de Inteligencia Naturalista" => "testnat.php",
                "Test de Inteligencia Visual" => "testvi.php"
            );

            // Iterar sobre los tests y generar las tarjetas
            foreach ($tests as $titulo => $url) {
                // Verificar si el test ya ha sido completado
                $completedFlag = strtolower(str_replace(" ", "_", $titulo)) . '_completed';
                if (isset($_SESSION[$completedFlag]) && $_SESSION[$completedFlag]) {
                    // El test ya ha sido completado, no mostrar la tarjeta de selección del test
                    continue;
                }
            ?>
                <!-- Tarjeta de selección del test -->
                <div class="col">
                    <div class="card card h-100">
                        <a href="Alumnos/<?php echo $url; ?>" style="text-decoration:none;">
                            <img src="imagenes/inteligencias_multiples.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" style="color:black;"><?php echo $titulo; ?></h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include_once "vistas/footer.php"; ?>