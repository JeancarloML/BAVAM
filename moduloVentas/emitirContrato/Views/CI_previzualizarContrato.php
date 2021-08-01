<?php
include_once("../../../Shared/SideBar.php");
session_start();
class PrevizualizarContrato
{

    function previzualizarContratoShow($nombres,  $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idReferencial)
    {
        $listaPrivilegios = $_SESSION['privilegios'];
        $sidebar = new SideBar;
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Prevializar Contrato</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../../../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 90vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 80%;">
                        <form id="form" action="../Controllers/emitirContratoFinal.php" method="POST">
                            <p class="alert alert-secondary">Revisar todos los datos antes de continuar</p>
                            <div class="row mb-3" style="border: 1px solid black;">
                                <h4 class="alert alert-primary">Contrato</h4>
                                <div class="mb-3 col-12">
                                    <label for="cantidad" class="form-label">N° Proforma</label>
                                    <input readonly type="text" id="idReferencial" class="form-control cantidad" value="<?php echo $idReferencial ?>" name="idReferencial" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="nombre" class="form-label">Nombres</label>
                                    <input readonly type="text" class="form-control" name="nombres" value="<?php echo $nombres ?>" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                    <input readonly type="text" class="form-control" name="apellidoP" value="<?php echo $apellidoP ?>" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="apellidoM" class="form-label">Apellido Materno</label>
                                    <input readonly type="text" class="form-control" name="apellidoM" value="<?php echo $apellidoM ?>" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input readonly type="number" class="form-control" name="celular" value="<?php echo $celular ?>" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input readonly type="number" class="form-control" name="dni" value="<?php echo $dni ?>" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input readonly type="email" class="form-control" name="correo" value="<?php echo $correo ?>" />
                                </div>
                            </div>
                            <div class="row mb-3" style="border: 1px solid black;">
                                <h4 class="alert alert-primary">Datos de Domicilio</h4>
                                <div class="mb-3 col-4">
                                    <label for="departamento" class="form-label">Departamento</label>
                                    <input readonly type="text" class="form-control" name="departamento" value="<?php echo $departamento ?>" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="provincia" class="form-label">Provincia</label>
                                    <input readonly type="text" class="form-control" name="provincia" value="<?php echo $provincia ?>" />
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="distrito" class="form-label">Distrito</label>
                                    <input readonly type="text" class="form-control" name="distrito" value="<?php echo $distrito ?>" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input readonly type="text" class="form-control" name="direccion" value="<?php echo $direccion ?>" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="referencia" class="form-label">Referencia</label>
                                    <input readonly type="text" class="form-control" name="referencia" value="<?php echo $referencia ?>" />
                                </div>
                            </div>
                            <div class="row py-4" id="proforma-container"></div>
                            <input type="submit" value="Emitir Contrato" name="emitirContrato" class="btn btn-success w-100" />
                        </form>
                    </div>
                </div>
                <?php require '../../../Partials/Footer.php' ?>
            </div>
            <script>
                "use strict"
                window.addEventListener("load", () => {
                    const proformaContainer = document.querySelector("#proforma-container")
                    const idReferencial = document.querySelector("#idReferencial")
                    const formR = new FormData();
                    const idReferencialValue = idReferencial.value
                    formR.append("buscarProforma", "buscarProforma");
                    formR.append("idReferencial", idReferencialValue);
                    fetch("../Controllers/obtenerProforma.php", {
                        method: "POST",
                        body: formR
                    }).then(response => response.text()).then(data => {
                        const div = document.createElement("div");
                        div.innerHTML = data;
                        div.classList.add("col-12")
                        proformaContainer.innerHTML = '';
                        proformaContainer.append(div);
                    })
                })
            </script>
        </body>

        </html>
<?php
    }
}
?>