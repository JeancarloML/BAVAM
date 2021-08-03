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
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            return $mensaje->formularioMensajeSistemaShow(0, "No hay stock disponible", $mensaje, "../../../index.php");
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
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            return $mensaje->formularioMensajeSistemaShow(0, "No hay stock disponible", $mensaje, "../../../index.php");
        }
    }
    function emitirProforma($precioTotal, $idMuebles, $cantidades, $precios, $nombres, $totalImporte)
    {
        include_once("../../../Models/CE_Proforma.php");
        $proforma = new Proforma();
        $idReferencial = $proforma->emitirProformaFinal($idMuebles, $cantidades, $precioTotal, $nombres);
        if (isset($idReferencial)) {
            include_once("../Views/CI_proformaFinal.php");
            $proforma = new ProformaFinal();
            $proforma->proformaFinalShow($idReferencial, $idMuebles, $cantidades, $precios, $nombres, $totalImporte);
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            return $mensaje->formularioMensajeSistemaShow(0, "Error al guardar proforma", $mensaje, "../../../index.php");
        }
    }
}
