<?php

include_once("../../../Shared/SideBar.php");
session_start();

class EmitirOrdenVenta
{
    function emitirOrdenVentaShow()
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
            <title>Emitir Orden de Venta</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../../../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 85vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 85%;">
                        <h1>Emitir Orden de Venta</h1>
                        <hr>
                        <form action="" class="form" id="form">
                            <div id="form-container" class="row" style="justify-content: space-between; gap: 20px;"></div>
                        </form>
                        <form id="form2" action="../Controllers/emitirOrdenVentaFinal.php" method="POST">
                            <div class="row" id="contrato-container">
                            </div>
                            <input class="btn btn-primary w-100 mb-2" type="submit" value="Emitir Orden de Venta" name="emitirOrdenVenta" />
                        </form>

                    </div>
                </div>
                <?php require '../../../Partials/Footer.php' ?>
            </div>

            <script>
                "use strict"
                window.addEventListener("load", () => {
                    const form = document.querySelector("#form-container")
                    const contratoContainer = document.querySelector("#contrato-container")
                    const btnNext = document.querySelector("#continuar")
                    const form1 = document.querySelector("#form")
                    form2.style.display = "none"
                    cargarContratoForm()

                    function buscarContrato() {
                        form1.addEventListener("submit", (e) => {
                            e.preventDefault();
                            const formR = new FormData();
                            formR.append("buscarContrato", "buscarContrato");
                            formR.append("idContrato", e.target[0].value);
                            fetch("../Controllers/obtenerContrato.php", {
                                method: "POST",
                                body: formR
                            }).then(response => response.text()).then(data => {
                                const div = document.createElement("div");
                                div.innerHTML = data;
                                div.classList.add("col-12")
                                contratoContainer.innerHTML = '';
                                contratoContainer.append(div)
                                if (!(contratoContainer.childNodes[0].childNodes.length === 12)) {
                                    form2.style.display = "block"
                                } else {
                                    form2.style.display = "none"
                                }
                            })
                        })
                    }

                    function cargarContratoForm() {
                        const formR = new FormData();
                        formR.append("btnFormularioBuscarContrato", "btnFormularioBuscarContrato");
                        fetch("../Controllers/obtenerFormularioBuscarContrato.php", {
                            method: "POST",
                            body: formR
                        }).then(response => response.text()).then(data => {
                            const div = document.createElement("div");
                            div.innerHTML = data;
                            div.classList.add("col-12")
                            form.appendChild(div)
                            buscarContrato();
                        })
                    }
                })
            </script>
        </body>

        </html>
<?php
    }
}
?>