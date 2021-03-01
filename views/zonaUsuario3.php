<?php
require_once __DIR__ . '/cabeceraUsuario.php';
require_once __DIR__ . "/../models/user3.php";

?>

<div class="container-fluid">
    <h2 class="text-center"><?= $count ?></h2>
    <div class="row mt-5">
        <div class="col-12 col-lg-3 offset-lg-3 mt-2">
            <form class="col-sm-12  p-5 my-auto mx-auto border border-secondary mt-5" onsubmit="return comprobarPass()" method="POST" id="changepass" name="changepass" action=<?= htmlspecialchars("zonaUsuario3") ?> method="POST">
                <legend class="col-12 col-lg-10 offset-lg-1  text-center mb-3"> <?= $change ?> </legend>
                <p class="oculto text-center" id="error"><?= $errorpass ?></p>
                <div class="form-group mb-3">
                    <label for="password" class="sr-only"> <?= $password ?> </label>
                    <input type="password" id="passwordold" class="form-control col-12 col-lg-10 offset-lg-1 " placeholder=" <?= $password ?> " name="passwordold" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="sr-only"> <?= $passwordnew ?> </label>
                    <input type="password" id="password" class="form-control col-12 col-lg-10 offset-lg-1 " placeholder=" <?= $passwordnew ?> " name="password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password2" class="sr-only"> <?= $passwordrep ?> </label>
                    <input type="password" id="password2" class="form-control col-12 col-lg-10 offset-lg-1 " placeholder=" <?= $passwordrep ?> " name="password2" required>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" id="buttonpass" name="buttonpass" class="btn btn-success form-control col-12 col-lg-10 offset-lg-1 "> <?= $send ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-3  mt-4">
            <form class="col-sm-12 p-5 my-auto mx-auto border border-secondary mt-5" onsubmit="return comprobarEmail()" method="POST" id="cangemail" name="changemail" action=<?= htmlspecialchars("zonaUsuario3") ?> method="POST">
                <legend class="col-12 col-lg-10 offset-lg-1  text-center mb-3"> <?= $changemail ?> </legend>
                <p class="oculto text-center" id="error2"><?= $errormail ?></p>
                <div class="form-group mb-3">
                    <label for="email" class="sr-only"><?= $emailnew ?></label>
                    <input type="email" id="email" class="form-control col-12 col-lg-10 offset-lg-1 " placeholder="<?= $emailnew ?>" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email2" class="sr-only"><?= $emailrep ?></label>
                    <input type="email" id="email2" class="form-control col-12 col-lg-10 offset-lg-1" placeholder="<?= $emailrep ?>" name="email2" required>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" id="buttonmail" name="buttonmail" class="btn btn-success form-control col-12 col-lg-10 offset-lg-1 "> <?= $send ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row ">
        <div class="col-12">
            <div class="form-group mb-3 mt-4">
                <button type="button" id="return" name="return" class="btn btn-success form-control col-12 col-lg-4 offset-lg-4 " style="font-weight: bold" onclick="window.location= 'principalUsuario' "> <?= $return ?>
                </button>
            </div>
        </div>
    </div>
</div>