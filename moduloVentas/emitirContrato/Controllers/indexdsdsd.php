<?php
if (isset($_POST['emitirContrato'])) {
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
