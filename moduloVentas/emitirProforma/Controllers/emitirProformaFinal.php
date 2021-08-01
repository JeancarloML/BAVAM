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
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Error al intentar generar proforma", "../../../index.php");
    }
}


if (isset($_POST['emitirProforma'])) {
    validarDatos($_POST['precioTotal'], $_POST['idMuebles'], $_POST['cantidades'], $_POST['precios'], $_POST['nombres'], $_POST['totalImporte']);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
