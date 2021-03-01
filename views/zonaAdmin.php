<?php
require_once __DIR__ . '/cabeceraAdmin.php';
require_once __DIR__ . "/../models/admin.php";

?>
<div class="container-fluid">
    <?php if ($peticiones === FALSE) : ?>
        <h2 class=" text-center mt-5"> <?= $noSolicitud ?> </h2>
    <?php else : ?>
        <h2 class="text-center mt-5"> <?= $tableSolicitud ?> </h2>
        <div class="row">
            <table class="table table-striped table-bordered table-light col-sm-10 offset-1 mt-4 text-center justify-content">
                <thead class="thead-dark">
                    <tr>
                        <th> <?= $name ?> </th>
                        <th> <?= $surname ?> </th>
                        <th> <?= $instrument ?></th>
                        <th>email</th>
                        <th> <?= $accept . "/" . $reject ?> </th>
                        <th> <?= $send ?></th>
                    </tr>
                </thead>
                <?php foreach ($peticiones as $peticion) : ?>
                    <tr>
                        <form action=<?= htmlspecialchars("zonaAdmin") ?> method="POST">
                            <td> <?= $peticion->getNombre() ?> </td>
                            <input name="name" type="hidden" value="<?= $peticion->getNombre() ?>">
                            <td> <?= $peticion->getApellidos() ?></td>
                            <input name="surname" type="hidden" value="<?= $peticion->getApellidos() ?>">
                            <td> <?= $peticion->getInstrumento() ?></td>
                            <input name="instrument" type="hidden" value="<?= $peticion->getInstrumento() ?>">
                            <td><?= $peticion->getCorreo() ?> </td>
                            <input name="mail" type="hidden" value="<?= $peticion->getCorreo() ?>">
                            <td>
                                <select name="boolean" class="custom-select" style="text-align-last:center">
                                    <option value="1" selected> <?= $accept ?> </option>
                                    <option value="0"> <?= $reject ?> </option>
                                </select>
                            </td>
                            <td>
                                <input type="submit" name="envio" class="button btn-secondary form-control col-12" value=" <?= $send ?>">
                                <input name="clave" type="hidden" value="<?= $peticion->getPassword() ?>">
                            </td>
                        </form>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3 mt-5">
                <button type="button" id="return" name="return" class="btn btn-success form-control col-12 col-lg-4 offset-lg-4 mt-3" style="font-weight: bold" onclick="window.location='principalAdmin'"> <?= $return ?>
                </button>
            </div>
        </div>
    </div>
</div>