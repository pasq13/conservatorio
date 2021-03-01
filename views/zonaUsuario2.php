<?php
require_once __DIR__ . '/cabeceraUsuario.php';
require_once __DIR__ . "/../models/user2.php";
?>
<div class="container-fluid">
    <?php if ($aulas == FALSE) : ?>
        <h2 class=" text-center mt-3"> <?= $noReserva ?> </h2>
    <?php endif ?>
    <?php if ($aulas != FALSE) : ?>
        <h2 class="text-center mt-3"> <?= $tableBooking ?> </h2>
        <div class="row">
            <table class="table col-12 col-lg-8 offset-lg-2 table text-center table-striped table-bordered table-light mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th> <?= $reservado ?> </th>
                        <th> <?= $aula ?> </th>
                        <th> <?= $aulaHora ?> </th>
                        <th> <?= $fecha ?></th>
                        <th> <?= $reject ?> </th>
                    </tr>
                </thead>
                <?php foreach ($aulas as $aular) : ?>
                    <?php $fechaaula = $aular->getFecha(); ?>
                    <?php if ($fechaaula >= $fechaActual) : ?>
                        <tr>
                            <form action=<?=
                                            htmlspecialchars("zonaUsuario2") ?> method="POST">
                                <td> <?= $aular->getIdreserva() ?> </td>
                                <input name="idres" type="hidden" value=" <?= $aular->getIdreserva() ?> ">
                                <td> <?= $aular->getIdaula() ?> </td>
                                <input name="idaula" type="hidden" value=" <?= $aular->getIdaula() ?> ">
                                <td> <?= $aular->getHora()->format("H:i:s") ?> </td>
                                <input name="horares" type="hidden" value=" <?= $aular->getHora()->format(" H:i:s") ?> ">
                                <td> <?= $aular->getFecha()->format(" d-m-Y") ?> </td>
                                <input name="fechares" type="hidden" value=" <?= $aular->getFecha()->format(" d-m-Y") ?> ">
                                <td>
                                    <input name="enviocancel" id="enviocancel" type="submit" class="button btn-secondary form-control col-md-12 text-center" value=" <?= $reject ?> ">
                                    <input name="enviocancel" type="hidden" value=" <?= $_SESSION['CORREO'] ?>">
                                </td>
                            </form>
                        </tr>
                    <?php endif; ?>
                <?php endforeach ?>
            </table>
        </div>
    <?php endif ?>
    <?php if ($camaraRes == false) : ?>
        <h2 class=" text-center mt-3"> <?= $noReservaCamara ?> </h2>
    <?php endif; ?>
    <?php if ($camaraRes != false) : ?>
        <h2 class=" text-center"> <?= $tableBookingCam ?> </h2>
        <div class="row">
            <table class="table col-12 col-lg-8 offset-lg-2 table text-center table-striped table-bordered table-light mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th> <?= $reservado ?> </th>
                        <th> <?= $aula ?></th>
                        <th> <?= $aulaHora ?> </th>
                        <th> <?= $fecha ?> </th>
                        <th> <?= $reject ?> </th>
                    </tr>
                </thead>
                <?php foreach ($camaraRes as $res) : ?>
                    <?php $fechaaula = $res->getFecha(); ?>
                    <?php if ($fechaaula >= $fechaActual) : ?>
                        <tr>
                            <form action=<?=
                                            htmlspecialchars("zonaUsuario2") ?> method="POST">
                                <td> <?= $res->getIdreserva() ?> </td>
                                <input name="idrescam" type="hidden" value=" <?= $res->getIdreserva() ?> ">
                                <td> <?= $res->getIdaula() ?> </td>
                                <input name="idaulacam" type="hidden" value=" <?= $res->getIdaula() ?> ">
                                <td> <?= $res->getHora()->format("H:i:s") ?> </td>
                                <input name="horarescam" type="hidden" value=" <?= $res->getHora()->format("H:i:s") ?> ">
                                <td> <?= $res->getFecha()->format(" d-m-Y") ?></td>
                                <input name="fecharescam" type="hidden" value=" <?= $res->getFecha()->format("d-m-Y") ?> ">
                                <td>
                                    <input name="enviocancel2" id="enviocancel2" type="submit" class="button btn-secondary form-control col-md-12 text-center" value=" <?= $reject ?> ">
                                    <input name="enviocancel2" type="hidden" value=" <?= $_SESSION['CORREO'] ?>">
                                </td>
                            </form>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </table>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3 mt-4">
                <button type="button" id="return" name="return" class="btn btn-success form-control col-12 col-lg-4 offset-lg-4 " style="font-weight: bold" onclick="window.location= 'principalUsuario' "> <?= $return ?>
                </button>
            </div>
        </div>
    </div>
</div>