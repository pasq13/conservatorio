<?php 
/**
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
require_once __DIR__ . '/../src/fx/controlUsuarios.php';
/**
 * Aqui se cargan las peticiones que hay para admitir a los alumnos, se muestran y el administrador las acepta o las rechaza
 */
$peticiones = cargarPeticiones();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['envio'])) {
        $admin = $_SESSION['ADMINISTRADOR'];
        $valor = $_POST['boolean'];
        $nombre = $_POST['name'];
        $apellidos = $_POST['surname'];
        $instrumento = $_POST['instrument'];
        $correo = $_POST['mail'];
        $clave = $_POST['clave'];
        $usu = aceptarUsuario($admin, $valor, $nombre, $apellidos, $instrumento, $correo, $clave);
        if ($usu === false) {
            echo '<script type="text/javascript">
        alert("' . $errorInsert . '");
            window.location.href="zonaAdmin";
            </script>';
        }
        if ($usu == true) {
            if (intval($valor) == 1) {
                echo '<script type="text/javascript">
        window.location.href="zonaAdmin";
        </script>';
            }
            if (intval($valor) == 0) {

                echo '<script type="text/javascript">
            window.location.href="zonaAdmin";
            </script>';
            }
        }
    }
}