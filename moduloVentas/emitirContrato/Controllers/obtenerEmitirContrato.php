<?php

function mostrarEmitirContrato()
{
    include_once("../Views/CI_emitirContrato.php");
    $emitirContrato = new EmitirContrato();
    $emitirContrato->emitirContratoShow();
}

if (isset($_POST['btnEmitirContrato'])) {
    mostrarEmitirContrato();
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
