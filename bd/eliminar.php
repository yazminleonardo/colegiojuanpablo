<?php
include "conexion.php";

$id_evento=$_GET['id_evento'];

    $eliminar=" DELETE FROM  eventos WHERE id_evento= '".$id_evento."'";

    $ejecutar = mysqli_query($conexion, $eliminar);

    if (mysqli_affected_rows($conexion)) {echo' 
        <script>
            //alert("Producto eliminado exitosamente");
            window.location = "../eventos.php";
        </script>
    ';} else {echo'
        <script>
        alert("no);
            window.location = "eventos.php";
        </script>
    ';}
?>