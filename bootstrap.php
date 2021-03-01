<?php
// Include Composer Autoload (relative to project root).

require_once __DIR__.'/vendor/autoload.php';
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function getEntityManager()
{
    $drive=$_ENV['DB_DRIVER'];
    $user=$_ENV['DB_USER'];
    $database=$_ENV['DB_NAME'];
    $password=$_ENV['DB_PASSWD'];
    $host=$_ENV['DB_HOST'];
    $ruta=$_ENV['ENTITY_DIR'];

// ruta de la entidades
    $paths = array($ruta);
// por el tema de los mensajes de error
    $isDevMode = true;
// configuración de la BD: es por esto que hay que ocultarlo
    $dbParams = array('driver' => $drive, 'user' => $user, 'password' => $password, 'dbname' => $database, 'host' => $host);
    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
    $entityManager = EntityManager::create($dbParams, $config);
    return $entityManager;
}
