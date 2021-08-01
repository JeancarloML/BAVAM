<?php

function mostrarFormulario()
{
    include_once("../Views/CI_formularioBuscarProforma.php");
    $formularioProforma = new FormularioBuscarProforma();
    return $formularioProforma->formularioBuscarProformaShow();
}

if (isset($_POST['btnEmitirContrato'])) {
    mostrarFormulario();
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
