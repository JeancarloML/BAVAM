<?php
include("../Shared/FormularioMensajeSistema.php");
include("../Models/CE_Mueble.php");
include("../Models/CE_Proforma.php");
include("../Models/CE_Contrato.php");
include("../Models/CE_OrdenVenta.php");
include("../Models/CE_ComprobantePago.php");
include("../Views/CI_formularioComprobantePago.php");
include("../Views/CI_proforma.php");
include("../Views/CI_contrato.php");
include("../Views/CI_ordenVenta.php");
include("../Views/CI_formularioBuscarOrdenVenta.php");
include("../Views/CI_previsualizarOrdenVenta.php");
include("../Views/CI_previsualizarComprobantePago.php");
include("../Views/CI_emitirComprobantePago.php");

if (isset($_POST['btnEmitirComprobantePago'])) {
    $emitirComprobantePago = new EmitirComprobantePago;
    $emitirComprobantePago->emitirComprobantePagoShow();
} else if (isset($_POST['buscarOrdenVenta'])) {
    $idOrdenVenta = $_POST['idOrdenVenta'];
    if (isset($idOrdenVenta)) {
        $ordenVenta = new OrdenVenta();
        $ordenVentaItems = $ordenVenta->buscarOrdenVenta($idOrdenVenta);
        if (isset($ordenVentaItems)) {
            $contrato = new Contrato();
            $contratoItems = $contrato->buscarContrato($ordenVentaItems[0]['idContrato']);
            if (isset($contratoItems)) {
                $proforma = new Proforma();
                $proformaItems = $proforma->buscarProforma($ordenVentaItems[0]['idProforma']);
                if (isset($proformaItems)) {
                    $previzualizarContratoOrdenVenta = new PrevisualizarOrdenVenta();
                    return $previzualizarContratoOrdenVenta->previsualizarOrdenVentaShow($contratoItems, $proformaItems, $idOrdenVenta);
                }
            } else {
                $mensaje = new FormularioMensajeSistema;
                $mensaje->FormularioMensajeSistema();
                return $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraro proforma orden de vebta a contrato", '', $btn = "btnEmitirOrdenVenta");
            }
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            return $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentro la orden de venta", '', $btn = "btnEmitirOrdenVenta");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        return $mensaje->formularioMensajeSistemaShow(0, "Error", "Debe completar los campos requeridos", "../index.php");
    }
} else if (isset($_POST['cargarFormOrdenVenta'])) {
    $formularioBuscarOrdenVenta = new FormularioBuscarOrdenVenta();
    return $formularioBuscarOrdenVenta->formularioBuscarOrdenVentaShow();
} else if (isset($_POST['emitirComprobantePago'])) {
    $idContrato = $_POST['idContrato'];
    $idProforma = $_POST['idProforma'];
    $idOrdenVenta = $_POST['idOrdenVenta'];
    $idComprobante = $_POST['idComprobante'];
    if (isset($idContrato, $idProforma)) {
        $comprobantePago = new ComprobantePago();
        $comprobantePagoConfirmado = $comprobantePago->crearComprobantePago($idOrdenVenta, $idComprobante, $idProforma, $idContrato);
        if (isset($comprobantePagoConfirmado)) {
            print_r(json_encode($comprobantePagoConfirmado));
        } else {
            print_r(json_encode(array("ok" => false, "mensaje" => "No se pudo crear el comprobante de pago")));
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Datos invalidos", '', $btn = "btnEmitirOrdenVenta");
    }
} else if (isset($_POST['continuar'])) {
    $idOrdenVenta = $_POST['idOrdenVenta'];
    $comprobantePago = new ComprobantePago();
    $comprobantes = $comprobantePago->obtenerTiposComprobantes();
    if (isset($comprobantes)) {
        $formularioComprobantePago = new formularioComprobantePago();
        return $formularioComprobantePago->formularioComprobantePagoShow($comprobantes, $idOrdenVenta);
    }
} else if (isset($_POST['tipoComprobantePago'])) {
    $comprobantePago = $_POST['comprobante'];
    echo $idReferencial;
    if (isset($comprobantePago)) {
        $idOrdenVenta = $_POST['idOrdenVenta'];
        if (isset($idOrdenVenta)) {
            $ordenVenta = new OrdenVenta();
            $ordenVentaItems = $ordenVenta->buscarOrdenVenta($idOrdenVenta);
            if (isset($ordenVentaItems)) {
                $contrato = new Contrato();
                $contratoItems = $contrato->buscarContrato($ordenVentaItems[0]['idContrato']);
                if (isset($contratoItems)) {
                    $proforma = new Proforma();
                    $proformaItems = $proforma->buscarProforma($ordenVentaItems[0]['idProforma']);
                    if (isset($proformaItems)) {
                        $previsualizarComprobantePago = new previsualizarComprobantePago();
                        return $previsualizarComprobantePago->previsualizarComprobantePagoShow($comprobantePago, $contratoItems, $proformaItems, $idOrdenVenta);
                    }
                }
            }
        }
    }
} else {
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitido", "../index.php");
}
