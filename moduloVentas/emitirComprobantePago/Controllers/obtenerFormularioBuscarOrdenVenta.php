<?php

function mostrarFormulario()
{
    include_once("../Views/CI_formularioBuscarOrdenVenta.php");
    $formularioBuscarOrdenVenta = new FormularioBuscarOrdenVenta();
    return $formularioBuscarOrdenVenta->formularioBuscarOrdenVentaShow();
}

if (isset($_POST['btnFormularioBuscarOrdenVenta'])) {
    mostrarFormulario();
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
