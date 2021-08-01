<?php



class CC_emitirComprobantePago
{

    function obtenerOrdenVenta($idOrdenVenta)
    {
        include_once("../../../Models/CE_OrdenVenta.php");
        $ordenVenta = new OrdenVenta();
        $ordenVentaItems = $ordenVenta->buscarOrdenVenta($idOrdenVenta);
        if (isset($ordenVentaItems)) {
            include_once("../../../Models/CE_Contrato.php");
            $contrato = new Contrato();
            $contratoItems = $contrato->buscarContrato($ordenVentaItems[0]['idContrato']);
            if (isset($contratoItems)) {
                include_once("../../../Models/CE_Proforma.php");
                $proforma = new Proforma();
                $proformaItems = $proforma->buscarProforma($ordenVentaItems[0]['idProforma']);
                if (isset($proformaItems)) {
                    include_once("../Views/CI_previsualizarOrdenVenta.php");
                    $previzualizarContratoOrdenVenta = new PrevisualizarOrdenVenta();
                    return $previzualizarContratoOrdenVenta->previsualizarOrdenVentaShow($contratoItems, $proformaItems, $idOrdenVenta);
                }
            } else {
                include_once("../../../Shared/FormularioMensajeSistema.php");
                $mensaje = new FormularioMensajeSistema;
                $mensaje->FormularioMensajeSistema();
                $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraro contratos asociados a esa orden de venta", '', $btn = "btnEmitirComprobantePago");
            }
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentro la orden de venta", '', $btn = "btnEmitirComprobantePago");
        }
    }

    function obtenerFormulario($idOrdenVenta)
    {
        include_once("../../../Models/CE_ComprobantePago.php");
        $comprobantePago = new ComprobantePago();
        $comprobantes = $comprobantePago->obtenerTiposComprobantes();
        if (isset($comprobantes)) {
            include_once("../Views/CI_formularioComprobantePago.php");
            $formularioComprobantePago = new formularioComprobantePago();
            return $formularioComprobantePago->formularioComprobantePagoShow($comprobantes, $idOrdenVenta);
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraron comprobantes de pago disponibles", '', $btn = "btnEmitirComprobantePago");
        }
    }
    function mostrarPrevizualizarComprobantePago($comprobantePago, $idOrdenVenta)
    {
        include_once("../../../Models/CE_OrdenVenta.php");
        $ordenVenta = new OrdenVenta();
        $ordenVentaItems = $ordenVenta->buscarOrdenVenta($idOrdenVenta);
        if (isset($ordenVentaItems)) {
            include_once("../../../Models/CE_Contrato.php");
            $contrato = new Contrato();
            $contratoItems = $contrato->buscarContrato($ordenVentaItems[0]['idContrato']);
            if (isset($contratoItems)) {
                include_once("../../../Models/CE_Proforma.php");
                $proforma = new Proforma();
                $proformaItems = $proforma->buscarProforma($ordenVentaItems[0]['idProforma']);
                if (isset($proformaItems)) {
                    include_once("../Views/CI_previsualizarComprobantePago.php");
                    $previsualizarComprobantePago = new previsualizarComprobantePago();
                    return $previsualizarComprobantePago->previsualizarComprobantePagoShow($comprobantePago, $contratoItems, $proformaItems, $idOrdenVenta);
                } else {
                    include_once("../../../Shared/FormularioMensajeSistema.php");
                    $mensaje = new FormularioMensajeSistema;
                    $mensaje->FormularioMensajeSistema();
                    $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraron proformas asociadas a orden de venta", '', $btn = "btnEmitirComprobantePago");
                }
            } else {
                include_once("../../../Shared/FormularioMensajeSistema.php");
                $mensaje = new FormularioMensajeSistema;
                $mensaje->FormularioMensajeSistema();
                $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraro un contrato asociado a la orden de venta", '', $btn = "btnEmitirComprobantePago");
            }
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraron orden de venta", '', $btn = "btnEmitirComprobantePago");
        }
    }

    function emitirComprobantePago($idContrato, $idProforma, $idOrdenVenta, $idComprobante)
    {
        include_once("../../../Models/CE_ComprobantePago.php");
        $comprobantePago = new ComprobantePago();
        $comprobantePagoConfirmado = $comprobantePago->crearComprobantePago($idOrdenVenta, $idComprobante, $idProforma, $idContrato);
        if (isset($comprobantePagoConfirmado)) {
            print_r(json_encode($comprobantePagoConfirmado));
        } else {
            print_r(json_encode(array("ok" => false, "mensaje" => "No se pudo crear el comprobante de pago")));
        }
    }
}
