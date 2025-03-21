<?php include_once "vistas/sidebar.php"; ?>
<?php
// Configuración de seguridad y conexión
$periodo = null;
if ($stmt = mysqli_prepare($conexion, "SELECT nombre FROM periodo WHERE fecha_inicio <= CURDATE() AND fecha_fin >= CURDATE()")) {
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $periodo = htmlspecialchars($fila['nombre']);
    }
    mysqli_stmt_close($stmt);
}
?>
<input type="hidden" id="periodo" value="<?php echo $periodo; ?>">

<div id="subircalif" style="overflow-x: auto;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Campo formativo</th>
                <th scope="col">1° Trimestre</th>
                <th scope="col">2° Trimestre</th>
                <th scope="col">3° Trimestre</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php 
            $materiapres = [
                12 => 'Español',
                13 => 'Ingles',
                14 => 'Edu. Artistica',
                15 => 'Matematicas',
                16 => 'Tecnologia',
                17 => 'F.C y E',
                18 => 'Conoc. del medio',
                19 => 'Edu. Física',
                20 => 'Edu. en la Fe',
                21 => 'Edu. Socioemocional',
                22 => 'Vida Saludable',
            ];
            
            foreach ($materiapres as $id => $nombre) : 
            ?>
            <tr>
                <td scope="row"><?php echo $nombre; ?></td>
                <?php for ($periodo_id = 1; $periodo_id <= 3; $periodo_id++) : ?>
                <td>
                    <a href="capturar1.php?id_periodo=<?php echo $periodo_id; ?>&campo=<?php echo $id; ?>&campo_formativo=<?php echo urlencode($nombre); ?>" 
                       id="periodo<?php echo $periodo_id; ?>_<?php echo $id; ?>" 
                       class="btn btn-success">
                        Capturar
                    </a>
                </td>
                <?php endfor; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function verificarperiodo() {
    const periodoActual = document.getElementById("periodo").value;
    const periodosValidos = ['captura_de_calificacion1', 'captura_de_calificacion2', 'captura_de_calificacion3'];

    // Habilitar solo el período correspondiente
    periodosValidos.forEach((periodo, index) => {
        const periodoNum = index + 1;
        const habilitar = periodo === periodoActual;
        
        // Activar/desactivar todos los botones del período
        document.querySelectorAll(`[id^="periodo${periodoNum}_"]`).forEach(boton => {
            boton.classList.toggle('disabled', !habilitar);
            boton.style.pointerEvents = habilitar ? 'auto' : 'none';
            boton.style.opacity = habilitar ? '1' : '0.5';
        });
    });
}

window.onload = verificarperiodo;
</script>