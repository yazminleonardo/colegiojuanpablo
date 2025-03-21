<?php
include 'bd/conexion.php';

if (isset($_GET['q'])) {
    $busqueda = trim($_GET['q']);
    $consulta = $conexion->prepare("SELECT DISTINCT CONCAT(Nombre, ' ', Apellidop, ' ', Apellidom) AS nombre_completo FROM alumnos WHERE 
    CONCAT(Nombre, ' ', Apellidop, ' ', Apellidom) LIKE ? LIMIT 10");

    $param = "%$busqueda%";
    $consulta->bind_param("s", $param);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<div onclick='seleccionar(\"".$row['nombre_completo']."\")' class='suggestion-item'>".$row['nombre_completo']."</div>";
        }
    } else {
        echo "<div class='suggestion-item'>No encontrado</div>";
    }
}
?>
