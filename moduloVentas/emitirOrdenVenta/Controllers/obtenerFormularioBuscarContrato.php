<?php

function mostrarFormulario()
{
    include_once("../Views/CI_formularioBuscarContrato.php");
    $formularioContrato = new FormularioBuscarContrato();
    return $formularioContrato->formularioBuscarContratoShow();
}

if (isset($_POST['btnFormularioBuscarContrato'])) {
    mostrarFormulario();
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../../../index.php");
}
