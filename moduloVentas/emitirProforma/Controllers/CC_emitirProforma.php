<?php

class CC_emitirProforma
{
    function obtenerFormularioMuebles()
    {
        include_once("../../../Models/CE_Mueble.php");
        $mueble = new Mueble();
        $muebles = $mueble->obtenerMuebles();
        if (isset($muebles)) {
            include_once("../Views/CI_formularioProforma.php");
            $formularioProforma = new FormularioProforma();
            $formularioProforma->formularioProformaShow($muebles);
        } else {
            mostrarMensajeError("No hay Stock Disponible");
        }
    }
    function obtenerDatosMueble($idMueble)
    {
        include_once("../../../Models/CE_Mueble.php");
        $mueble = new Mueble();
        $res = $mueble->obtenerMueble($idMueble);
        if (isset($res)) {
            print_r(json_encode($res));
        } else {
            mostrarMensajeError("No hay Stock Disponible");
        }
    }
    function emitirProforma($precioTotal, $idMuebles, $cantidades, $precios, $nombres, $totalImporte)
    {
        include_once("../../../Models/CE_Proforma.php");
        $proforma = new Proforma();
        $idreferencial = $proforma->emitirProformaFinal($idMuebles, $cantidades, $precioTotal, $nombres);
        include_once("../Views/CI_proformaFinal.php");
        $proforma = new ProformaFinal();
        $proforma->proformaFinalShow($idreferencial, $idMuebles, $cantidades, $precios, $nombres, $totalImporte);
    }
    function mostrarMensajeError($mensaje)
    {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        return $mensaje->formularioMensajeSistemaShow(0, "Error", $mensaje, "../../../index.php");
    }
}
