<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/../src/fx/controlAulas.php';
/**
 * comprobamos las reservas de los alumnos para mostrarselas y que las puedan cancelar si quisieran
 */
$fechaActual =  new DateTime();
$reservas = compruebaAulaAlumno($_SESSION['CORREO']);
if($reservas){
$alumno = array_pop($reservas);
$aulas = array_pop($reservas);
}else{
    $aulas=false;
}
$reservasCamara = compruebaAulaAlumnoCamara($_SESSION['CORREO']);
if($reservasCamara){
$alumnoCamara = array_pop($reservasCamara);
$camaraRes = array_pop($reservasCamara);
}else{
    $camaraRes=false;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['enviocancel'])) {
        $idres = $_POST['idres'];
        cancelaReserva($idres);
        echo '<script type="text/javascript">
        window.location.href="zonaUsuario2";
        </script>';
    }
    if (isset($_POST["enviocancel2"])) {
        $idrescam = $_POST['idrescam'];
        $c = cancelaReservaCamara($idrescam, $_SESSION['CORREO']);
        if ($c == true) {
            echo '<script type="text/javascript">
    window.location.href="zonaUsuario2";
    </script>';
        }
    }
}