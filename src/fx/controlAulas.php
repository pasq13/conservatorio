<?php
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 * @version 1.0.0
 */
require_once __DIR__ . "/../Entity/Reservas.php";
require_once __DIR__ . "/../Entity/Reservacamara.php";
require_once __DIR__ . "/../Entity/Aulas.php";
require_once __DIR__ . "/../Entity/Alumnos.php";
require_once __DIR__ . "/../../bootstrap.php";

/**
 * compruebaAulas function comprueba las aulas que estan llenas para el administrador
 *
 * @param int $idaula
 * @param DateTime $fecha
 * @return mixed
 */
function compruebaAulas($idaula, $fecha = null)
{
    if ($fecha == null) {
        $fechaAux = date('Y-m-d');
        $fecha = $fechaAux;
    }
    $fechaAux = DateTime::createFromFormat('Y-m-d', $fecha);
    $fecha = $fechaAux;
    $entity = getEntityManager();
    try {
        if (strtoupper($idaula) == "TODAS") {
            $aula = $entity->getRepository("Reservas")->findBy(array("fecha" => $fecha));
        } else {
            $aula = $entity->getRepository("Reservas")->findBy(array("fecha" => $fecha, "idaula" => $idaula));
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$aula) {
            return false;
        } else {
            return $aula;
        }
    }
}
/**
 * compruebaAulaCamara function comprueba el aforo de la camara
 *
 * @param DateTime $fecha
 * @return mixed
 */
function compruebaAulaCamara($fecha)
{
    if ($fecha == null) {
        $fechaAux = date('Y-m-d');
        $fecha = $fechaAux;
    }
    $fechaAux = DateTime::createFromFormat('Y-m-d', $fecha);
    $fecha = $fechaAux;
    $entity = getEntityManager();
    try {
        $aulaCamara = $entity->getRepository("Reservacamara")->findBy(array("fecha" => $fecha));
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$aulaCamara) {
            return false;
        } else {
            return $aulaCamara;
        }
    }
}
/**
 * compruebaAulaAlumno function comprueba el alumno por nombre
 *
 * @param string $correo
 * @return array reservas alumno
 */
function compruebaAulaAlumno($correo)
{
    $entity = getEntityManager();
    try {
        $alumno = $entity->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        $reservas = $entity->getRepository("Reservas")->findBy(array("idalumno" => $alumno->getId()));
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$reservas) {
            return false;
        } else {
            return [$reservas, $alumno];
        }
    }
}
/**
 * compruebaAulaAlumnoCamara function comprueba el alumno por nombre
 *
 * @param string $correo
 * @return array reservaCamara alumno
 */
function compruebaAulaAlumnoCamara($correo)
{
    $entity = getEntityManager();
    try {

        $alumno = $entity->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        if ($alumno) {
            $camara = $entity->getRepository("Reservacamara")->findBy(array("idalumno" => $alumno->getId()));
            $camara2 = $entity->getRepository("Reservacamara")->findBy(array("idalumno2" => $alumno->getId()));
            $camara3 = $entity->getRepository("Reservacamara")->findBy(array("idalumno3" => $alumno->getId()));
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$camara && !$camara2 && !$camara3) {
            return false;
        } else {
            if ($camara || $camara2 || $camara3) {
                $camaramerge = array_merge($camara, $camara2, $camara3);
                return [$camaramerge, $alumno];
            }
        }
    }
}
/**
 * cancelaReserva function
 *
 * @param int $idreserva
 * @return boolean
 */
function cancelaReserva($idreserva)
{

    $entity = getEntityManager();
    try {
        $reserva = $entity->getRepository("Reservas")->findOneBy(array("idreserva" => $idreserva));
        if ($reserva) {
            $entity->remove($reserva);
            $entity->flush();
        } else
            throw new Exception("SERVIDOR: Algo no ha ido bien");
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    }
}
/**
 * cancelaReservaCamara function cancela la reserva si el que solicita la cancelacion es quien la ha reservado
 *
 * @param int $idreserva
 * @param string $correo
 * @return boolean
 */
function cancelaReservaCamara($idreserva,$correo)
{

    $entity = getEntityManager();
    try {
        $alumno = $entity->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        var_dump($alumno);
        $reserva = $entity->getRepository("Reservacamara")->findOneBy(array("idreserva" => $idreserva));
        var_dump($reserva);
        if ($reserva->getIdalumno()==$alumno->getId()) {
            $entity->remove($reserva);
            $entity->flush();
            return true;
        } else{
            throw new Exception("SERVIDOR: Solo puede cancelar la reserva el usuario que la ha hecho");
            return false;
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
        return false;
    }
}
/**
 * obtenerAlumno function obtiene el alumno por su id
 *
 * @param int $idusu
 * @return Alumno
 */
function obtenerAlumno($idusu)
{
    $entity = getEntityManager();
    try {
        $alumno = $entity->getRepository("Alumnos")->findOneBy(array("id" => $idusu));
        if ($alumno) {
            return $alumno;
        } else
            throw new Exception("Algo no ha ido bien");
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    }
}
