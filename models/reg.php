<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/../src/fx/controlUsuarios.php';
/**
 * Aqui mandamos el formulario para que sea aceptado por  el usuario nuevo
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST'  && $_POST['nombre'] != '' &&   $_POST['apellidos'] != ''  && $_POST['instrumento'] != ''  && $_POST['correo'] != ''&& $_POST['passwordreg']=!""&& $_POST['password2reg']!="") {
    $regusuario = registroUsuario($_POST['nombre'], $_POST['apellidos'], $_POST['instrumento'], $_POST['correo'], $_POST['passwordreg'], $_POST['password2reg']);
    if ($regusuario == false) {
       
    } else {
        echo '<script type="text/javascript">
    alert("' . $siRegister . '");
    window.location.href="index.php";
    </script>';
    }
}
