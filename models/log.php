<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/../src/fx/controlUsuarios.php';
/**
 * Hacemos login dependiendo del tipo de cuenta nos redirige a un sitio o a otro
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usu = login($_POST['correo'], $_POST['password']);
    if ($usu === FALSE) {
        $err = TRUE;
        $usuario = $_POST['correo'];
        echo '<script type="text/javascript">
        alert("' . $errorUser . '");
        window.location.href="login";
        </script>';
    } else if (is_a($usu, 'Administrador')) {
        $_SESSION['CREADA'] = "SI";
        $_SESSION['ADMINISTRADOR'] = $usu->getNombre();
        $_SESSION['ROL'] = $usu->getAdmin();
        echo  '<script type="text/javascript">window.location.href="principalAdmin";
        </script>';
    } else {
        $_SESSION['CREADA'] = "SI";
        $_SESSION['USUARIO'] = $usu->getNombre();
        $_SESSION['CORREO'] = $usu->getCorreo();
        $_SESSION['INSTRUMENTO'] = $usu->getInstrumento();
        echo  '<script type="text/javascript">window.location.href="principalUsuario";
        </script>';
    }
}