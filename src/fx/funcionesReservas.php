<?php

/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 * @version 1.0.0
 */
/**
 * solapamientoAulas function comprueba si la hora indicada esta 90 minutos antes de una reserva para poder realizarla
 *
 * @param DateTime $fechareserva
 * @param DateTime $fechabase
 * @return boolean
 */
function solapamientoAulas($fechareserva, $fechabase)
{
    $diferencia = date_diff($fechareserva, $fechabase)->h * 60 + date_diff($fechareserva, $fechabase)->i;
    if (intval($diferencia) == 0) {
        return true;
    } elseif (intval($diferencia) >= 0 && intval($diferencia) <= 89) {
        return true;
    } else {
        return  false;
    }
}
/**
 * solapamientoAlumno function en base a la cuenta de las aulas reservadas del alumno comprueba si la hora de alguna de sus reservas
 * coincide con la actual, llama a la funcion solapamientoAulas
 *
 * @param int $cuentacuantas
 * @param DateTime $fechacuenta
 * @param DateTime $fechareserva
 * @param DateTime $fec
 * @return boolean
 */
function solapamientoAlumno($cuentacuantas, $fechacuenta, $fechareserva, $fec)
{

    switch ($cuentacuantas) {
        case 1:
        case 2:
            $solapamientocamara = false;
            foreach ($fechacuenta as $h => $horares) {
                $fechabase = new DateTime($fec . " " . $horares['hora']->format("H:i:s"));
                $solapamientocamara = solapamientoAulas($fechareserva, $fechabase);
                if ($solapamientocamara) {
                    return true;
                    break;
                }
            }
            return false;
            break;
        default:
            return false;
            break;
    }
}
