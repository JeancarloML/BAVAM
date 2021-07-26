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
// if(isset($_SESSION['login'])){
	// header("Location: http://localhost/iberica-master/controllers/CC_AutenticarUsuario.php");
// }else {
?>
    <style type="text/css">
    .banner, .form {
    height:100vh;
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
            <!-- <form id="loginForm" class="row d-flex" action="moduloSeguridad/getUsuario.php" method="post"> -->
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
                <!-- <table width="344" border="0" align="center">
              <tr>
                  <td colspan="3" align="center">
                      <h2>Inica Sesión</h2>
                  </td>
              </tr>
              <tr>
                  <td width="86" height="38">Username:</td>
                  <td width="122"><label for="login"></label>
                      <input name="login" type="text" id="login" size="20" />
                  </td>
              </tr>
              <tr>
                  <td height="39">Password:</td>
                  <td><input name="password" type="password" id="password" size="20" /></td>
              </tr>
              <tr>
                  <td colspan="2" align="right"><input name="btnAceptar" type="submit" id="btnAceptar" value="Ingresar" />
                  </td>
              </tr>
          </table> -->
            </form>
        </div>
    </div>

    <!-- <form method="POST" action="./Controllers/CC_emitirProforma.php">
		<input type="submit" value="Emitir proforma" name="btnEmitirProforma" id="btnEmitirProforma">
	</form> -->
	<?php
// }
?>
</body>

</html>