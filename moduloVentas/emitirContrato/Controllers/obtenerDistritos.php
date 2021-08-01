<?php


function obtenerDistritos($idProvincia)
{
    include_once("CC_emitirContrato.php");
    $emitirContrato = new CC_emitirContrato;
    $emitirContrato->obtenerDistritos($idProvincia);
}


function validarDatos($idProvincia)
{
    if (isset($idProvincia)) {
        obtenerDistritos($idProvincia);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}


if (isset($_POST['obtenerDistritos'])) {
    $idProvincia = $_POST['idProvincia'];
    validarDatos($idProvincia);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
