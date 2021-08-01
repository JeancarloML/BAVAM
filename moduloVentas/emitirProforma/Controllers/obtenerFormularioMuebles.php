<?php

function mostrarMensajeError()
{
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    return $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../../../index.php");
}
function mostarFormularioMueble()
{

    include_once("CC_emitirProforma.php");
    $emitirProforma = new CC_emitirProforma;
    $emitirProforma->obtenerFormularioMuebles();
}


function mostrarDatosMueble()
{
    $idMueble = $_POST['idMueble'];
    include_once("CC_emitirProforma.php");
    $emitirProforma = new CC_emitirProforma;
    $emitirProforma->obtenerDatosMueble($idMueble);
}
if (isset($_POST['btnCargarFormularioMueble'])) {
    mostarFormularioMueble();
} else if (isset($_POST['btnCargarDatosMueble'])) {
    mostrarDatosMueble();
} else {
    mostrarMensajeError();
}
