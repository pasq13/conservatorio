<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 * @version 1.0.0
 */

/**
 * comprobarSesion function si no esta creada se redirige al login
 *
 * @return void
 */
function comprobarSesion(){
    session_start();
    if(!isset($_SESSION['CREADA'])){
        header('Location: login');
    }
}
