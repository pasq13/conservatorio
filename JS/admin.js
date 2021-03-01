/**
 * 
 * @author Pascual Fuertes <pascual.daw@gmail.com>
 */
/**
 * 
 * @param string cookie 
 */
function crearCookie(cookie) {
    let nombre = cookie.id;
    console.log(nombre);
    let tiempo = (86400 * 30);
    if (nombre.toString() == "castellano") {
        document.cookie = "idioma=valencia; max-age=0";
        document.cookie = "idioma=" + encodeURIComponent(nombre.toString()) + ";max-age=" + tiempo + "";
    } else {
        document.cookie = "idioma=castellano; max-age=0";
        document.cookie = "idioma=" + encodeURIComponent(nombre.toString()) + ";max-age=" + tiempo + "";
    }
}