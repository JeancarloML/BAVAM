<?php


function mostrarOrdenVenta($idOrdenVenta)
{
    include_once("CC_emitirComprobantePago.php");
    $emitirComprobantePago = new CC_emitirComprobantePago;
    $emitirComprobantePago->obtenerOrdenVenta($idOrdenVenta);
}


function validarDatos($idOrdenVenta)
{
    if (isset($idOrdenVenta)) {
        mostrarOrdenVenta($idOrdenVenta);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}


if (isset($_POST['buscarOrdenVenta'])) {
    $idOrdenVenta = $_POST['idOrdenVenta'];
    validarDatos($idOrdenVenta);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
