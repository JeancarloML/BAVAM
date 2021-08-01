<?php

function mostrarPrevizualizarComprobantePago($comprobante, $idOrdenVenta)
{
    include_once("CC_emitirComprobantePago.php");
    $emitirComprobantePago = new CC_emitirComprobantePago;
    $emitirComprobantePago->mostrarPrevizualizarComprobantePago($comprobante, $idOrdenVenta);
}

function validarDatos($comprobante, $idOrdenVenta)
{
    if (isset($comprobante, $idOrdenVenta)) {
        mostrarPrevizualizarComprobantePago($comprobante, $idOrdenVenta);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Error al intentar continuar con comprobante de pago", "../../../index.php");
    }
}

if (isset($_POST['previzualizarComprobantePago'])) {
    validarDatos($_POST['comprobante'], $_POST['idOrdenVenta']);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Error acceso no permitido", "../../../index.php");
}
