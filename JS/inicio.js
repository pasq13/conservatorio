/**
 * 
 * @author Pascual Fuertes <pascual.daw@gmail.com> 
 */
/**
 * creamos la cookie del idioma
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

/**
 * comprobamos que las dos contraseñas para el registro son la misma
 * @return boolean
 */
function comprobarPass() {
    let pass1 = document.getElementById("passwordreg").value;
    let pass2 = document.getElementById("password2reg").value;
    let error = document.getElementById("errorreg");

    if (pass1 != "" && pass2 != "") {
        if (pass1 != pass2) {
            error.classList.remove("oculto");
            error.classList.add("mostrar");
            return false;
        } else {
            error.classList.remove("mostrar");
            error.classList.add("oculto");
            document.getElementById("register").submit();
            return true;
        }

    } else {
        return false;
    }
}