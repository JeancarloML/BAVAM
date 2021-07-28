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
include("../../../Models/CE_Contrato.php");
/*
@vistas
*/
include("../Views/CI_emitirContrato.php");
include("../Views/CI_contratoFinal.php");
include("../Views/CI_formularioBuscarProforma.php");
include("../Views/CI_formularioContrato.php");
include("../Views/CI_previzualizarProformaContrato.php");
include("../Views/CI_previzualizarContrato.php");

if (isset($_POST['btnEmitirContrato'])) {
    $emitirContrato = new EmitirContrato();
    return $emitirContrato->emitirContratoShow();
} else if (isset($_POST['buscarProforma'])) {
    $idReferencial = $_POST['idReferencial'];
    if (isset($idReferencial)) {
        $proforma = new Proforma();
        $proformaItems = $proforma->buscarProforma($idReferencial);
        if (isset($proformaItems)) {
            $previzualizarProformaContrato = new PrevizualizarProformaContrato();
            return $previzualizarProformaContrato->previzualizarProformaContratoShow($proformaItems);
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No se encuentraron proformas", '', $btn = "btnEmitirContrato");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Debe completar los campos requeridos", "../index.php");
    }
} else if (isset($_POST['cargarFormProforma'])) {
    $formularioProforma = new FormularioBuscarProforma();
    return $formularioProforma->formularioBuscarProformaShow();
} else if (isset($_POST['continuarContrato'])) {
    $idReferencial = $_POST['idReferencial'];
    if (isset($idReferencial)) {
        $contrato = new Contrato();
        $departamentos = $contrato->obtenerDepartamentos();
        if (isset($departamentos)) {
            $formularioContrato = new FormularioContrato();
            $formularioContrato->formularioContratoShow($idReferencial, $departamentos);
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay departamentos registrados", "<a class='btn btn-primary' href='../index.php'>Ir al inicio</a>");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Debe completar los campos requeridos", "<a class='btn btn-primary' href='../index.php'>Ir al inicio</a>");
    }
} else if (isset($_POST['mostrarProvincias'])) {
    $idDepartamento = $_POST['idDepartamento'];
    if (isset($_POST['idDepartamento'])) {
        $contrato = new Contrato();
        $provincias = $contrato->obtenerProvincias($idDepartamento);
        if (isset($provincias)) {
            print_r(json_encode($provincias));
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay provincias registradas", "<a class='btn btn-primary' href='../index.php'>Ir al inicio</a>");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Debe completar los campos requeridos", "<a class='btn btn-primary' href='../index.php'>Ir al inicio</a>");
    }
} else if (isset($_POST['mostrarDistritos'])) {
    $idProvincia = $_POST['idProvincia'];
    if (isset($_POST['idProvincia'])) {
        $contrato = new Contrato();
        $distritos = $contrato->obtenerDistritos($idProvincia);
        if (isset($distritos)) {
            print_r(json_encode($distritos));
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay distritos registrados", "../index.php");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Debe completar los campos requeridos", "../index.php");
    }
} else if (isset($_POST['previzualizarContrato'])) {
    $nombres = $_POST['nombres'];
    $apellidoM = $_POST['apellidoM'];
    $apellidoP = $_POST['apellidoP'];
    $celular = $_POST['celular'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $idDepartamento = $_POST['departamento'];
    $idProvincia = $_POST['provincia'];
    $idDistrito = $_POST['distrito'];
    $referencia = $_POST['referencia'];
    $idReferencial = $_POST['idReferencial'];
    if (isset($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $idDepartamento, $idProvincia, $idDistrito, $direccion, $referencia, $idReferencial)) {
        $contrato = new Contrato();
        $ubicacion = $contrato->obtenerUbicacion($idDepartamento, $idProvincia, $idDistrito);
        if (isset($ubicacion)) {
            $previzualizarContrato = new PrevizualizarContrato();
            return $previzualizarContrato->previzualizarContratoShow($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $ubicacion[0]['departamento'], $ubicacion[0]['provincia'], $ubicacion[0]['distrito'], $direccion, $referencia, $idReferencial);
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "No hay ubicaciones registradas", "../index.php");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Error al intentar continuar con el contrato", "../index.php");
    }
} else if (isset($_POST['emitirContrato'])) {
    $nombres = $_POST['nombres'];
    $apellidoM = $_POST['apellidoM'];
    $apellidoP = $_POST['apellidoP'];
    $celular = $_POST['celular'];
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $referencia = $_POST['referencia'];
    $idProforma = $_POST['idReferencial'];
    if (isset($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma)) {
        $contrato = new Contrato();
        $idReferencial = $contrato->crearContrato($nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma);
        if (isset($idReferencial)) {
            $contratoFinal = new ContratoFinal();
            $contratoFinal->contratoFinalShow($idReferencial, $nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma);
        } else {
            $mensaje = new FormularioMensajeSistema;
            $mensaje->FormularioMensajeSistema();
            $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../index.php");
        }
    } else {
        $mensaje = new FormularioMensajeSistema;
        $mensaje->FormularioMensajeSistema();
        $mensaje->formularioMensajeSistemaShow(0, "Error", "Nose hay stock disponible", "../index.php");
    }
} else {
    $mensaje = new FormularioMensajeSistema;
    $mensaje->FormularioMensajeSistema();
    $mensaje->formularioMensajeSistemaShow(0, "Error", "Se ah detectado un acceso no permitido", "../index.php");
}
