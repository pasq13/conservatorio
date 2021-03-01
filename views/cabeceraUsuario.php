<?php
require_once __DIR__ . '/../src/fx/sesiones.php';
comprobarSesion();
date_default_timezone_set("Europe/Madrid");
if (!isset($_COOKIE['idioma'])) {
    require __DIR__ . '/../lang/castellano.php';
}
if ($_COOKIE['idioma'] == 'castellano') {
    require __DIR__ . '/../lang/castellano.php';
}
if ($_COOKIE['idioma'] == 'valencia') {
    require __DIR__ . '/../lang/valencia.php';
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://kit.fontawesome.com/e3ff4d98f0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- <script defer src="../JS/user.js"></script> -->
    <style>
        .oculto {
            display: none;
        }

        .mostrar {
            display: block;
            color: red;
        }

        .muestra {
            display: block;
        }
    </style>
    <script>
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

        function compruebaReservas() {
            let url = "../httdocs/index.php/selects";
            let documentocargado = cargarDocumento(url, false);
            console.log(documentocargado);
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
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark  m-3">
        <i class="fas fa-music mr-2"></i><a class="navbar-brand" href="#"><?php echo $title; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContenido">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="principalUsuario"><?php echo $start; ?> <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="zonaUsuario"><?php echo $reservar; ?> <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="zonaUsuario2"><?php echo $consultaReserva; ?> <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="zonaUsuario3"><?php echo $count; ?> <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout"><?php echo $close; ?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" style="text-transform:capitalize;"><?php echo $_SESSION['USUARIO']; ?></a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarContenido">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="javascript:location.reload()"><img src="../images/spain.png" class="ml-auto cookie mr-3" id="castellano" onclick="crearCookie(this)" style="height: 40px;" style="width: 40px;" /></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:location.reload()"><img src="../images/valencia.png" class="ml-auto cookie" id="valencia" onclick="crearCookie(this)" style="height: 40px;" style="width: 40px;" /></a>
                </li>
            </ul>
        </div>
    </nav>
</body>