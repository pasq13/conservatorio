<?php
session_start();
require_once __DIR__ . '/cabeceraPrincipal.php';
require_once __DIR__ . "/../models/log.php";
?>

<div class="container-fluid">
    <form class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4 p-5 border border-secondary mt-5" method="POST" id="login" name="login" action="<?php
                                                                                                                                                    echo htmlspecialchars("login");
                                                                                                                                                    ?>">
        <legend class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2  text-center mb-3"><?php echo $sign; ?></legend>
        <div class="form-group mb-3">
            <label for="correo" class="sr-only"><?php echo $email; ?></label>
            <input type="text" id="correo" class="form-control col-md-10 offset-md-1 col-12 col-lg-8 offset-lg-2" name="correo" placeholder="<?php echo $email; ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="password" class="sr-only"><?php echo $password; ?></label>
            <input type="password" id="password" class="form-control col-md-10 offset-md-1 col-12 col-lg-8 offset-lg-2 " placeholder="<?php echo $password; ?>" name="password" required>
        </div>
        <div class="form-group mb-3">
            <button type="submit" id="button" class="btn btn-success col-md-10 offset-md-1 form-control col-12 col-lg-8 offset-lg-2 "><?php echo $sign; ?>
            </button>
        </div>
    </form>
</div>