<?php
require_once __DIR__.'/cabeceraAdmin.php'; 
?>
<div class="container-fluid text-center">
    <div class="row mt-5 col-12 col-lg-10 offset-lg-2">
        <div class="card col-12 col-sm-12 col-lg-3 m-lg-4 mt-5 mt-md-o">
            <img src="../images/usuarios.jpeg" class="card-img-top mt-4" style="max-width: 350px;" alt="...">
            <div class="card-body">
                <h3 class="card-title"><?php echo $tableUser; ?></h3>
                <a href="zonaAdmin" style="font-weight: bold;" class="btn btn-success col-12 col-lg-10 "><?php echo $tableSolicitud; ?></a>
            </div>
        </div>
        <div class="card col-12 col-sm-12 col-lg-3 m-lg-4 mt-5 mt-md-o">
            <img src="../images/clases.png" class="card-img-top mt-4 mb-5 mx-auto d-block" style="max-width: 350px;" alt="...">
            <div class="card-body">
                <h3 class="card-title mt-5 mb-3"><?php echo $consultClass; ?></h3>
                <a href="zonaAdmin2" style="font-weight: bold;" class="btn btn-success col-12 col-lg-10  "><?php echo $consult; ?></a>
            </div>
        </div>
        <div class="card col-12 col-sm-12 col-lg-3 m-lg-4 mt-5 mt-md-o">
            <img src="../images/resalum.jpeg" class="card-img-top mt-4" style="max-width: 350px;" alt="...">
            <div class="card-body">
                <h3 class="card-title mt-4 mb-3"><?php echo $reserva; ?></h3>
                <a href="zonaAdmin3" style="font-weight: bold;" class="btn btn-success col-12 col-lg-10 "><?php echo $reserva; ?></a>
            </div>
        </div>
    </div>
</div>