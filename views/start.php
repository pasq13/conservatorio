<?php
require_once __DIR__ . '/cabeceraPrincipal.php';
?>
<div class="container-fluid mt-3">
    <div class="row mt-3">
        <div class="col-lg-4 offset-lg-4 p-5 border border-secondary">
            <legend class="col-lg-8 offset-lg-2  text-center mb-3"><?php echo $welcome; ?></legend>
            <div class="form-group mb-3">
                <button type="button" id="sign" name="sign" class="btn btn-success form-control col-lg-8 offset-lg-2 " onclick="window.location='login'"><?php echo $sign; ?>
                </button>
            </div>
            <div class="form-group mb-3">
                <button type="button" id="register" name="register" class="btn btn-success form-control col-lg-8 offset-lg-2 " onclick="window.location='register'"><?php echo $register; ?>
                </button>
            </div>
        </div>
    </div>
</div>