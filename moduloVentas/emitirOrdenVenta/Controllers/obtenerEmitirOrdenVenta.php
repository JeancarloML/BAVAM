<?php

function mostrarEmitirOrdenVenta()
{
    include_once("../Views/CI_emitirOrdenVenta.php");
    $emitirOrdenVenta = new EmitirOrdenVenta();
    $emitirOrdenVenta->EmitirOrdenVentaShow();
}

if (isset($_POST['btnEmitirOrdenVenta'])) {
    mostrarEmitirOrdenVenta();
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
