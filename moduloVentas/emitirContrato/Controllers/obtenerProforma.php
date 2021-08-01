<?php


function mostrarProforma($idReferencial)
{
    include_once("CC_emitirContrato.php");
    $emitirContrato = new CC_emitirContrato;
    $emitirContrato->obtenerProforma($idReferencial);
}


function validarDatos($idReferencial)
{
    if (isset($idReferencial)) {
        mostrarProforma($idReferencial);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}


if (isset($_POST['buscarProforma'])) {
    $idReferencial = $_POST['idReferencial'];
    validarDatos($idReferencial);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
