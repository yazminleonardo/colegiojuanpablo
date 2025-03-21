<?php include_once "vistas/sidebar.php"; ?>
                <div class="container">
                    <!-- Content here -->
                    <h3 class="center">Calificaciones</h3>
                    <p class="">Defina las fechas en las cuales se realizará la captura de calificaciones de cada periodo.</p>
                </div>
                <br>
                <div class="container">
                    <div class="row g-4">
                    <?php
                    include_once('bd/conexion.php');
                    $query1="SELECT * FROM periodo WHERE id_periodo=1";
                    $consulta=$conexion->query($query1);
                    if ($row=$consulta->fetch_assoc()) {
                        ?>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow-sm">
                            <button style="background-color: transparent; border: none;" data-bs-toggle="modal" data-bs-target="#editar<?php echo $row['id_periodo']?>">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="bi bi-mortarboard-fill"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <h5><?php echo $row['id_periodo']?>° periodo</h5>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            </div>
                        </div>
                        <!-- Modal Editar1-->
                        <div class="modal fade" id="editar<?php echo $row['id_periodo']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Fechas para captura de calificaciones 1° periodo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formulario" action="bd/editar_periodo.php?ideditar=<?php echo $row['id_periodo']?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="validationCustom04" class="form-label fw-bold">Fecha de inicio de la captura de calificaciones:</label>
                                            <input type="date" name="fecha_inicio" id="fechaInicio" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="validationCustom04" class="form-label fw-bold">Fecha de término de la captura de calificaciones:</label>
                                            <input type="date" name="fecha_fin" id="fechaFinal" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success" id="guardar5">Guardar</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $query2="SELECT * FROM periodo WHERE id_periodo=2";
                    $consulta1=$conexion->query($query2);
                    if ($row1=$consulta1->fetch_assoc()) {
                        ?>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow-sm">
                            <button style="background-color: transparent; border: none;" data-bs-toggle="modal" data-bs-target="#editar1<?php echo $row1['id_periodo']?>">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="bi bi-mortarboard-fill"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <h5> <?php echo $row1['id_periodo']?>° periodo</h5>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            </div>
                        </div>
                        <!-- Modal Editar1-->
                        <div class="modal fade" id="editar1<?php echo $row1['id_periodo']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Fechas para captura de calificaciones 2° periodo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formulario1" action="bd/editar_periodo.php?ideditar=<?php echo $row1['id_periodo']?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="validationCustom04" class="form-label fw-bold">Fecha de inicio de la captura de calificaciones:</label>
                                            <input type="date" name="fecha_inicio" id="fechaInicio1" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="validationCustom04" class="form-label fw-bold">Fecha de término de la captura de calificaciones:</label>
                                            <input type="date" name="fecha_fin" id="fechaFinal1" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success" id="">Guardar</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $query3="SELECT * FROM periodo WHERE id_periodo=3";
                    $consulta2=$conexion->query($query3);
                    if ($row2=$consulta2->fetch_assoc()) {
                        ?>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow-sm">
                            <button style="background-color: transparent; border: none;" data-bs-toggle="modal" data-bs-target="#editar2<?php echo $row2['id_periodo']?>">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="bi bi-mortarboard-fill"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <h5> <?php echo $row2['id_periodo']?>° periodo</h5>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            </div>
                        </div>
                        <!-- Modal Editar1-->
                        <div class="modal fade" id="editar2<?php echo $row2['id_periodo']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Fechas para captura de calificaciones 3° periodo</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formulario2" action="bd/editar_periodo.php?ideditar=<?php echo $row2['id_periodo']?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="validationCustom04" class="form-label fw-bold">Fecha de inicio de la captura de calificaciones:</label>
                                            <input type="date" name="fecha_inicio" id="fechaInicio2" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="validationCustom04" class="form-label fw-bold">Fecha de término de la captura de calificaciones:</label>
                                            <input type="date" name="fecha_fin" id="fechaFinal2" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success" id="">Guardar</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <br><br>
                <label class="h3">Modificar calificaciones</label><br><br>
                <div class="container">
                <div class="row g-4">
                    <!--<div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="modificarpres.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h5><i class="bi bi-pencil-square"></i>Solicitudes de modificaciones preescolar</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>-->
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="modificar_calificaciones.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h5><i class="bi bi-pencil-square"></i>Solicitudes de modificaciones primaria</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="modificarsecu.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h5><i class="bi bi-pencil-square"></i>Solicitudes de modificaciones secundaria</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--<label class="h3">Modificar calificaciones</label>
                <div class="container">
                <div class="row g-4">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow-sm">
                        <a href="modificar_calificaciones.php" style="background-color: transparent; border: none; text-decoration: none; color:black;" onclick="consultarcalif()">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h5><i class="bi bi-pencil-square"></i>Solicitudes de modificaciones</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>-->
<script>
$("#formulario").submit(function(e){
  var fechaInicio = document.getElementById("fechaInicio").value;
  var fechaFinal = document.getElementById("fechaFinal").value;

  var fechaInicioObjeto = new Date(fechaInicio);
  var fechaFinalObjeto = new Date(fechaFinal);

  var diferencia = fechaFinalObjeto.getTime() - fechaInicioObjeto.getTime();

  if (fechaFinalObjeto < fechaInicioObjeto || diferencia > 172800000) {
    e.preventDefault();
    Swal.fire({
        position: 'center',
        type: 'warning',
        title: 'La fecha final no puede ser menor a la inicial ó es mayor a 3 días!',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        timer: 20000
    })
    }else{
    Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Las fechas han sido registradas correctamente',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        timer: 20000
    });
}
});

$("#formulario1").submit(function(e){
  var fechaInicio1 = document.getElementById("fechaInicio1").value;
  var fechaFinal1 = document.getElementById("fechaFinal1").value;

  var fechaInicioObjeto1 = new Date(fechaInicio1);
  var fechaFinalObjeto1 = new Date(fechaFinal1);

  if (fechaFinalObjeto1 < fechaInicioObjeto1) {
    e.preventDefault();
    Swal.fire({
        position: 'center',
        type: 'warning',
        title: 'La fecha final no puede ser menor a la inicial ó es mayor a 3 días!',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        timer: 20000
    })
  }else{
  Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Las fechas han sido registradas correctamente',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        timer: 20000
    });
}
});
$("#formulario2").submit(function(e){
  var fechaInicio2 = document.getElementById("fechaInicio2").value;
  var fechaFinal2 = document.getElementById("fechaFinal2").value;

  var fechaInicioObjeto2 = new Date(fechaInicio2);
  var fechaFinalObjeto2 = new Date(fechaFinal2);

  if (fechaFinalObjeto2 < fechaInicioObjeto2) {
    e.preventDefault();
    Swal.fire({
        position: 'center',
        type: 'warning',
        title: 'La fecha final no puede ser menor a la inicial ó es mayor a 3 días!',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        timer: 20000
    })
  }else{
  Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Las fechas han sido registradas correctamente',
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
        timer: 20000
    });
}
});
/*$(".periodo").click(function (){
    Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Tus datos han sido registrados correctamente',
        showConfirmButton: false,
        timer: 20000
    });
});*/
</script>
<?php include_once "vistas/footer.php"; ?>