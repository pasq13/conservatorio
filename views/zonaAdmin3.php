<?php
require_once __DIR__ . '/cabeceraAdmin.php';
require_once __DIR__ . "/../models/admin3.php";

?>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-12 col-lg-3 offset-lg-2 mt-5">
            <form class="col-12  col-lg-10offset-lg-1 p-5 my-auto mx-auto border border-secondary mt-5" method="POST" id="register" name="register" action=<?= htmlspecialchars("zonaAdmin3") ?> method="POST">
                <legend class="col-lg-10 offset-lg-1  text-center mb-3"><?= $consult ?> </legend>
                <div class="form-group mb-3">
                    <label for="mail" class="sr-only">email</label>
                    <input type="email" id="mail" class="form-control col-12 col-lg-10 offset-lg-1 " placeholder="email" name="mail">
                </div>
                <div class="form-group mb-3">
                    <button type="submit" onclick="this.form.submit()" id="button" class="btn btn-success form-control col-lg-10 col-12 offset-lg-1 "><?= $consult ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-7">
            <?php if ($aulas != false) : ?>
                <h2 class="text-center"> <?= $tableBooking ?></h2>
                <table class="table table-striped table-bordered table-light col-12 col-lg-10 offset-lg-1 mt-4 text-center justify-content">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th><?= $name ?></th>
                            <th> email </th>
                            <th><?= $instrument ?> </th>
                            <th> <?= $aula ?></th>
                            <th><?= $aulaHora ?></th>
                            <th><?= $fecha ?></th>
                        </tr>
                    </thead>
                    <?php foreach ($aulas as $aul) : ?>
                        <?php $fechaaula = $aul->getFecha(); ?>
                        <?php if ($fechaaula >= $fechaActual) : ?>
                            <tr class=" text-center">
                                <td> <?= $alumno->getNombre() ?> </td>
                                <td> <?= $alumno->getCorreo() ?></td>
                                <td> <?= $alumno->getInstrumento() ?> </td>
                                <td> <?= $aul->getIdaula() ?> </td>
                                <td> <?= $aul->getHora()->format("H:i:s") ?> </td>
                                <td> <?= $aul->getFecha()->format("d-m-Y") ?> </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
            <?php if ($camaraRes != false) : ?>
                <h2 class="text-center"> <?= $tableBookingCam ?> </h2>
                <table class="table table-striped table-bordered table-light col-12 col-lg-10 offset-lg-1 mt-4 text-center justify-content">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th> <?= $name ?></th>
                            <th> email </th>
                            <th> <?= $instrument ?></th>
                            <th> <?= $user . 2 ?> </th>
                            <th> <?= $user . 3 ?> </th>
                            <th> <?= $aula ?> </th>
                            <th> <?= $aulaHora ?> </th>
                            <th> <?= $fecha ?> </th>
                        </tr>
                    </thead>
                    <?php foreach ($camaraRes as $cam) : ?>
                        <?php $fechaacam = $cam->getFecha() ?>
                        <?php if ($fechaacam >= $fechaActual) : ?>
                            <tr class=" text-center">
                                <td> <?= $alumnoCamara->getNombre() ?> </td>
                                <td> <?= $alumnoCamara->getCorreo() ?> </td>
                                <td> <?= $alumnoCamara->getInstrumento() ?> </td>
                                <?php if (intval($alumnoCamara->getId()) != intval($cam->getIdalumno()) && intval($alumnoCamara->getId()) != intval($cam->getIdalumno2())) : ?>
                                    <td> <?= obtenerAlumno($cam->getIdalumno())->getNombre() ?> </td>
                                    <td> <?= obtenerAlumno($cam->getIdalumno2())->getNombre() ?> </td>
                                <?php elseif (intval($alumnoCamara->getId()) != intval($cam->getIdalumno()) && intval($alumnoCamara->getId()) != intval($cam->getIdalumno3())) : ?>
                                    <td> <?= obtenerAlumno($cam->getIdalumno())->getNombre() ?> </td>
                                    <td> <?= obtenerAlumno($cam->getIdalumno3())->getNombre() ?> </td>
                                <?php elseif (intval($alumnoCamara->getId()) != intval($cam->getIdalumno2()) && intval($alumnoCamara->getId()) != intval($cam->getIdalumno3())) : ?>
                                    <td> <?= obtenerAlumno($cam->getIdalumno2())->getNombre() ?> </td>
                                    <td> <?= obtenerAlumno($cam->getIdalumno3())->getNombre() ?> </td>
                                <? endif ?>
                                <td> <?= $cam->getIdaula() ?> </td>
                                <td> <?= $cam->getHora()->format("H:i:s") ?> </td>
                                <td> <?= $cam->getFecha()->format("d-m-Y") ?> </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3 mt-5">
                <button type="button" id="return" name="return" class="btn btn-success form-control col-12 col-lg-4 offset-lg-4 mt-3" style="font-weight: bold" onclick="window.location='principalAdmin'"> <?= $return ?>
                </button>
            </div>
        </div>
    </div>
</div>