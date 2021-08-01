<?php

function emitirProformaFinal($precioTotal, $idMuebles, $cantidades, $precios, $nombres, $totalImporte)
{
    include_once("CC_emitirProforma.php");
    $emitirProforma = new CC_emitirProforma;
    $emitirProforma->emitirProforma($precioTotal, $idMuebles, $cantidades, $precios, $nombres, $totalImporte);
}


function validarDatos($precioTotal, $idMuebles, $cantidades, $precios, $nombres, $totalImporte)
{
    if (isset($precioTotal, $idMuebles, $cantidades, $precios, $nombres, $totalImporte)) {
        emitirProformaFinal($precioTotal, $idMuebles, $cantidades, $precios, $nombres, $totalImporte);
    } else {
        mostrarMensajeError("Error al intentar generar proforma");
    }
}

function mostrarMensajeError($mensaje)
{
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", $mensaje, "../../../index.php");
};

if (isset($_POST['emitirProforma'])) {
    validarDatos($_POST['precioTotal'], $_POST['idMuebles'], $_POST['cantidades'], $_POST['precios'], $_POST['nombres'], $_POST['totalImporte']);
} else {
    mostrarMensajeError("Se ah detectado un acceso no permitido");
}
