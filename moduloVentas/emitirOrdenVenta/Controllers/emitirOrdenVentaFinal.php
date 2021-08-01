<?php


function emitirOrdenVentaFinal($idContrato, $idProforma)
{
    include_once("CC_emitirOrdenVenta.php");
    $emitirOrdenVenta = new CC_emitirOrdenVenta;
    $emitirOrdenVenta->emitirOrdenVenta($idContrato, $idProforma);
}


function validarDatos($idContrato, $idProforma)
{
    if (isset($idContrato, $idProforma)) {
        emitirOrdenVentaFinal($idContrato, $idProforma);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}


if (isset($_POST['emitirOrdenVenta'])) {
    $idContrato = $_POST['idContrato'];
    $idProforma = $_POST['idProforma'];
    validarDatos($idContrato, $idProforma);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
