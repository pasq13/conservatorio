<?php

require_once 'conexionBD.php';



function compruebaPassword($correo, $clave)
{
    try {
        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("select PASSWORD from ALUMNOS where CORREO = :correo");
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        $stmt->execute();
        $password = $stmt->fetch();
        if ($stmt->rowCount() == 1 && password_verify($clave, $password['PASSWORD'])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}


function compruebaPasswordAdmin($nombre, $clave)
{
    try {
        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("select PASSWORD from ADMINISTRADOR where NOMBRE = UPPER(:nombre)");
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        $stmt->execute();
        $password = $stmt->fetch();
        if ($stmt->rowCount() == 1 && password_verify($clave, $password['PASSWORD'])) {
            // echo "hola";
            return true;
        } else {
            // echo "adios";
            return false;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}

function comprobarUsuario($correo, $clave)
{
    try {
        $bd = ConexionBD::conectar();
        if (compruebaPassword($correo, $clave) == true) {
            $stmt = $bd->prepare("select NOMBRE, CORREO, INSTRUMENTO from ALUMNOS where CORREO = :correo"); //LOWERal correo?
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_BOTH);
            $stmt->execute();
            $resul = $stmt->rowCount();
            $arr = array();
            if ($resul === 1) {
                $arr = $stmt->fetch();
                return $arr;
            } else {
                return FALSE;
            }
        } else if (compruebaPasswordAdmin($correo, $clave) == true) {
            $stmtAd = $bd->prepare("select NOMBRE, ADMIN from ADMINISTRADOR where NOMBRE = UPPER(:nombre)");
            $stmtAd->bindParam(":nombre", $correo, PDO::PARAM_STR);
            $stmtAd->setFetchMode(PDO::FETCH_BOTH);
            $stmtAd->execute();
            $resulAd = $stmtAd->rowCount();
            if ($resulAd === 1) {
                // echo "holasdfa";
                $arr = $stmtAd->fetch();
                return $arr;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}

function registroUsuario($nombre, $apellidos, $instrumento, $correo, $clave)
{
    try {
        $bd = ConexionBD::conectar();
        $clave2 = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 15]);
        $stmt = $bd->prepare("insert into PETICIONES(NOMBRE, APELLIDOS, INSTRUMENTO, CORREO, PASSWORD) values (UPPER(:nombre), :apellidos, :instrumento, :correo, :clave)");
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":instrumento", $instrumento, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->bindParam(":clave", $clave2, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}

function cargarPeticiones()
{
    try {
        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("select * from PETICIONES");
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        $stmt->execute();

        $resul = $stmt->rowCount();
        if (!$stmt) {
            return false;
        }
        if ($resul === 0) {
            return false;
        } else {
            $arr = array();
            while ($fila = $stmt->fetch()) {
                array_push($arr, $fila);
            }
            return $arr;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}

function aceptarUsuario($admin, $valor, $nombre, $apellidos, $instrumento, $correo, $clave)
{
    try {
        $bd = ConexionBD::conectar();

        if (intval($valor) == 1) {
            $bd->beginTransaction();
            $stmt = $bd->prepare("insert into ALUMNOS(NOMBRE, APELLIDOS, INSTRUMENTO, CORREO, PASSWORD, NOMBREADMIN) values (:nombre, :apellidos, :instrumento, :correo, :clave, :admin)");
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":instrumento", $instrumento, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->bindParam(":clave", $clave, PDO::PARAM_STR);
            $stmt->bindParam(":admin", $admin, PDO::PARAM_STR);
            $bd->lastInsertId();
            $resultado = $stmt->execute();
            $stmtHist = $bd->prepare("insert into HISTORICOPETICIONES(NOMBRE, APELLIDOS, INSTRUMENTO, CORREO, PASSWORD, VALIDADA, NOMBREADMIN) values (:nombre, :apellidos, :instrumento, :correo, :clave, :valor, :admin)");
            $stmtHist->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmtHist->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
            $stmtHist->bindParam(":instrumento", $instrumento, PDO::PARAM_STR);
            $stmtHist->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmtHist->bindParam(":clave", $clave, PDO::PARAM_STR);
            $stmtHist->bindParam(":admin", $admin, PDO::PARAM_STR);
            $stmtHist->bindParam(":valor", $valor, PDO::PARAM_STR);
            $bd->lastInsertId();
            $resultadoHist = $stmtHist->execute();
            $stmtDel = $bd->prepare("delete from PETICIONES where CORREO = :correo");
            $stmtDel->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultadoDel = $stmtDel->execute();
            $bd->commit();
        } else {
            $bd->beginTransaction();
            $stmtHist = $bd->prepare("insert into HISTORICOPETICIONES(NOMBRE, APELLIDOS, INSTRUMENTO, CORREO, PASSWORD, VALIDADA, NOMBREADMIN) values (:nombre, :apellidos, :instrumento, :correo, :clave, :valor, :admin)");
            $stmtHist->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmtHist->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
            $stmtHist->bindParam(":instrumento", $instrumento, PDO::PARAM_STR);
            $stmtHist->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmtHist->bindParam(":clave", $clave, PDO::PARAM_STR);
            $stmtHist->bindParam(":admin", $admin, PDO::PARAM_STR);
            $stmtHist->bindParam(":valor", $valor, PDO::PARAM_STR);
            $bd->lastInsertId();
            $resultadoHist = $stmtHist->execute();
            $stmtDel = $bd->prepare("delete from PETICIONES where CORREO = :correo");
            $stmtDel->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultadoDel = $stmtDel->execute();
            $bd->commit();
        }
    } catch (PDOException $e) {
        echo $e;
        $bd->rollback();
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}

function compruebaAulaVacia($fecha = null)
{
    try {
        if ($fecha == null) {
            $fechaAux = date('Y-m-d');
            $fecha = $fechaAux;
        }
        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("Select AULAS.IDAULA,AULAS.PISO,AULAS.TIPO,PISOS.HORA 
        FROM AULAS INNER JOIN PISOS ON AULAS.PISO = PISOS.IDPISO 
        WHERE (AULAS.IDAULA,PISOS.HORA) not in 
        (SELECT RESERVAS.IDAULA,RESERVAS.HORA from RESERVAS where RESERVAS.FECHA= :fecha)");
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        $stmt->execute();

        $resul = $stmt->rowCount();
        if (!$stmt) {
            return false;
        }
        if ($resul === 0) {
            return false;
        } else {
            $arr = array();
            while ($fila = $stmt->fetch()) {
                $fila['OCUPADA'] = 'NO';
                array_push($arr, $fila);
            }
            return $arr;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}
function compruebaAulaLlena($fecha = null)
{
    try {
        if ($fecha == null) {
            $fechaAux = date('Y-m-d');
            $fecha = $fechaAux;
        }
        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("Select AULAS.IDAULA,AULAS.PISO,AULAS.TIPO,PISOS.HORA 
        FROM AULAS INNER JOIN PISOS ON AULAS.PISO = PISOS.IDPISO 
        WHERE (AULAS.IDAULA,PISOS.HORA) in 
        (SELECT RESERVAS.IDAULA,RESERVAS.HORA from RESERVAS where RESERVAS.FECHA= :fecha)");
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        $stmt->execute();
        $resul = $stmt->rowCount();
        if (!$stmt) {
            return false;
        }
        if ($resul === 0) {
            return false;
        } else {
            $arr = array();
            while ($fila = $stmt->fetch()) {
                $fila['OCUPADA'] = 'SI';
                array_push($arr, $fila);
            }
            return $arr;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}

function compruebaAulas($fecha = null)
{
    $arr = compruebaAulaLlena($fecha);
    $arr2 = compruebaAulaVacia($fecha);
    if ($arr != false && $arr2 != false) {
        $arrayFinal = array_merge($arr2, $arr);
        asort($arrayFinal);
        return $arrayFinal;
    }
    if ($arr == false) {
        return $arr2;
    }
    if ($arr2 == false) {
        return $arr;
    }
}
function compruebaAulaAlumno($alumno = null)
{
    try {
        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("Select ALUMNOS.NOMBRE,ALUMNOS.CORREO,ALUMNOS.INSTRUMENTO,RESERVAS.IDAULA,RESERVAS.HORA,RESERVAS.FECHA 
        FROM ALUMNOS INNER JOIN RESERVAS ON ALUMNOS.ID = RESERVAS.IDALUMNO WHERE (ALUMNOS.NOMBRE)=UPPER(:alumno)");
        $stmt->bindParam(":alumno", $alumno, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        $stmt->execute();
        $resul = $stmt->rowCount();
        if (!$stmt) {
            return false;
        }
        if ($resul == 0) {
            return false;
        } else {
            $arr = array();
            while ($fila = $stmt->fetch()) {
                array_push($arr, $fila);
            }
            return $arr;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}
function selectHoras()
{
    try {
        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("SELECT DISTINCT `HORA` FROM PISOS");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resul = $stmt->rowCount();
        if (!$stmt) {
            return false;
        }
        if ($resul == 0) {
            return false;
        } else {
            $arr = array();
            while ($fila = $stmt->fetch()) {
                array_push($arr, $fila);
            }
            sort($arr);
            return $arr;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}
function selectClases($instrumento)
{
    try {

        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare("SELECT IDAULA FROM AULAS WHERE TIPO= ':instrumento' or TIPO='CAMARA' OR TIPO ='GENERAL'");
        $stmt->bindParam(":instrumento", $instrumento, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resul = $stmt->rowCount();
        if (!$stmt) {
            return false;
        }
        if ($resul == 0) {
            return false;
        } else {
            $arr = array();
            while ($fila = $stmt->fetch()) {
                array_push($arr, $fila);
            }
            sort($arr);
            return $arr;
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}
function compruebaAulaVaciaAlumno($fecha, $hora, $numero)
{
    try {

        $bd = ConexionBD::conectar();
        $stmt = $bd->prepare('SELECT COUNT(*) as OCUPADA FROM RESERVAS WHERE IDAULA = :numero AND FECHA =:fecha AND HORA=:hora');
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":hora", $hora, PDO::PARAM_STR);
        $stmt->bindParam(":numero", $numero, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        $stmt->execute();

        $resul = $stmt->rowCount();
        if (!$stmt) {
            return false;
        }
        if ($resul === 0) {
            return false;
        } else {
            $fila = $stmt->fetch();
            if ($fila[0] == 1) {
                $fila="ocupado";
                return $fila;
            } else {
                $arr = array($numero, $fecha, $hora);
                return $arr;
            }
        }
    } catch (PDOException $e) {
        echo $e;
        return false;
    } finally {
        if (isset($dbh)) {
            $dbh = null;
        }
    }
}
