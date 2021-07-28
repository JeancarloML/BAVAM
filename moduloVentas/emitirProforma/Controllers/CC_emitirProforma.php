<?php
/*
@compartido
*/
include("../../../Shared/FormularioMensajeSistema.php");
/*
@modelos
*/
include("../../../Models/CE_Mueble.php");
include("../../../Models/CE_Proforma.php");
/*
@vistas
*/
include("../Views/CI_emitirProforma.php");
include("../Views/CI_formularioProforma.php");
include("../Views/CI_previzualizarProforma.php");
include("../Views/CI_proformaFinal.php");

if (isset($_POST['btnEmitirProforma'])) {
    $mueble = new Mueble();
    $muebles = $mueble->obtenerMuebles();
    if (isset($muebles)) {
        $emitirProforma = new EmitirProforma();
        return $emitirProforma->emitirProformaShow();
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../../../index.php");
    }
} else if (isset($_POST['agregarMuebleForm'])) {
    $mueble = new Mueble();
    $muebles = $mueble->obtenerMuebles();
    if (isset($muebles)) {
        $formularioProforma = new FormularioProforma();
        return $formularioProforma->formularioProformaShow($muebles);
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../../../index.php");
    }
} else if (isset($_POST['cargarMueble'])) {
    $mueble = new Mueble();
    $muebles = $mueble->obtenerMuebles();
    if (isset($muebles)) {
        $formularioProforma = new FormularioProforma();
        return $formularioProforma->formularioProformaShow($muebles);
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../../../index.php");
    }
} else if (isset($_POST['idMueble'])) {
    $idMueble = $_POST['idMueble'];
    $mueble = new Mueble();
    $mueble = $mueble->obtenerMueble($idMueble);
    if (isset($mueble)) {
        print_r(json_encode($mueble));
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../../../index.php");
    }
} else if (isset($_POST['continuar'])) {
    $precio = $_POST['precio'];
    $idMueble = $_POST['mueble'];
    $cantidad = $_POST['cantidad'];
    $nombre = $_POST['nombre'];
    if (isset($idMueble, $cantidad, $precio, $nombre)) {
        $previzualizarProforma = new PrevizualizarProforma();
        return $previzualizarProforma->previzualizarProformaShow($idMueble, $cantidad, $precio, $nombre);
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Error al intentar continuar con la proforma", "../../../index.php");
    }
} else if (isset($_POST['emitirProforma'])) {
    $precioTotal = $_POST['precioTotal'];
    $idMuebles = $_POST['idMuebles'];
    $cantidades = $_POST['cantidades'];
    $precios = $_POST['precios'];
    $nombres = $_POST['nombres'];
    $totalImporte = $_POST['totalImporte'];
    if (isset($idMuebles, $cantidades, $precioTotal, $nombres)) {
        $proforma = new Proforma();
        $idreferencial = $proforma->emitirProformaFinal($idMuebles, $cantidades, $precioTotal, $nombres);
        $proforma = new ProformaFinal();
        return $proforma->proformaFinalShow($idreferencial, $idMuebles, $cantidades, $precios, $nombres, $totalImporte);
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../../../index.php");
    }
} else {
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
