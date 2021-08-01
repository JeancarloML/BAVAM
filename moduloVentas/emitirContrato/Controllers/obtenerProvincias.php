<?php


function obtenerProvincias($idDepartamento)
{
    include_once("CC_emitirContrato.php");
    $emitirContrato = new CC_emitirContrato;
    $emitirContrato->obtenerProvincias($idDepartamento);
}


function validarDatos($idDepartamento)
{
    if (isset($idDepartamento)) {
        obtenerProvincias($idDepartamento);
    } else {
        include_once("../../../Shared/FormularioMensajeSistema.php");
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Complete los datos requeridos", '', $btn = "btnEmitirContrato");
    }
}


if (isset($_POST['obtenerProvincias'])) {
    $idDepartamento = $_POST['idDepartamento'];
    validarDatos($idDepartamento);
} else {
    include_once("../../../Shared/FormularioMensajeSistema.php");
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ha detectado un acceso no permitdo", "../index.php");
}
