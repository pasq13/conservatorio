<?php
require_once __DIR__ . '/sesiones.php';

if (!isset($_COOKIE['idioma'])) {
    require __DIR__ . '/../../lang/castellano.php';
}
if ($_COOKIE['idioma'] == 'castellano') {
    require __DIR__ . '/../../lang/castellano.php';
}
if ($_COOKIE['idioma'] == 'valencia') {
    require __DIR__ . '/../../lang/valencia.php';
}

comprobarSesion();
$_SESSION = array();
session_destroy();
setcookie(session_name(), 123, time() - 1000);
?>

<body>
    <h3 style="text-align:center; margin-top:6em;"><?= $redirect ?></h3>
    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 1500);
    </script>
</body>