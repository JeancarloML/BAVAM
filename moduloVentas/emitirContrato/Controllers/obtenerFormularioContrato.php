<?php

function mostrarFormularioContrato($idReferencial)
{
    include_once("CC_emitirContrato.php");
    $emitirContrato = new CC_emitirContrato;
    $emitirContrato->obtenerFormulario($idReferencial);
}


function validarDatos($idReferencial)
{
    if (isset($idReferencial)) {
        mostrarFormularioContrato($idReferencial);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}




if (isset($_POST['continuarContrato'])) {
    validarDatos($_POST['idReferencial']);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
