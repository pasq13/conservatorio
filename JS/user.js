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
 * comprobamos la contraseña para poder cambiarla en el formulario de los ajustes
 * @return boolean
 */
function comprobarPass() {
    let pass1 = document.getElementById("password").value;
    let pass2 = document.getElementById("password2").value;
    let error = document.getElementById("error");

    if (pass1 != "" && pass2 != "") {
        if (pass1 != pass2) {
            error.classList.remove("oculto");
            error.classList.add("mostrar");
            return false;
        } else {
            error.classList.remove("mostrar");
            error.classList.add("oculto");
            document.getElementById("changepass").submit();
            return true;
        }

    } else {
        return false;
    }
}
/**
 * comprobamos si los emails coinciden para hacer el cambio en los ajustes
 * @return boolean
 */
function comprobarEmail() {
    let pass1 = document.getElementById("email").value;
    let pass2 = document.getElementById("email2").value;
    let error2 = document.getElementById("error2");
    if (pass1 != "" && pass2 != "") {
        if (pass1 != pass2) {
            error2.classList.remove("oculto");
            error2.classList.add("mostrar");
            return false;
        } else {
            error2.classList.remove("mostrar");
            error2.classList.add("oculto");
            document.getElementById("changemail").submit();
            return true;
        }

    } else {
        return false;
    }
}
/**
 * reiniciamos los selects y mostramos los valores que habiamos ocultado
 */
function resetSelects() {
    let tipo = document.getElementById("selTipo");
    let num = document.getElementById("selNum");
    let options = document.querySelectorAll("option");
    options.forEach(option => {
        option.style.display = "block";
    })
    error.classList.remove("mostrar");
    error.classList.add("oculto")
}
/**
 * modificamos el valor de los selects dependiendo de lo qeu se ha se ha seleccionado
 * @param string opcion 
 */
function selectAulas(opcion) {
    let tipo = document.getElementById("selTipo");
    let num = document.getElementById("selNum");
    let opciones = document.querySelectorAll("option");
    if (isNaN(opcion.options[opcion.selectedIndex].value)) {
        for (let i = 0; i < num.options.length; i++) {
            switch (opcion.options[opcion.selectedIndex].value) {
                case "CAMARA":
                    if (num[i].value == 13) {
                        num[i].style.display = "block";
                    } else {
                        num[i].style.display = "none";
                    }
                    break;
                case "ARPA":
                    if (num[i].value == 8) {
                        num[i].style.display = "block";
                    } else {
                        num[i].style.display = "none";
                    }
                    break;
                case "PERCUSION":
                    if (num[i].value == 10 || num[i].value == 11) {
                        num[i].style.display = "block";
                    } else {
                        num[i].style.display = "none";
                    }
                    break;
                case "JAZZ":
                    if (num[i].value == 12) {
                        num[i].style.display = "block";
                    } else {
                        num[i].style.display = "none";
                    }
                    break
                case "CANTO":
                    if (num[i].value == 9) {
                        num[i].style.display = "block";
                    } else {
                        num[i].style.display = "none";
                    }
                    break;
                default:
                    if (num[i].value == 9 || num[i].value == 12 || num[i].value == 10 || num[i].value == 8 || num[i].value == 13 || num[i].value == 11) {
                        num[i].style.display = "none";
                    } else {
                        num[i].style.display = "block";
                    }
                    break;

            }
        }
    } else {
        for (let i = 0; i < tipo.options.length; i++) {
            switch (parseInt(opcion.options[opcion.selectedIndex].value)) {
                case 8:
                    if (tipo[i].value == "ARPA") {
                        tipo[i].style.display = "block";
                    } else {
                        tipo[i].style.display = "none";
                    }
                    break;
                case 9:
                    if (tipo[i].value == "CANTO") {
                        tipo[i].style.display = "block";
                    } else {
                        tipo[i].style.display = "none";
                    }
                    break;
                case 10:
                case 11:
                    if (tipo[i].value == "PERCUSION") {
                        tipo[i].style.display = "block";
                    } else {
                        tipo[i].style.display = "none";
                    }
                    break;
                case 12:
                    if (tipo[i].value == "JAZZ") {
                        tipo[i].style.display = "block";
                    } else {
                        tipo[i].style.display = "none";
                    }
                    break;
                case 13:
                    if (tipo[i].value == "CAMARA") {
                        tipo[i].style.display = "block";
                    } else {
                        tipo[i].style.display = "none";
                    }
                    break;
                default:
                    if (tipo[i].value == "CAMARA" || tipo[i].value == "JAZZ" || tipo[i].value == "PERCUSION" || tipo[i].value == "CANTO" || tipo[i].value == "ARPA") {
                        tipo[i].style.display = "none";
                    } else {
                        tipo[i].style.display = "block";
                    }
                    break;
            }
        }
    }
}
/**
 * Funcion para cargar los archivos php
 * @param {String} url ruta del archivo.php
 * @param {boolean} bool establece si la consulta es asincrona o no
 * @param {String} envio consulta opcional
 * @returns {JSON} respuesta del servidor
 */
function cargarDocumento(url, bool, envio = null) {
    var xhttp = new XMLHttpRequest();
    var devolucion;
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            devolucion = xhttp.responseText;
        }
    };
    xhttp.open("POST", url, bool);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (envio != null) {
        xhttp.send(envio);
    } else {
        xhttp.send();
    }
    return devolucion;
}
/**
 * funcion para ocultar las horas del aula si esta reservada
 */
function compruebaReservas() {
    let url = "../httdocs/index.php/selects";
    let documentocargado = cargarDocumento(url, false);
    let docuparse = JSON.parse(documentocargado);
    console.log(docuparse);
    let reservas = document.getElementById("tablareservas");
    let fecha = document.getElementById("selFecha");
    let tipo = document.getElementById("selTipo");
    let hora = document.getElementById("selHora");
    let aula = document.getElementById("selNum");
    console.log(fecha.value);
    console.log(hora.value);
    docuparse.forEach(element => {
        if(element.fecha==fecha.value&&element.idaula==aula.value){
            for(let i=0;i<hora.options.length;i++){
                if(hora.options[i].value==element.hora){
                    hora.options[i].style.display="none";
                }
            }
        }
    });
}
/**
 * cambiamos los selects dependiendo del aula y el horario que tenga
 * @param string opcion 
 */
function cambiarSelects(opcion) {
    let piso = opcion.options[opcion.selectedIndex].classList.value;
    let options = document.querySelectorAll("option");
    if (piso == "piso1 piso2 piso3") {
        options.forEach(option => {
            option.style.display = "block";
        })
    } else {
        options.forEach(option => {
            if (option.classList.contains(piso)) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
            }
        });
    }
}
/**
 * validamos el formulario para su envio
 */
function validar() {
    let fecha = document.getElementById("selFecha");
    let tipo = document.getElementById("selTipo");
    let hora = document.getElementById("selHora");
    let aula = document.getElementById("selNum");
    let error = document.getElementById("error");

    if (fecha.value == null || tipo.value == null || hora.value == null || aula.value == null || fecha.value == "" || tipo.value == "" || hora.value == "" || aula.value == "") {
        return false;
    } else {
        if (hora.options[hora.selectedIndex].classList.contains(aula.options[aula.selectedIndex].classList.value)) {
            error.classList.remove("mostrar");
            error.classList.add("oculto");
            return true;
        } else {
            error.classList.remove("oculto");
            error.classList.add("mostrar");
            return false;
        }
    }
}