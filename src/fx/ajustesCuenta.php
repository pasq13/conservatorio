<?php
require_once __DIR__ . "/../Entity/Alumnos.php";
require_once __DIR__ . "/../../bootstrap.php";
/**
 * cambiarClave function Sirve para cambiar la contraseña del usuario
 *
 * @param string $contra1
 * @param string $contra2
 * @param string $contraold
 * @param string $correo
 * @return boolean
 */
function cambiarClave($contra1, $contra2, $contraold, $correo)
{
    $entityManager = getEntityManager();
    try {
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array('correo' => $correo));
        if (password_verify($contraold, $alumno->getPassword())) {
            if ($contra1 != $contra2) {
                throw new Exception("Las contraseñas no coinciden");
                return false;
            } elseif ($contra1 == $contra2 && password_verify($contra1, $alumno->getPassword())) {
                throw new Exception("La contraseña es la misma que la anterior");
                return false;
            } elseif($contra1==$contra2&&!password_verify($contra1, $alumno->getPassword())) {
                $hash = password_hash($contra1, PASSWORD_DEFAULT, ['cost' => 15]);
                $alumno->setPassword($hash);
                $entityManager->persist($alumno);
                $entityManager->flush();
                return true;
            }
        }else{
            throw new Exception("La contraseña a cambiar no coincide con la almacenada");
            return false;
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    } 
}
/**
 * cambiarCorreo function sirve para cambiar el correo
 *
 * @param string $correo
 * @param string $newcorreo
 * @param string $newcorreo2
 * @return void
 */
function cambiarCorreo($correo, $newcorreo, $newcorreo2)
{
    $entityManager = getEntityManager();
    try {
        $alumno = $entityManager->getRepository("Alumnos")->findOneBy(array('correo' => $correo));
        if ($newcorreo != $newcorreo2) {
            return false;
        } elseif ($newcorreo == $newcorreo2 && $newcorreo == $correo) {
            throw new Exception("El correo es el mismo que el anterior");
            return false;
        } else {

            $alumno->setCorreo($newcorreo);
            $entityManager->persist($alumno);
            $entityManager->flush();
            return true;
        }
    } catch (Exception $e) {
        echo "<h3 class='text-center'>" . $e->getMessage() . "</h3><br>";
    }
}
