<?php
require_once __DIR__ . '/cabeceraAdmin.php';
require_once __DIR__ . "/../models/admin2.php";

?>
<div class="container-fluid">
    <div class="row">
        <table class="table table-striped table-bordered table-light col-12 col-lg-4 offset-lg-4 mt-4">
            <thead class="thead-dark text-center">
                <tr>
                    <th> <?= $selecFecha ?></th>
                    <th> <?= $numeroAula ?> </th>
                    <th> <?= $consult ?></th>
                </tr>
            </thead>
            <tr class="text-center">
                <form action=<?=
                                htmlspecialchars("zonaAdmin2") ?> method="POST">
                    <td>
                        <input name="fecha" id="fecha" type="date" value="<?= $fec ?>">
                    </td>
                    <!-- // onchange="this.form.submit()" -->
                    <td>
                        <select id="selectAulas" name="selectAulas" class="custom-select text-center">
                            <option value="todas" selected>Todas</option>
                            <?php for ($i = 1; $i <= 31; $i++) : ?>
                                <option value="<?= $i ?>"> <?= $i ?> </option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td>
                        <input name="envio" id="envio" type="submit" class="button btn-secondary form-control col-12" value="<?= $send ?>">
                    </td>
                </form>
            </tr>
        </table>
    </div>
    <?php if ($reservas == false) : ?>
        <h3 class="text-center mt-3"> <?= $noReserva ?> </h3>
    <?php endif ?>
    <?php if ($reservas != false) : ?>
        <h2 class="text-center mt-3"> <?= $tableBooking ?> </h2>
        <div class="row">
            <table class="table table-striped table-bordered table-light col-12 col-lg-10 offset-lg-1 mt-4 text-center justify-content">
                <thead class="thead-dark">
                    <tr>
                        <th> <?= $reservado ?></th>
                        <th> <?= $aula ?></th>
                        <th> <?= $user ?> </th>
                        <th> <?= $aulaHora ?> </th>
                    </tr>
                </thead>
                <?php foreach ($reservas as $reserva) : ?>
                    <?php $res = $reserva->getIdreserva();
                    $idAula = $reserva->getIdaula();
                    $idAl = obtenerAlumno($reserva->getIdalumno())->getNombre();
                    $hora =  $reserva->getHora()->format("H:i:s"); ?>
                    <tr class="id- <?= $res ?>  idaula- <?= $idAula ?> idalumno- <?= $idAl ?>  tr text-center">
                        <td> <?= $res ?></td>
                        <td> <?= $idAula ?> </td>
                        <td> <?= $idAl ?> </td>
                        <td> <?= $hora ?> </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php endif ?>
    <?php if ($reservasCamara == false) : ?>
        <h3 class="text-center mt-3"> <?= $noReservaCamara ?> </h3>
    <?php endif ?>
    <?php if ($reservasCamara != false) : ?>
        <h2 class="text-center mt-3"> <?= $tableBookingCam ?> </h2>
        <div class="row">
            <table class="table table-striped table-bordered table-light col-12 col-lg-10 offset-lg-1 mt-4 text-center justify-content">
                <thead class="thead-dark">
                    <tr>
                        <th> <?= $reservado ?> </th>
                        <th> <?= $aula ?> </th>
                        <th> <?= $user ?> </th>
                        <th> <?= $user . 2 ?></th>
                        <th> <?= $user . 3 ?></th>
                        <th> <?= $aulaHora ?> </th>
                    </tr>
                </thead>
                <?php foreach ($reservasCamara as $reserva) : ?>
                    <?php $res = $reserva->getIdreserva();
                    $idAula = $reserva->getIdaula();
                    $idAl = obtenerAlumno($reserva->getIdalumno())->getNombre();
                    $idAl2 = obtenerAlumno($reserva->getIdalumno2())->getNombre();
                    $idAl3 = obtenerAlumno($reserva->getIdalumno3())->getNombre();
                    $hora = $reserva->getHora()->format("H:i:s"); ?>
                    <tr class="id- <?= $res ?>  idaula- <?= $idAula ?> idalumno- <?= $idAl ?> idalumno2- <?= $idAl2 ?> idalumno3- <?= $idAl3 ?> tr text-center">
                        <td> <?= $res ?> </td>
                        <td> <?= $idAula ?> </td>
                        <td> <?= $idAl ?></td>
                        <td> <?= $idAl2 ?> </td>
                        <td> <?= $idAl3 ?> </td>
                        <td> <?= $hora ?> </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3 mt-5">
                <button type="button" id="return" name="return" class="btn btn-success form-control col-12 col-lg-4 offset-lg-4 mt-3" style="font-weight: bold" onclick="window.location='principalAdmin'"> <?= $return ?>
                </button>
            </div>
        </div>
    </div>
</div>