<?php


function mostrarContrato($idContrato)
{
    include_once("CC_emitirOrdenVenta.php");
    $emitirOrdenVenta = new CC_emitirOrdenVenta;
    $emitirOrdenVenta->obtenerContrato($idContrato);
}


function validarDatos($idContrato)
{
    if (isset($idContrato)) {
        mostrarContrato($idContrato);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}


if (isset($_POST['buscarContrato'])) {
    $idContrato = $_POST['idContrato'];
    validarDatos($idContrato);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
