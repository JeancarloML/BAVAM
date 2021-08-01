<?php

function mostrarFormularioComprobantePago($idOrdenVenta)
{
    include_once("CC_emitirComprobantePago.php");
    $emitirComprobantePago = new CC_emitirComprobantePago;
    $emitirComprobantePago->obtenerFormulario($idOrdenVenta);
}


function validarDatos($idOrdenVenta)
{
    if (isset($idOrdenVenta)) {
        mostrarFormularioComprobantePago($idOrdenVenta);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}

if (isset($_POST['continuarComprobantePago'])) {
    validarDatos($_POST['idOrdenVenta']);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
