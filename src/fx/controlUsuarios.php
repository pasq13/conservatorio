<?php

/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 * @version 1.0.0
 */

use Doctrine\ORM\Mapping\Entity;

require_once __DIR__ . "/../Entity/Alumnos.php";
require_once __DIR__ . "/../Entity/Historicopeticiones.php";
require_once __DIR__ . "/../Entity/Peticiones.php";
require_once __DIR__ . "/../Entity/Administrador.php";
require_once __DIR__ . "/../../bootstrap.php";

/**
 * compruebaAlumno function comprueba el password del alumno
 *
 * @param string $correo
 * @param string $clave
 * @return Alumno
 */
function compruebaAlumno($correo, $clave)
{
    $entity = getEntityManager();
    try {
        $alumno = $entity->getRepository("Alumnos")->findOneBy(array('correo' => $correo));
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$alumno) {
            return false;
        } else if (!password_verify($clave, $alumno->getPassword())) {
            return false;
        } else {
            return $alumno;
        }
    }
}
/**
 * compruebaAdministrador function comprueba el password del administrador
 *
 * @param string $correo
 * @param string $clave
 * @return Administrador
 */
function compruebaAdministrador($nombre, $clave)
{
    $entity = getEntityManager();
    try {
        $admin = $entity->getRepository("Administrador")->findOneBy(array('nombre' => $nombre));
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$admin) {
            return false;
        } else if (!password_verify($clave, $admin->getPassword())) {
            return false;
        } else {
            return $admin;
        }
    }
}
/**
 * login function comprueba que tipo de usuario a conectado y si es correcto loguea
 *
 * @param string $correo
 * @param string $clave
 * @return mixed
 */
function login($correo, $clave)
{
    $usu = compruebaAlumno($correo, $clave);
    if ($usu) {
        return $usu;
    } else {
        $adm = compruebaAdministrador($correo, $clave);
        if ($adm) {
            return $adm;
        } else {
            return false;
        }
    }
}
/**
 * registroUsuario function funcion para registrar el usuario y posteriormente añadirlo en la base de datos
 *
 * @param string $nombre
 * @param string $apellidos
 * @param string $instrumento
 * @param string $correo
 * @param string $password
 * @param string $password2
 * @return boolean
 */
function registroUsuario($nombre, $apellidos, $instrumento, $correo, $password, $password2)
{
    try {
        $entity = getEntityManager();
        $comprobacion = $entity->getRepository("Alumnos")->findOneBy(array('correo' => trim($correo)));
        if (!$comprobacion) {
            if ($password == $password2) {
                // var_dump($password);
                // var_dump($password2);
                $peticion = new Peticiones();
                $peticion->setNombre(trim($nombre));
                $peticion->setApellidos(trim($apellidos));
                $peticion->setInstrumento(trim($instrumento));
                $peticion->setCorreo(trim($correo));
                $peticion->setPassword(password_hash(trim($password2), PASSWORD_DEFAULT, ['cost' => 15]));
                $entity->persist($peticion);
                $entity->flush();
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("El usuario ya esta registrado");
            return false;
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    }
}
/**
 * cargarPeticiones function carga las peticiones de acceso en la pantalla de administracion
 *
 * @return Peticiones[]
 */
function cargarPeticiones()
{
    $entity = getEntityManager();
    try {

        $peticiones = $entity->getRepository("Peticiones")->findAll();
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } finally {
        if (!$peticiones) {
            return false;
        } else {
            return $peticiones;
        }
    }
}
/**
 * aceptarUsuario function transaccion para hacer un volcado de datos en las tablas alumnos e historicopeticiones y hacer un delete en la de peticiones
 *
 * @param string $admin
 * @param string $valor
 * @param string $nombre
 * @param string $apellidos
 * @param string $instrumento
 * @param string $correo
 * @param string $clave
 * @return boolean
 */
function aceptarUsuario($admin, $valor, $nombre, $apellidos, $instrumento, $correo, $clave)
{
    try {

        $entity = getEntityManager();

        $entity->getConnection()->beginTransaction();
        if (intval($valor) == 1) {
            $alumno = new Alumnos();
            $histAlumno = new Historicopeticiones();
            $alumno->setNombre(trim($nombre));
            $alumno->setApellidos(trim($apellidos));
            $alumno->setInstrumento(trim($instrumento));
            $alumno->setCorreo(trim($correo));
            $alumno->setPassword(trim($clave));
            $alumno->setNombreadmin(trim($admin));
            $histAlumno->setNombre(trim($nombre));
            $histAlumno->setApellidos(trim($apellidos));
            $histAlumno->setInstrumento(trim($instrumento));
            $histAlumno->setCorreo(trim($correo));
            $histAlumno->setPassword(trim($clave));
            $histAlumno->setNombreadmin(trim($admin));
            $histAlumno->setValidada(trim($valor));
            $entity->persist($alumno);
            $entity->persist($histAlumno);
            $solicitud = $entity->getRepository("Peticiones")->findOneBy(array('correo' => trim($correo)));
            $entity->remove($solicitud);
            $entity->flush();
            $entity->getConnection()->commit();
            return true;
        } else {
            $histAlumno = new Historicopeticiones();
            $histAlumno->setNombre(trim($nombre));
            $histAlumno->setApellidos(trim($apellidos));
            $histAlumno->setInstrumento(trim($instrumento));
            $histAlumno->setCorreo(trim($correo));
            $histAlumno->setPassword(trim($clave));
            $histAlumno->setNombreadmin(trim($admin));
            $histAlumno->setValidada(trim($valor));
            $solicitud = $entity->getRepository("Peticiones")->findOneBy(array('correo' => trim($correo)));
            $entity->persist($histAlumno);
            $entity->remove($solicitud);
            $entity->flush();
            $entity->getConnection()->commit();
            return true;
        }
    } catch (Exception $e) {
        $entity->rollBack();
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    }
}
