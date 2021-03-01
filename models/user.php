<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
date_default_timezone_set("Europe/Madrid");
require_once __DIR__ . '/../src/fx/gestionReservas.php';
require_once __DIR__ . '/../src/fx/funcionesReservas.php';

$consulta = "bien";
$success = "no";
$fechaActual =  new DateTime();
/**
 * comprobamos que el usuario ha mandado todos los datos necesarios
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['envio'])) {
        $type = $_POST['selTipo'];
        $fec = $_POST['selFecha'];
        $horale = $_POST['selHora'];
        $num = $_POST['selNum'];

        if (isset($num) && isset($fec) && isset($horale) && isset($type)) {
            $noventaminutos = new DateInterval("PT89M");
            $fechareserva = new DateTime($fec . " " . $horale);
            /**
             * Comprobamos que la hora de la reserva esta en un rango de 90 minutos
             *  antes de empezar la siguiente hora y en un rango de no mas de 7 dias 
             */
            if ($fechareserva <= $fechaActual->add($noventaminutos)) {
                $consulta = "anterior";
            } elseif ($fechareserva >= $fechaActual->add($noventaminutos) && $fechareserva <= $fechaActual->add(new DateInterval("P7D"))) {
                /**si es asi comprobamos si el aula existe */
                $exist = compruebaAulaExiste($fec, $horale, $num);
                if ($exist == true) {
                    /**comprobamos que el aula esta vacia */
                    $comprobacion = compruebaOcupacion($num, $horale, $fec);
                    if ($comprobacion == true) {
                        /**comprobamos que las reservas del alumno no excedan de 2 */
                        $cuentaReservas = contarReservasAlumno($_SESSION['CORREO'], $fec);
                        $cuentaReservasCamara = contarReservasCamaraAlumno($_SESSION['CORREO'], $fec);
                        $horareserva = comprobarHoraReserva($fec, $_SESSION['CORREO']);
                        $horareservacamara = comprobarHoraReservaCamara($fec, $_SESSION['CORREO']);
                        $sumaReservas = $cuentaReservas + $cuentaReservasCamara;
                        if ($sumaReservas < 2 && $sumaReservas > 0) {
                            /**comprobamos que no se solapa la reserva actual con ninguna de las que ya tiene */
                            $solapamientoindividual = solapamientoAlumno($cuentaReservas, $horareserva, $fechareserva, $fec);
                            $solapamientocamara = solapamientoAlumno($cuentaReservasCamara, $horareservacamara, $fechareserva, $fec);
                            if (!$solapamientoindividual && !$solapamientocamara) {
                                /**mostramos el aula seleccionada dependiendo del tipo de aula que sea*/
                                $consulta = $type;
                            } else {
                                $consulta = "solapamientoindi";
                            }
                        } elseif ($sumaReservas == 0) {
                            $consulta = $type;
                        } elseif ($sumaReservas >= 2) {
                            $consulta = "demasiadas";
                        }
                    } else {
                        $consulta = "ocupada";
                    }
                }else{
                    $consulta="construccion";
                }
            } else {
                $consulta = "lejos";
            }
        }
    }
    /**
     * para acabar de confirmar la reserva tenemos que dar al boton
     */
    if (isset($_POST['envioReserva'])) {
        $resAula = $_POST['resnum'];
        $resHora = $_POST['reshor'];
        $resFecha = $_POST['resfec'];
        $realizarReserva = realizarReserva($resAula, $resFecha, $resHora, $_SESSION['CORREO']);
        /**reserva realizada con exito */
        if ($realizarReserva) {
            $success = "ok";
            echo '<script type="text/javascript">
            setTimeout(function() {
                window.location.href = "zonaUsuario";
            }, 1000);
        </script>';
        /**no realizada */
        } else {
            $success = "mal";
            echo '<script type="text/javascript">
            setTimeout(function() {
                window.location.href = "zonaUsuario";
            }, 1000);
        </script>';
        }
    }
    /**si se ha seleccionado la camara sale otro formulario que hay que completar y hacer comprobaciones */
    if (isset($_POST['envioReservaCam'])) {
        $resAula = $_POST['resnumcam'];
        $resHora = $_POST['reshorcam'];
        $resFecha = $_POST['resfeccam'];
        $alu2 = $_POST['resal2'];
        $alu3 = $_POST['resal3'];
        /**comprobamos que los alumnos sean distintos */
        if ($alu2 != $alu3 && $alu2 != $_SESSION['CORREO'] && $_SESSION['CORREO'] != $alu3) {
            /**comprobamos que los alumnos estan en la base de datos */
            $comprobacionalumno2 = compruebaAlumnoCamara($alu2);
            $comprobacionalumno3 = compruebaAlumnoCamara($alu3);
            if ($comprobacionalumno2 && $comprobacionalumno3) {
                /**contamos las reservas de los alumnos */
                $cuentaReservas2 = contarReservasAlumno($alu2, $resFecha);
                $cuentaReservasCamara2 = contarReservasCamaraAlumno($alu2, $resFecha);
                $cuentaReservas3 = contarReservasAlumno($alu3, $resFecha);
                $cuentaReservasCamara3 = contarReservasCamaraAlumno($alu3, $resFecha);
                $sumaReservas2 = $cuentaReservas2 + $cuentaReservasCamara2;
                $sumaReservas3 = $cuentaReservas3 + $cuentaReservasCamara3;
                if (($sumaReservas2 > 0 && $sumaReservas2 < 2) && ($sumaReservas3 > 0 && $sumaReservas3 < 2)) {
                    /**comprobamos si hay solapamiento */
                    $fechareserva = new DateTime($fec . " " . $resHora);
                    $horareserva2 = comprobarHoraReserva($resFecha, $alu2);
                    $horareservacamara2 = comprobarHoraReservaCamara($resFecha, $alu2);
                    $horareserva3 = comprobarHoraReserva($resFecha, $alu3);
                    $horareservacamara3 = comprobarHoraReservaCamara($resFecha, $alu3);
                    $alu2res = solapamientoAlumno($cuentaReservas2, $horareserva2, $fechareserva, $resFecha);
                    $alu2rescam = solapamientoAlumno($cuentaReservascamara2, $horareservacamara2, $fechareserva, $resFecha);
                    $alu3res = solapamientoAlumno($cuentaReservas3, $horareserva3, $fechareserva, $resFecha);
                    $alu3rescam = solapamientoAlumno($cuentaReservasCamara3, $horareservacamara3, $fechareserva, $resFecha);
                    if (!$alu2res && !$alu2rescam && !$alu3res && !$alu3rescam) {
                        /**realizamos la reserva de camara */
                        $realizarReservaCamara = realizarReservaCamara($resAula, $resFecha, $resHora, $_SESSION['CORREO'], $alu2, $alu3);
                        if ($realizarReservaCamara) {
                            $success = "ok";
                            echo '<script type="text/javascript">
                        setTimeout(function() {
                            window.location.href = "zonaUsuario";
                        }, 1000);
                    </script>';
                        } else {
                            $success = "malcamara";
                            echo '<script type="text/javascript">
                        setTimeout(function() {
                            window.location.href = "zonaUsuario";
                        }, 1000);
                    </script>';
                        }
                    } else {
                        $success = "solapamiento";
                    }
                } elseif ($sumaReservas2 == 0 && $sumaReservas3 == 0) {
                    /**realizamos la reserva de camara */
                    $realizarReservaCamara = realizarReservaCamara($resAula, $resFecha, $resHora, $_SESSION['CORREO'], $alu2, $alu3);
                    if ($realizarReservaCamara) {
                        $success = "ok";
                        echo '<script type="text/javascript">
                    setTimeout(function() {
                        window.location.href = "zonaUsuario";
                    }, 1000);
                </script>';
                    } else {
                        $success = "malcamara";
                        echo '<script type="text/javascript">
                    setTimeout(function() {
                        window.location.href = "zonaUsuario";
                    }, 1000);
                </script>';
                    }
                }else{
                    if($sumaReservas2>2||$sumaReservas3>2){
                    $success="compimal";
                    }else{
                        $success="solapamiento";
                    }
                }
            } else {
                $success = "alumnosmal";
            }
            /**el alumno es el usuario */
        } elseif ($alu2 == $_SESSION["CORREO"] || $alu3 == $_SESSION['CORREO']) {
            $success = "alumnosusuario";
            /**los alumnos estan repetidos */
        } elseif ($alu3 == $alu2) {
            $success = "alumnosiguales";
        }
    }
}

$hours = selectHoras();
asort($hours);
/**dependiendo del instrumento mostramos las clases que hay disponibles */
if (strtoupper($_SESSION['INSTRUMENTO']) != 'ARPA' && strtoupper($_SESSION['INSTRUMENTO']) != 'PERCUSION' && strtoupper($_SESSION['INSTRUMENTO']) != 'JAZZ' && strtoupper($_SESSION['INSTRUMENTO']) != 'CANTO') {
    $classes = array_merge(selectClases('GENERAL'), selectClases('CAMARA'));
} else {
    $classes = array_merge(selectClases('GENERAL'), selectClases(strtoupper($_SESSION['INSTRUMENTO'])), selectClases('CAMARA'));
}
asort($classes);
