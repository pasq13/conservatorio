<?php
require_once __DIR__ . '/cabeceraPrincipal.php';
require_once __DIR__ . "/../models/reg.php";
?>


<div class="container-fluid">
    <form class="col-12 col-md-10 offset-md-1 col-lg-4 offset-lg-4 p-5 border border-secondary mt-5" onsubmit="return comprobarPass()" method="POST" id="register" name="register" action="<?php
                                                                                                                                                                                            echo htmlspecialchars("register");
                                                                                                                                                                                            ?>">
        <legend class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2  text-center mb-3"><?php echo $register; ?></legend>
        <div class="form-group mb-3">
            <label for="nombre" class="sr-only"><?php echo $name; ?></label>
            <input type="text" id="nombre" class="form-control col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2" placeholder="<?php echo $name; ?>" name="nombre" required>
        </div>
        <div class="form-group mb-3">
            <label for="apellidos" class="sr-only"><?php echo $surname; ?></label>
            <input type="text" id="apellidos" class="form-control col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2" placeholder="<?php echo $surname; ?>" name="apellidos" required>
        </div>
        <div class="form-group mb-3">
            <label for="instrumento" class="sr-only"><?php echo $instrument; ?></label>
            <input type="text" id="instrumento" class="form-control col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2" placeholder="<?php echo $instrument; ?>" name="instrumento" required>
        </div>
        <div class="form-group mb-3">
            <label for="correo" class="sr-only"><?php echo $email; ?></label>
            <input type="email" id="correo" class="form-control col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2" name="correo" placeholder="<?php echo $email; ?>" required>
        </div>
        <p class="oculto text-center" id="errorreg"><?= $errorpass ?></p>
        <div class="form-group mb-3">
            <label for="passwordreg" class="sr-only"><?php echo $password; ?></label>
            <input type="password" id="passwordreg" class="form-control col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2" placeholder="<?php echo $password; ?>" name="passwordreg" required>
        </div>
        <div class="form-group mb-3">
            <label for="password2reg" class="sr-only"><?php echo $passwordrep; ?></label>
            <input type="password" id="password2reg" class="form-control col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2" placeholder="<?php echo $passwordrep; ?>" name="password2reg" required>
        </div>

        <div class="form-group mb-3">
            <button type="submit" id="buttonreg" name="buttonreg" class="btn btn-success form-control col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2"><?php echo $register; ?>
            </button>
        </div>
    </form>
</div>