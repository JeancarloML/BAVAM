<?php

class CC_emitirContrato
{
    function obtenerProforma($idReferencial)
    {
        include_once("../../../Models/CE_Proforma.php");
        $proforma = new Proforma();
        $proformaItems = $proforma->buscarProforma($idReferencial);
        if (isset($proformaItems)) {
            include_once("../Views/CI_previzualizarProformaContrato.php");
            $previzualizarProformaContrato = new PrevizualizarProformaContrato();
            return $previzualizarProformaContrato->previzualizarProformaContratoShow($proformaItems);
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encontraron Proforma", '', $btn = "btnEmitirContrato");
        }
    }

    function obtenerFormulario($idReferencial)
    {
        include_once("../../../Models/CE_Contrato.php");
        $contrato = new Contrato();
        $departamentos = $contrato->obtenerDepartamentos();
        if (isset($departamentos)) {
            include_once("../Views/CI_formularioContrato.php");
            $formularioContrato = new FormularioContrato();
            $formularioContrato->formularioContratoShow($idReferencial, $departamentos);
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay departamentos registrados", "../index.php");
        }
    }
    function obtenerProvincias($idDepartamento)
    {
        include_once("../../../Models/CE_Contrato.php");
        $contrato = new Contrato();
        $provincias = $contrato->obtenerProvincias($idDepartamento);
        if (isset($provincias)) {
            print_r(json_encode($provincias));
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay provincias registradas", "../index.php");
        }
    }

    function obtenerDistritos($idProvincia)
    {
        include_once("../../../Models/CE_Contrato.php");
        $contrato = new Contrato();
        $distritos = $contrato->obtenerDistritos($idProvincia);
        if (isset($distritos)) {
            print_r(json_encode($distritos));
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay distritos registradas", "../index.php");
        }
    }

    function mostrarPrevizualizarContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $idDepartamento, $idProvincia, $idDistrito, $direccion, $referencia, $idReferencial)
    {
        include_once("../../../Models/CE_Contrato.php");
        $contrato = new Contrato();
        $ubicacion = $contrato->obtenerUbicacion($idDepartamento, $idProvincia, $idDistrito);
        if (isset($ubicacion)) {
            include_once("../Views/CI_previzualizarContrato.php");
            $previzualizarContrato = new PrevizualizarContrato();
            return $previzualizarContrato->previzualizarContratoShow($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $ubicacion[0]['departamento'], $ubicacion[0]['provincia'], $ubicacion[0]['distrito'], $direccion, $referencia, $idReferencial);
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay ubicaciones registradas", "../index.php");
        }
    }
    function emitirContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma)
    {
        include_once("../../../Models/CE_Contrato.php");
        $contrato = new Contrato();
        $idReferencial = $contrato->crearContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma);
        if (isset($idReferencial)) {
            include_once("../Views/CI_contratoFinal.php");
            $contratoFinal = new ContratoFinal();
            return $contratoFinal->contratoFinalShow($idReferencial, $nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma);
        } else {
            include_once("../../../Shared/FormularioMensajeSistema.php");
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose se pudo generar el contrato", "../index.php");
        }
    }
}
