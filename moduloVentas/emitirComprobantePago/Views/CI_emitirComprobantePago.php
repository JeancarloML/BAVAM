<?php

include_once("../Shared/SideBar.php");
session_start();

class EmitirComprobantePago
{


    function emitirComprobantePagoShow()
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
            <title>Emitir Comprobante de Pago</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 85vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 85%;">
                        <h1>Emitir Comprobante de Pago</h1>
                        <hr>
                        <form action="" class="form" id="form">
                            <div id="form-container" class="row" style="justify-content: space-between; gap: 20px;"></div>
                        </form>
                        <form id="form2" action="../Controllers/CC_emitirComprobantePago.php" method="POST">
                            <div class="row" id="ordenventa-container">
                            </div>
                            <input class="btn btn-primary w-100 mb-2" type="submit" value="Continuar" name="continuar" />
                        </form>

                    </div>
                </div>
                <?php require '../Partials/Footer.php' ?>
            </div>

            <script>
                "use strict"
                window.addEventListener("load", () => {
                    const form = document.querySelector("#form-container")
                    const ordenVentaContainer = document.querySelector("#ordenventa-container")
                    const btnNext = document.querySelector("#continuar")
                    const form1 = document.querySelector("#form")
                    form2.style.display = "none"
                    cargarOrdenVentaForm()

                    function buscarOrdenVenta() {
                        form1.addEventListener("submit", (e) => {
                            e.preventDefault();
                            const formR = new FormData();
                            formR.append("buscarOrdenVenta", "buscarOrdenVenta");
                            formR.append("idOrdenVenta", e.target[0].value);

                            fetch("../Controllers/CC_emitirComprobantePago.php", {
                                method: "POST",
                                body: formR
                            }).then(response => response.text()).then(data => {
                                const div = document.createElement("div");
                                div.innerHTML = data;
                                div.classList.add("col-12")
                                ordenVentaContainer.innerHTML = '';
                                ordenVentaContainer.append(div)
                                if (!(ordenVentaContainer.childNodes[0].childNodes.length === 12)) {
                                    form2.style.display = "block"
                                } else {
                                    form2.style.display = "none"
                                }
                            })
                        })
                    }

                    function cargarOrdenVentaForm() {
                        const formR = new FormData();
                        formR.append("cargarFormOrdenVenta", "cargarFormOrdenVenta");
                        fetch("../Controllers/CC_emitirComprobantePago.php", {
                            method: "POST",
                            body: formR
                        }).then(response => response.text()).then(data => {
                            const div = document.createElement("div");
                            div.innerHTML = data;
                            div.classList.add("col-12")
                            form.appendChild(div)
                            buscarOrdenVenta();
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