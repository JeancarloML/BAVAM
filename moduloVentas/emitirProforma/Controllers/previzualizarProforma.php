<?php

function mostrarPrevizualizarProforma($idMueble, $cantidad, $precio, $nombre)
{
    include_once("../Views/CI_previzualizarProforma.php");
    $previzualizarProforma = new PrevizualizarProforma();
    return $previzualizarProforma->previzualizarProformaShow($idMueble, $cantidad, $precio, $nombre);
}

function validarDatos($precio, $idMueble, $cantidad, $nombre)
{
    if (isset($idMueble, $cantidad, $precio, $nombre)) {
        mostrarPrevizualizarProforma($idMueble, $cantidad, $precio, $nombre);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error","Error al intentar continuar con la proforma", "../../../index.php");
    }
}

if (isset($_POST['previzualizarProforma'])) {
    validarDatos($_POST['precio'], $_POST['mueble'], $_POST['cantidad'], $_POST['nombre']);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error","Error acceso no permitido", "../../../index.php");
}
