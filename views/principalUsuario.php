<?php
require_once __DIR__ . '/cabeceraUsuario.php';
?>
<div class="container-fluid text-center">
    <div class="row mt-5 col-12 col-lg-10 offset-lg-2">
        <div class="card col-12 col-md-10 col-lg-3 m-lg-4 mt-5 mt-lg-o">
            <img src="../images/reserva.jpg" class="card-img-top mx-auto  mt-4 " style="max-width: 350px;" alt="...">
            <div class="card-body">
                <h3 class="card-title mb-3"><?php echo $reservar; ?></h3>
                <a href="zonaUsuario" class="btn btn-success col-12 col-lg-10 mt-4"><?php echo $reservar; ?></a>
            </div>
        </div>
        <div class="card col-12 col-sm-12 col-md-10  col-lg-3 m-lg-4 mt-5 mt-lg-o">
            <img src="../images/horario.jpg" class="card-img-top  mt-5 mx-auto " style="max-width: 350px;" alt="...">
            <div class="card-body">
                <h3 class="card-title mt-4 mb-4 " style="font-size: 1.62em;"><?php echo $consultaReserva; ?></h3>
                <a href="zonaUsuario2" class="btn btn-success col-12 col-lg-10 mt-3 "><?php echo $consult; ?></a>
            </div>
        </div>
        <div class="card col-12 col-sm-12 col-md-10  col-lg-3 m-lg-4 mt-5 mt-lg-o">
            <img src="../images/ajustes.png" class="card-img-top mt-4  mx-auto" style="max-width: 200px;" alt="...">
            <div class="card-body">
                <h3 class="card-title mb-3"><?php echo $count; ?></h3>
                <a href="zonaUsuario3" class="btn btn-success col-12 col-lg-10 "><?php echo $count; ?></a>
            </div>
        </div>
    </div>
</div>