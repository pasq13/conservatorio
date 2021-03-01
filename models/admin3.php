<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/../src/fx/controlAulas.php';
/**
 * se comprueban las reservas de los alumnos por el correo
 */
$fechaActual =  new DateTime();
$camaraRes = false;
$aulas = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alu = $_POST['mail'];
    if (isset($alu)) {
        $reservas = compruebaAulaAlumno($alu);
        if ($reservas) {
            $alumno = array_pop($reservas);
            $aulas = array_pop($reservas);
        }
        $reservasCamara = compruebaAulaAlumnoCamara($alu);
        if ($reservasCamara) {
            $alumnoCamara = array_pop($reservasCamara);
            $camaraRes = array_pop($reservasCamara);
        }
    }
}
