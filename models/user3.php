<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/../src/fx/ajustesCuenta.php';
/**
 * hacemos los ajustes de la cuenta cambiamos correo o contraseña segun convenga al usuario
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['buttonmail'])) {
        $newcorreo = $_POST['email'];
        $nwmail = cambiarCorreo($_SESSION['CORREO'], $_POST['email'], $_POST['email2']);
        if ($nwmail == true) {
            $_SESSION['CORREO'] = $newcorreo;
            echo "<h3 class='text-center'>" . $cambiomail . "</h3>";
        }
    }
    if (isset($_POST['buttonpass'])) {
        $nmpass = cambiarClave($_POST['password'], $_POST['password2'], $_POST['passwordold'], $_SESSION['CORREO']);
        if ($nmpass == true) {
            echo "<h3 class='text-center'>" . $cambiopass . "</h3>";
        }
    }
}