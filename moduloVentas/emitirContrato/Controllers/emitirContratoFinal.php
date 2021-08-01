<?php

function emitirContratoFinal($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma)
{
    include_once("CC_emitirContrato.php");
    $emitirContrato = new CC_emitirContrato;
    $emitirContrato->emitirContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma);
}


function validarDatos(
    $nombres,
    $apellidoP,
    $apellidoM,
    $celular,
    $dni,
    $correo,
    $departamento,
    $provincia,
    $distrito,
    $direccion,
    $referencia,
    $idProforma
) {
    if (isset($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma)) {
        emitirContratoFinal($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los campos requeridos", "../../../index.php");
    }
}


if (isset($_POST['emitirContrato'])) {
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
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
