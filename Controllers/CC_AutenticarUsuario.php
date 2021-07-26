<?php
include_once("../Shared/FormularioMensajeSistema.php");
include_once("../Models/CE_Usuario.php");
include_once("../Models/CE_DetalleUsuarioPrivilegios.php");
include_once("../Views/CI_menuprincipal.php");
include("../Models/CE_Mueble.php");
include("../Views/CI_emitirProforma.php");
session_start();
function validarCampos($login,$password)
{
		if(strlen($login)>4 and strlen($password)>4)
		{
			return(1);	
		}
		else
		{
			return(0);	
		}
}
$btnAceptar = isset($_POST['btnAceptar']);
if($btnAceptar) {
    $_SESSION['btnAceptar'] = $btnAceptar;
}
if ($_SESSION['btnAceptar']) {
    $login = trim(strtolower($_POST['login'])); 	
	$password = trim($_POST['password']);
    // $_SESSION['login'] = $login;
    // $_SESSION['password'] = $password;
	$resultado_validacion_campos = validarCampos($login,$password);
	if($resultado_validacion_campos == 0)
	{	
		$mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->FormularioMensajeSistemaShow(0, 'Error', "Ingrese datos validos.", "../index.php");
    }
	else
	{
        $usuario = new Usuario;
        $resultado = $usuario->login($login,$password);
        
		if($resultado == 0)
			{
                $mensaje = new FormularioMensajeSistema;
                $mensaje->FormularioMensajeSistema();
                $mensaje->FormularioMensajeSistemaShow(0, 'Error', "Usuario no encontrado <br> o está inactivo.", "../index.php");
			}
			
			/*if($objUsuario -> verificarUsuario($login,$password) == 0)
			{
				include_once("../shared/formMensajeSistema.php");	
				$objMensaje = new formMensajeSistema;
				$objMensaje  -> formMensajeSistemaShow("Usuario no encontrado <br> o está inactivo","<a href='../index.php'>Ir al inicio</a>");
			}*/
			
			else
			{
				// session_start();
				$objPrivilegio = new UsuarioPrivilegio;
				$listaPrivilegios = $objPrivilegio -> obtenerPrivilegiosUsuario($login);
                $_SESSION['login'] = $login;
                $_SESSION['privilegios'] = $listaPrivilegios;
				// include_once("formMenuPrincipal.php");
                // $mueble = new Mueble();
                // $muebles = $mueble->obtenerMuebles();
                // if (isset($muebles)) {
                //     $emitirProforma = new EmitirProforma();
                //     return $emitirProforma->emitirProformaShow();
                // }
				$objMenuPrincipal = new formMenuPrincipal;
				$objMenuPrincipal -> formMenuPrincipalShow();
			}
	}
}
if(isset($_POST['btnLogout'])) {
    session_start();
    session_destroy();
    header("Location: http://localhost/iberica/index.php");
}
