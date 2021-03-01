<?php
require_once __DIR__ . '/cabeceraUsuario.php';
require_once __DIR__ . "/../models/user.php";
// require_once __DIR__."/../src/fx/selects.php";
?>


<div class="container-fluid">
    <h2 class="text-center"> <?= $tableBooking ?> </h2>
    <p class="text-center oculto" id="error"><?= $errorhora ?></p>
    <div class="row">
        <table class="table col-12 col-lg-6 offset-lg-3 text-center table table-striped table-bordered table-light mt-4 mb-3">
            <thead class="thead-dark text-center">
                <tr>
                    <th> <?= $reset ?> </th>
                    <th> <?= $selecFecha ?> </th>
                    <th> <?= $aulaTipo  ?></th>
                    <th> <?= $numeroAula ?></th>
                    <th> <?= $aulaHora ?> </th>
                    <th> <?= $send ?></th>
                </tr>
            </thead>
            <tr class="text-center">
                <form action=<?=
                                htmlspecialchars('zonaUsuario') ?> method="POST" onsubmit="return validar()" name="consulta">
                    <td>
                        <input type="reset" name="btnreset" value="<?= $reset ?>" id="btnreset" class="button btn-secondary form-control col-12 text-center" onclick="resetSelects()">
                    </td>

                    <td>
                        <input name="selFecha" id="selFecha" type="date" onchange="compruebaReservas()" required>
                    </td>
                    <td>
                        <select id="selTipo" name="selTipo" class="custom-select text-center" value="<?= $type ?>" onchange="cambiarSelects(this);selectAulas(this)" required>
                            <option value="" selected disabled class="piso1 piso2 piso3">Todas</option>
                            <?php switch (strtoupper($_SESSION['INSTRUMENTO'])):
                                case 'ARPA': ?>
                                    <option value="GENERAL" class="piso1 piso2 piso3">general</option>
                                    <option value="ARPA" class="piso1">arpa</option>
                                    <option value="CAMARA" class="piso1">camara</option>
                        </select>
                    </td>
                    <?php break; ?>
                <?php
                                case 'CANTO': ?>
                    <option value="GENERAL" class="piso1 piso2 piso3">general</option>
                    <option value="CANTO" class="piso1">canto</option>
                    <option value="CAMARA" class="piso1">camara</option>
                    </select></td>
                    <?php break; ?>
                <?php
                                case 'PERCUSION': ?>
                    <option value="GENERAL" class="piso1 piso2 piso3">general</option>
                    <option value="PERCUSION" class="piso1">percusion</option>
                    <option value="CAMARA" class="piso1">camara</option>
                    </select></td>
                    <?php break; ?>
                <?php
                                case 'JAZZ': ?>
                    <option value="GENERAL" class="piso1 piso2 piso3">general</option>
                    <option value="JAZZ" class="piso1">jazz</option>
                    <option value="CAMARA" class="piso1">camara</option>
                    </select></td>
                    <?php break; ?>
                <?php
                                default: ?>
                    <option value="GENERAL" class="piso1 piso2 piso3">general</option>
                    <option value="CAMARA" class="piso1">camara</option>
                    </select></td>
                    <?php break; ?>
            <?php endswitch ?>
            <td>
                <select id="selNum" name="selNum" class="custom-select text-center" onchange="cambiarSelects(this);selectAulas(this);compruebaReservas()" required>
                    <option value="" selected disabled><?= $numeroAula ?></option>
                    <?php foreach ($classes as $classe) : ?>
                        <option value="<?= $classe->getIdaula() ?>" class="<?= 'piso' . $classe->getPiso() ?>"> <?= $classe->getIdaula() ?> </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="selHora" id="selHora" class="custom-select text-center" required onchange="cambiarSelects(this)">
                    <option value="" selected disabled><?= $aulaHora ?></option>
                    <?php foreach ($hours as $hour => $h) : ?>
                        <option value="<?= $h["hora"]->format("H:i:s") ?>" class="<?= 'piso' . $h['idpiso'] ?>"><?= $h["hora"]->format("H:i:s") ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <input name="envio" id="envio" type="submit" value=" <?= $send ?>" class="button btn-secondary form-control col-12 text-center">
            </td>
                </form>
            </tr>
        </table>
    </div>
    <?php switch ($consulta):
        case "bien": ?>
            <?php break; ?>
        <?php
        case "demasiadas": ?>
            <h3 class="text-center mt-4"><?= $cantidadReservas ?></h3>
            <?php break; ?>
        <?php
        case "lejos": ?>
            <h3 class="text-center mt-4"><?= $fechaLejos ?></h3>
            <?php break; ?>
        <?php
        case "anterior": ?>
            <h3 class="text-center mt-4"><?= $fechaAnterior ?></h3>
            <?php break; ?>
        <?php
        case "ocupada": ?>
            <h3 class="text-center mt-4"><?= $ocupada ?></h3>
            <?php break; ?>
        <?php
        case "solapamientoindi": ?>
            <h3 class="text-center mt-4"><?= $solapamientoindividualtext ?></h3>
            <?php break; ?>
        <?php
        case "CAMARA": ?>
            <h4 class="text-center mt-4"><?= $tableBookingCam ?></h4>
            <div class="row">
                <table class="table col-12 col-lg-8 offset-lg-2 mt-4 tex-center table table-striped table-bordered table-light" id="tableReservaAluCamara">
                    <thead class="thead-dark">
                        <tr>
                            <th><?= $user ?></th>
                            <th><?= $user . 2 ?></th>
                            <th><?= $user . 3 ?></th>
                            <th> <?= $numeroAula ?> </th>
                            <th> <?= $fecha ?></th>
                            <th> <?= $aulaHora ?> </th>
                            <th> <?= $reservado ?> </th>
                        </tr>
                    </thead>
                    <tr class="text-center">
                        <form action=<?=
                                        htmlspecialchars('zonaUsuario') ?> method="POST" name="reservaCamara">
                            <td>
                                <input name="resal1" type="email" value="<?= $_SESSION['CORREO'] ?>" disabled>
                            </td>
                            <td>
                                <input name="resal2" type="email" value="" required>
                            </td>
                            <td>
                                <input name="resal3" type="text" value="" required>
                            </td>
                            <td> <?= $num ?> </td>
                            <input name="resnumcam" type="hidden" value="<?= $num ?>">
                            <td> <?= date("d-m-Y", strtotime($fec)) ?> </td>
                            <input name="resfeccam" type="hidden" value="<?= $fec ?>">
                            <td> <?= $horale ?> </td>
                            <input name="reshorcam" type="hidden" value="<?= $horale ?>">
                            <td>
                                <input name="envioReservaCam" class="button btn-secondary form-control col-12 text-center" id="envioReservaCam" type="submit" value=" <?= $reservado ?> ">
                            </td>
                        </form>
                    </tr>
                </table>
            </div>
            <?php break; ?>
        <?php
        default: ?>
            <h4 class="text-center mt-4"><?= $tableBooking ?></h4>
            <table class="table col-12 col-lg-6 offset-lg-3 table text-center table-striped table-bordered table-light mt-4" id="tableReservaAlu">
                <thead class="thead-dark">
                    <tr>
                        <th><?= $user ?></th>
                        <th> <?= $numeroAula ?> </th>
                        <th> <?= $fecha ?></th>
                        <th> <?= $aulaHora ?> </th>
                        <th> <?= $reservado ?> </th>
                    </tr>
                </thead>
                <tr class="text-center">
                    <form action=<?=
                                    htmlspecialchars('zonaUsuario') ?> method="POST" name="reservanormal">
                        <td>
                            <input name="resal" type="email" value="<?= $_SESSION['CORREO'] ?>" disabled>
                        </td>
                        <td> <?= $num ?> </td>
                        <input name="resnum" type="hidden" value="<?= $num ?>">
                        <td> <?= date("d-m-Y", strtotime($fec)) ?> </td>
                        <input name="resfec" type="hidden" value="<?= $fec ?>">
                        <td> <?= $horale ?> </td>
                        <input name="reshor" type="hidden" value="<?= $horale ?>">
                        <td>
                            <input name="envioReserva" class="button btn-secondary form-control col-12 text-center" id="envioReserva" type="submit" value=" <?= $reservado ?> ">
                        </td>
                    </form>
                </tr>
            </table>
            <?php break; ?>
    <?php endswitch ?>
    <?php switch ($success):
        case "no": ?>
            <?php break; ?>
        <?php
        case "ok": ?>
            <h3 class="text-center mt-4"><?= $resResultok ?></h3>
            <?php break; ?>
        <?php
        case "alumnosmal": ?>
            <h3 class="text-center mt-4"><?= $alumnosmal ?></h3>
            <?php break; ?>
        <?php
        case "alumnosusuario": ?>
            <h3 class="text-center mt-4"><?= $alumnosusuario ?></h3>
            <?php break; ?>
        <?php
        case "alumnosiguales": ?>
            <h3 class="text-center mt-4"><?= $alumnosiguales ?></h3>
            <?php break; ?>
        <?php
        case "mal":
        case "malcamara": ?>
            <h3 class="text-center mt-4"><?= $resResultbad ?></h3>
            <?php break; ?>
        <?php
        case "solapamiento": ?>
            <h3 class="text-center mt-4"><?= $solapamientocamara ?></h3>
            <?php break; ?>
        <?php
        case "construccion": ?>
            <h3 class="text-center mt-4"><?= $construccion ?></h3>
            <?php break; ?>
        <?php
        case "compimal": ?>
            <h3 class="text-center mt-4"><?= $compimal ?></h3>
            <?php break; ?>
    <?php endswitch ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3 mt-4">
                <button type="button" id="return" name="return" class="btn btn-success form-control col-12 col-lg-4 offset-lg-4 " style="font-weight: bold" onclick="window.location= 'principalUsuario' "> <?= $return ?>
                </button>
            </div>
        </div>
    </div>
</div>