<?php

function mostrarEmitirComprobantePago()
{
    include_once("../Views/CI_emitirComprobantePago.php");
    $emitirComprobantePago = new EmitirComprobantePago;
    $emitirComprobantePago->emitirComprobantePagoShow();
}

if (isset($_POST['btnEmitirComprobantePago'])) {
    mostrarEmitirComprobantePago();
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
