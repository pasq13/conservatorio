<?php
require __DIR__ . "/../bootstrap.php";
date_default_timezone_set("Europe/Madrid");
$uri = basename($_SERVER['REQUEST_URI']);
if ($uri == 'httdocs' || $uri == 'index.php') {
    require __DIR__ . "/../views/start.php";
} elseif ($uri == "login") {
    require __DIR__ . "/../views/login.php";
} elseif ($uri == "register") {
    require  __DIR__ . "/../views/register.php";
} elseif ($uri == "logout") {
    require  __DIR__ . "/../src/fx/logout.php";
} elseif ($uri == "principalAdmin") {
    require __DIR__ . '/../views/principalAdmin.php';
} elseif ($uri == "zonaAdmin") {
    require __DIR__ . '/../views/zonaAdmin.php';
} elseif ($uri == "zonaAdmin2") {
    require __DIR__ . '/../views/zonaAdmin2.php';
} elseif ($uri == "zonaAdmin3") {
    require __DIR__ . '/../views/zonaAdmin3.php';
} elseif ($uri == "principalUsuario") {
    require __DIR__ . '/../views/principalUsuario.php';
} elseif ($uri == "zonaUsuario") {
    require __DIR__ . '/../views/zonaUsuario.php';
} elseif ($uri == "zonaUsuario2") {
    require __DIR__ . '/../views/zonaUsuario2.php';
} elseif ($uri == "zonaUsuario3") {
    require __DIR__ . '/../views/zonaUsuario3.php';
} elseif ($uri == "selects") {
    require __DIR__ . '/../src/fx/selects.php';
} else {
    header('Status:404 Not Found');
    echo '<html><body>Página No Encontrada</body></html>';
}
