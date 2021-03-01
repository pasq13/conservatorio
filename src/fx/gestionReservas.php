<?php

/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 * @version 1.0.0
 */

require_once __DIR__ . "/../Entity/Aulas.php";
require_once __DIR__ . "/../Entity/Pisos.php";
require_once __DIR__ . "/../Entity/Reservas.php";
require_once __DIR__ . "/../Entity/Reservacamara.php";
require_once __DIR__ . "/../Entity/Alumnos.php";
require_once __DIR__ . "/../../bootstrap.php";

/**
 * selectClases function Sirve para cargar los numeros de las aulas correspondientes al instrumento del alumno
 *
 * @param string $instrumento
 * @return mixed   
 */
function selectClases($instrumento)
{
    try {
        $entityManager = getEntityManager();
        $aulas = $entityManager->getRepository("Aulas")->findBy(array("tipo" => strtoupper($instrumento)));
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$aulas) {
            return false;
        } else {
            return $aulas;
        }
    }
}

/**
 * selectHoras function que sirve para cargar las horas de las aulas
 *
 * @return mixed 
 */
function selectHoras()
{
    try {
        $entityManager = getEntityManager();
        $query = $entityManager->createQuery("SELECT DISTINCT p.hora, p.idpiso FROM Pisos p ");

        $horas = $query->getResult();
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$horas) {
            return false;
        } else {
            return $horas;
        }
    }
}
/**
 * selectPartialReservas function para ver las reservas de las aulas
 * @return mixed
 */
function selectPartialReservas()
{
    try {
        $dia1 = new DateTime();
        $dia2 = new DateTime();
        $diafinal = $dia2->add(new DateInterval("P7D"));
        $entityManager = getEntityManager();
        $query = $entityManager->createQuery("SELECT partial r.{idreserva, hora, idaula, fecha} FROM Reservas r where r.fecha between :dia and :diafinal");
        $query->setParameters(array(":dia" => $dia1, ":diafinal" => $diafinal));
        $dias = $query->getResult();
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$dias) {
            return false;
        } else {
            return $dias;
        }
    }
}
/**
 * selectPartialReservasCamara function para ver las reservas de la camara
 * @return mixed
 */
function selectPartialReservasCamara()
{
    try {
        $dia1 = new DateTime();
        $dia2 = new DateTime();
        $diafinal = $dia2->add(new DateInterval("P7D"));
        $entityManager = getEntityManager();
        $query = $entityManager->createQuery("SELECT partial r.{idreserva, hora, idaula, fecha} FROM Reservacamara r where r.fecha between :dia and :diafinal");
        $query->setParameters(array(":dia" => $dia1, ":diafinal" => $diafinal));
        $dias = $query->getResult();
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$dias) {
            return false;
        } else {
            return $dias;
        }
    }
}
/**
 * compruebaOcupacion function comprueba si el aula seleccionada esta ocupada
 *
 * @param int $num
 * @param DateTime $hora
 * @param DateTime $fec
 * @return void
 */
function compruebaOcupacion($num, $hora, $fec)
{
    try {
        $entityManager = getEntityManager();
        $query = $entityManager->createQuery("SELECT COUNT(r.idreserva) FROM Reservas r WHERE r.idaula = :aula AND r.fecha =:fecha AND r.hora=:hora");
        $query->setParameters(array(":hora" => $hora, ":aula" => $num, ":fecha" => $fec));
        $conteo = $query->getSingleScalarResult();
        if ($conteo == 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
        return false;
    }
}

/**
 * compruebaAulaExiste function comprueba en base a la seleccion del usuario si ese aula existe
 *
 * @param DateTime $hora
 * @param int $num
 * @return boolean
 */
function compruebaAulaExiste($hora, $num)
{
    try {
        $entityManager = getEntityManager();
        $query = $entityManager->createQuery("SELECT p.hora, a.idaula from Pisos p, Aulas a where p.hora=:hora and a.idaula=:aula and p.idpiso=a.piso");
        $query->setParameters(array(":hora" => $hora, ":aula" => $num));
        $query->getResult();
        return true;
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
        return false;
    }
}
/**
 * contarReservasAlumno function cuenta la cantidad de reservas de aula para ese dia que tiene el alumno
 *
 * @param string $correo
 * @param DateTime $fec
 * @return int
 */
function contarReservasAlumno($correo, $fec)
{
    try {
        $entityManager = getEntityManager();
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        $query = $entityManager->createQuery("SELECT COUNT(r.idreserva) FROM Reservas r WHERE r.idalumno=:idalumno  AND r.fecha=:fecha");
        $query->setParameters(array(":idalumno" => $alumno->getId(), ":fecha" => $fec));
        $conteoAulas = $query->getSingleScalarResult();
        return $conteoAulas;
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    }
}
/**
 * contarReservasCamaraAlumno function cuenta la cantidad de reservas de la camara para ese dia que tiene el alumno
 *
 * @param string $correo
 * @param DateTime $fec
 * @return int
 */
function contarReservasCamaraAlumno($correo, $fec)
{
    try {
        $entityManager = getEntityManager();
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        $query = $entityManager->createQuery("SELECT COUNT(rc.idreserva) FROM Reservacamara rc WHERE  (rc.idalumno=:idalumno OR rc.idalumno2=:idalumno OR rc.idalumno3=:idalumno)  AND rc.fecha=:fecha");
        $query->setParameters(array(":idalumno" => $alumno->getId(), ":fecha" => $fec));
        $conteoAulas = $query->getSingleScalarResult();
        return $conteoAulas;
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    }
}

/**
 * realizarReserva function realiza la reserva del aula añadiendola en la base de datos
 *
 * @param int $resAula
 * @param DateTime $resFecha
 * @param DateTime $resHora
 * @param string $correo
 * @return void
 */
function realizarReserva($resAula, $resFecha, $resHora, $correo)
{
    try {
        $entityManager = getEntityManager();
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        $reserva = new Reservas();
        $reserva->setIdalumno($alumno->getId());
        $reserva->setIdaula(intval($resAula));
        $reserva->setHora(new DateTime($resHora));
        $reserva->setFecha(new DateTime($resFecha));
        $entityManager->persist($reserva);
        $entityManager->flush();
        return true;
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
        return false;
    }
}
/**
 * realizarReservaCamara function realiza la reserva de la camara añadiendola en la base de datos
 *
 * @param int $resAula
 * @param DateTime $resFecha
 * @param DateTime $resHora
 * @param string $correo
 * @param string $correo2
 * @param string $correo3
 * @return void
 */
function realizarReservaCamara($resAula, $resFecha, $resHora, $correo, $correo2, $correo3)
{
    try {
        $entityManager = getEntityManager();
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        $alumno2 = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo2));
        $alumno3 = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo3));
        if (!$alumno2) {
            throw new Exception("SERVIDOR: El segundo usuario no se encuentra el la base de datos");
            return false;
        } elseif (!$alumno3) {
            throw new Exception("SERVIDOR: El tercer usuario no se encuentra el la base de datos");
            return false;
        } else {
            $reserva = new Reservacamara();
            $reserva->setIdalumno($alumno->getId());
            $reserva->setIdalumno2($alumno2->getId());
            $reserva->setIdalumno3($alumno3->getId());
            $reserva->setIdaula(intval($resAula));
            $reserva->setHora(new DateTime($resHora));
            $reserva->setFecha(new DateTime($resFecha));
            $entityManager->persist($reserva);
            $entityManager->flush();
            return true;
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
        return false;
    }
}
/**
 * compruebaAlumnoCamara function para asegurar que los alumnos introducidos son correctos
 *
 * @param string $correo
 * @return void
 */
function compruebaAlumnoCamara($correo)
{
    $entity = getEntityManager();
    try {
        $alumno = $entity->getRepository("Alumnos")->findOneBy(array('correo' => $correo));
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$alumno) {
            return false;
        } else {
            return $alumno;
        }
    }
}
/**
 * comprobarHoraReserva function comprueba la hora de la reserva
 *
 * @param DateTime $resFecha
 * @param string $correo
 * @return void
 */
function comprobarHoraReserva($resFecha, $correo)
{
    try {
        $entityManager = getEntityManager();
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        $query = $entityManager->createQuery("SELECT r.hora FROM Reservas r WHERE  r.idalumno=:idalumno AND r.fecha=:fecha");
        $query->setParameters(array(":idalumno" => $alumno->getId(), ":fecha" => $resFecha));
        $hora = $query->getResult();
        return $hora;
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
        return false;
    }
}
/**
 * comprobarHoraReservaCamara function comprueba la hora de la reserva de la camara
 *
 * @param DateTime $resFecha
 * @param string $correo
 * @return void
 */
function comprobarHoraReservaCamara($resFecha, $correo)
{
    try {
        $entityManager = getEntityManager();
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array("correo" => $correo));
        $query = $entityManager->createQuery("SELECT rc.hora FROM Reservacamara rc WHERE  (rc.idalumno=:idalumno OR rc.idalumno2=:idalumno OR rc.idalumno3=:idalumno)  AND rc.fecha=:fecha");
        $query->setParameters(array(":idalumno" => $alumno->getId(), ":fecha" => $resFecha));
        $hora = $query->getResult();
        return $hora;
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
        return false;
    }
}
