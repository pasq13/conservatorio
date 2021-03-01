<?php
date_default_timezone_set("Europe/Madrid");
if (!isset($_COOKIE['idioma'])&& (basename($_SERVER['REQUEST_URI'])=="httdocs"||basename($_SERVER['REQUEST_URI'])=="index.php")){
    require __DIR__ . '/../lang/castellano.php';
    echo '<script type="text/javascript">
        alert("' . $msgcookie . '");
        crearCookie("castellano");
        </script>';
}
if(!isset($_COOKIE['idioma'])){
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
    <!-- <script defer src="../src/JS/inicio.js"></script> -->
    <style>
        .oculto {
            display: none;
        }

        .mostrar {
            display: block;
            color: red;
        }
    </style>
    <script>
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
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark  m-3">
        <i class="fas fa-music mr-2"></i><a class="navbar-brand" href="index.php"><?php echo $title; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContenido">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="login"><?php echo $sign; ?> <span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="register"><?php echo $register; ?></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="logout"><?php echo $close; ?></a>
                </li> -->
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarContenido">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="javascript:location.reload()"><img src='../images/spain.png' class="ml-auto cookie mr-3" id="castellano" onclick="crearCookie(this)" style="height: 40px;" style="width: 40px;" /></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:location.reload()"><img src='../images/valencia.png' class="ml-auto cookie" id="valencia" onclick="crearCookie(this)" style="height: 40px;" style="width: 40px;" /></a>
                </li>
            </ul>
        </div>
    </nav>
</body>