<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/gestionReservas.php';
require_once __DIR__ . '/funcionesReservas.php';
/**
 * aqui se pide a la base de datos las horas y las aulas reservadas para con json ocultar las aulas ocupadas
 */
$reservadototal = selectPartialReservas();
$reservadototalcamara = selectPartialReservasCamara();
if ($reservadototal && $reservadototalcamara) {
    $reservasmezcladas = array_merge($reservadototal, $reservadototalcamara);
    asort($reservasmezcladas);
} elseif ($reservadototal) {
    $reservasmezcladas = $reservadototal;
    asort($reservasmezcladas);
} elseif ($reservadototalcamara) {
    $reservasmezcladas = $reservadototalcamara;
    asort($reservasmezcladas);
}
$array = array();
foreach ($reservasmezcladas as $mezcla) {
    $objeto = new stdClass();
    $objeto->idaula = $mezcla->getIdaula();
    $objeto->fecha = $mezcla->getFecha()->format("Y-m-d");
    $objeto->hora = $mezcla->getHora()->format("H:i:s");
    array_push($array, $objeto);
}
$arrayjson = json_encode($array);
echo $arrayjson;
