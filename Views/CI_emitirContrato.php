<?php

include_once("../Shared/SideBar.php");
session_start();

class EmitirContrato
{


    function emitirContratoShow()
    {

        $listaPrivilegios = $_SESSION['privilegios'];
        $sidebar = new SideBar;
        // $sidebar->SideBarShow($listaPrivilegios);
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Emitir Contrato</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 85vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 85%;">
                        <h1>Emitir Contrato</h1>
                        <hr>
                        <form action="" class="form" id="form">
                            <div id="form-container" class="row" style="justify-content: space-between; gap: 20px;"></div>
                            <div class="row" id="proforma-container">
                            </div>
                        </form>
                        <form id="form2" action="../Controllers/CC_emitirContrato.php" method="POST">
                            <input type="hidden" value="" id="idReferencial" name="idReferencial">
                            <input class="btn btn-primary w-100 mb-2" type="submit" value="Continuar con contrato" name="continuarContrato" />
                        </form>

                    </div>
                </div>
                <?php require '../Partials/Footer.php' ?>
            </div>

            <script>
                "use strict"
                window.addEventListener("load", () => {
                    const form = document.querySelector("#form-container")
                    const proformaContainer = document.querySelector("#proforma-container")
                    const btnNext = document.querySelector("#continuar")
                    const form1 = document.querySelector("#form")
                    const form2 = document.querySelector("#form2")
                    form2.style.display = "none"
                    cargarForm()

                    function buscarProforma() {
                        form1.addEventListener("submit", (e) => {
                            e.preventDefault();
                            const formR = new FormData();
                            const idReferencial = inputContrato.value
                            formR.append("buscarProforma", "buscarProforma");
                            formR.append("idReferencial", idReferencial);
                            const idReferencial2 = document.querySelector("#idReferencial")
                            idReferencial2.value = idReferencial;
                            fetch("../Controllers/CC_emitirContrato.php", {
                                method: "POST",
                                body: formR
                            }).then(response => response.text()).then(data => {
                                const div = document.createElement("div");
                                div.innerHTML = data;
                                div.classList.add("col-12")
                                proformaContainer.innerHTML = '';
                                proformaContainer.append(div)
                                if (!(proformaContainer.childNodes[0].childNodes.length === 12)) {
                                    form2.style.display = "block"
                                } else {
                                    form2.style.display = "none"
                                }
                            })
                        })
                    }

                    function cargarForm() {
                        const formR = new FormData();
                        formR.append("cargarFormProforma", "cargarFormProforma");
                        fetch("../Controllers/CC_emitirContrato.php", {
                            method: "POST",
                            body: formR
                        }).then(response => response.text()).then(data => {
                            const div = document.createElement("div");
                            div.innerHTML = data;
                            div.classList.add("col-12")
                            form.appendChild(div)
                            buscarProforma();
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