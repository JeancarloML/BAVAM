<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es-PE">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <?php
    ?>
    <style type="text/css">
        .banner,
        .form {
            height: 100vh;
        }

        .banner {
            background: url("./img/login.jpg");
            background-size: cover;
        }

        #loginForm {
            width: 320px;
            height: 420px;
        }
    </style>
    <div class="d-flex">
        <div class="banner col-md-6 col-lg-6 col-xl-4"></div>
        <div class="form row d-flex col-md-6 col-lg-6 col-xl-8  justify-content-center align-content-center">
            <form id="loginForm" class="row d-flex" action="./Controllers/CC_AutenticarUsuario.php" method="post">
                <h2 class="text-center">Iniciar Sesión</h2>
                <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" name="login" class="form-control" id="inputUsername">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <div class="form-group">
                    <input type="submit" name="btnAceptar" value="Ingresar" type="submit" class="btn btn-dark">
                </div>
            </form>
        </div>
    </div>
    <?php
    ?>
</body>

</html>