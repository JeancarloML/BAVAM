<?php

class CC_emitirOrdenVenta
{
    function obtenerContrato($idContrato)
    {
        include_once("../../../Models/CE_Contrato.php");
        $contrato = new Contrato();
        $contratoItems = $contrato->buscarContrato($idContrato);
        if (isset($contratoItems)) {
            include_once("../../../Models/CE_Proforma.php");
            $proforma = new Proforma();
            $proformaItems = $proforma->buscarProforma($contratoItems[0]['idProforma']);
            if (isset($proformaItems)) {
                include_once("../Views/CI_previzualizarContratoOrdenVenta.php");
                $previzualizarContratoOrdenVenta = new PrevizualizarContratoOrdenVenta();
                return $previzualizarContratoOrdenVenta->previzualizarContratoOrdenVentaShow($contratoItems, $proformaItems);
            } else {
                include_once("../../../Shared/FormularioMensajeSistema.php");
                $mensaje = new FormularioMensajeSistema;
                $mensaje->FormularioMensajeSistema();
                $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraro proforma asociada a contrato", '', $btn = "btnEmitirOrdenVenta");
            }
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentro el contrato", '', $btn = "btnEmitirOrdenVenta");
        }
    }

    function emitirOrdenVenta($idContrato, $idProforma)
    {
        include_once("../../../Models/CE_OrdenVenta.php");
        $ordenVenta = new OrdenVenta();
        $ordenVentaData = $ordenVenta->crearOrdenVenta($idContrato, $idProforma);
        if (isset($ordenVentaData)) {
            include_once("../Views/CI_ordenVentaFinal.php");
            $ordenVentaFinal = new OrdenVentaFinal();
            return $ordenVentaFinal->ordenVentaFinalShow($ordenVentaData['idOrdenVenta'], $ordenVentaData['idContrato'], $ordenVentaData['idProforma']);
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose se encuentra proforma", '', $btn = "btnEmitirOrdenVenta");
        }
    }
}
