<?php include_once "vistas/sidebar.php"; ?>
<?php
$sql = "SELECT id_periodo FROM periodo WHERE fecha_inicio <= CURDATE() AND fecha_fin >= CURDATE()";
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
  //$periodo = mysqli_fetch_assoc($resultado)["id_periodo"];
  //echo $periodo;
  ?>
    <div class="grey-bg container-fluid">
    <section id="minimal-statistics">
        <div class="row">
        <div class="col-12 mt-3 mb-2">
            <h4 class="text-uppercase">BIENVENIDO</h4>
        </div>
        </div>
        <center><img src="logo.png" alt="logo" width="400" height="400"></center>
        </div>
        </div>
    <?php
} else {
  $periodo = null;
}
?>
    </section>
    </div>
<?php include_once "vistas/footer.php"; ?>
<style>
    h4 {
    font-size: 40px; /* Tamaño de la fuente */
    color: #000080; /* Color del texto */
    font-family: 'Arial', sans-serif; /* Tipo de fuente */
    font-weight: bold; /* Negrita */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    text-align: center;
    letter-spacing: 2px; /* Espaciado entre letras */
}
</style>