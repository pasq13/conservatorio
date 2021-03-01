<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/../src/fx/controlAulas.php';
/**
 * El administrador comprueba las aulas ocupadas para un dia en concreto
 */
$reservas = false;
$reservasCamara = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fec = $_POST['fecha'];
    $au = $_POST['selectAulas'];
    if (isset($fec) && isset($au)) {
        if (strtoupper($au) == 'TODAS') {
            $reservas = compruebaAulas($au, $fec);
            $reservasCamara = compruebaAulaCamara($fec);
        } elseif (intval($au) == 13) {
            $reservasCamara = compruebaAulaCamara($fec);
        } else {
            $reservas = compruebaAulas($au, $fec);
        }
    }
}