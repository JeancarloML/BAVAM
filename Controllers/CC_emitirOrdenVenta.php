<?php
include("../Shared/FormularioMensajeSistema.php");
include("../Models/CE_Mueble.php");
include("../Models/CE_Proforma.php");
include("../Models/CE_Contrato.php");
include("../Models/CE_OrdenVenta.php");
include("../Views/CI_formularioProforma.php");
include("../Views/CI_previzualizarProforma.php");
include("../Views/CI_previzualizarContrato.php");
include("../Views/CI_proforma.php");
include("../Views/CI_contrato.php");
include("../Views/CI_ordenVenta.php");
include("../Views/CI_emitirContrato.php");
include("../Views/CI_formularioBuscarProforma.php");
include("../Views/CI_formularioBuscarContrato.php");
include("../Views/CI_previzualizarContratoOrdenVenta.php");
include("../Views/CI_formularioContrato.php");
include("../Views/CI_emitirOrdenVenta.php");

if (isset($_POST['btnEmitirOrdenVenta'])) {
        $emitirOrdenVenta = new EmitirOrdenVenta();
        return $emitirOrdenVenta->emitirOrdenVentaShow();
} else if (isset($_POST['buscarContrato'])) {
    $idContrato = $_POST['idContrato'];
    if (isset($idContrato)) {
        $contrato = new Contrato();
        $contratoItems = $contrato->buscarContrato($idContrato);
        if (isset($contratoItems)) {
            $proforma = new Proforma();
            $proformaItems = $proforma->buscarProforma($contratoItems[0]['idProforma']);
            if (isset($proformaItems)) {
                $previzualizarContratoOrdenVenta = new PrevizualizarContratoOrdenVenta();
                return $previzualizarContratoOrdenVenta->previzualizarContratoOrdenVentaShow($contratoItems, $proformaItems);
            } else {
                $mensaje = new FormularioMensajeSistema;
                $mensaje->FormularioMensajeSistema();
                $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraro proforma asociada a contrato", '', $btn = "btnEmitirOrdenVenta");
            }
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentro el contrato", '', $btn = "btnEmitirOrdenVenta");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Debe completar los campos requeridos", "../index.php");
    }
} else if (isset($_POST['cargarFormContrato'])) {
    $formularioContrato = new FormularioBuscarContrato();
    return $formularioContrato->formularioBuscarContratoShow();
} else if (isset($_POST['emitirOrdenVenta'])) {
    $idContrato = $_POST['idContrato'];
    $idProforma = $_POST['idProforma'];
    if (isset($idContrato, $idProforma)) {
        $ordenVenta = new OrdenVenta();
        $ordenVentaData = $ordenVenta->crearOrdenVenta($idContrato, $idProforma);
        if (isset($ordenVentaData)) {
            $ordenVentaFinal = new OrdenVentaFinal();
            $ordenVentaFinal->ordenVentaFinalShow($ordenVentaData['idOrdenVenta'], $ordenVentaData['idContrato'], $ordenVentaData['idProforma']);
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose se encuentra proforma", '', $btn = "btnEmitirOrdenVenta");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Datos invalidos", '', $btn = "btnEmitirOrdenVenta");
    }
} else {
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../index.php");
}
