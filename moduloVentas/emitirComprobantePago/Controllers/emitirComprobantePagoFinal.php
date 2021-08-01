<?php


function emitirComprobantePagoFinal($idContrato, $idProforma, $idOrdenVenta, $idComprobante)
{
    include_once("CC_emitirComprobantePago.php");
    $emitirComprobantePago = new CC_emitirComprobantePago;
    $emitirComprobantePago->emitirComprobantePago($idContrato, $idProforma, $idOrdenVenta, $idComprobante);
}


function validarDatos($idContrato, $idProforma, $idOrdenVenta, $idComprobante)
{
    if (isset($idContrato, $idProforma, $idOrdenVenta, $idComprobante)) {
        emitirComprobantePagoFinal($idContrato, $idProforma, $idOrdenVenta, $idComprobante);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}


if (isset($_POST['emitirComprobantePago'])) {
    validarDatos($_POST['idContrato'], $_POST['idProforma'], $_POST['idOrdenVenta'], $_POST['idComprobante']);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
