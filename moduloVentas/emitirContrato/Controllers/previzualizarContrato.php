<?php

function mostrarPrevizualizarContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $idDepartamento, $idProvincia, $idDistrito, $direccion, $referencia, $idReferencial)
{
    include_once("CC_emitirContrato.php");
    $emitirContrato = new CC_emitirContrato;
    $emitirContrato->mostrarPrevizualizarContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $idDepartamento, $idProvincia, $idDistrito, $direccion, $referencia, $idReferencial);
}

function validarDatos($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $idDepartamento, $idProvincia, $idDistrito, $direccion, $referencia, $idReferencial)
{
    if (isset(
        $nombres,
        $apellidoP,
        $apellidoM,
        $celular,
        $dni,
        $correo,
        $idDepartamento,
        $idProvincia,
        $idDistrito,
        $direccion,
        $referencia,
        $idReferencial
    )) {
        mostrarPrevizualizarContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $idDepartamento, $idProvincia, $idDistrito, $direccion, $referencia, $idReferencial);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Error al intentar continuar con la proforma", "../../../index.php");
    }
}

if (isset($_POST['previzualizarContrato'])) {
    validarDatos(
        $_POST['nombres'],
        $_POST['apellidoP'],
        $_POST['apellidoM'],
        $_POST['celular'],
        $_POST['dni'],
        $_POST['correo'],
        $_POST['departamento'],
        $_POST['provincia'],
        $_POST['distrito'],
        $_POST['direccion'],
        $_POST['referencia'],
        $_POST['idReferencial']
    );
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Error acceso no permitido", "../../../index.php");
}
