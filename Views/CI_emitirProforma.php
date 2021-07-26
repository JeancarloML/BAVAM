<?php

include_once("../Shared/SideBar.php");
session_start();

class EmitirProforma
{


    function emitirProformaShow()
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
            <title>Emitir Proforma</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 85vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 85%;">
                        <h1>Emitir proforma</h1>
                        <hr>
                        <form action="../Controllers/CC_emitirProforma.php" class="form" id="form" method="POST">
                            <div id="form-container" class="row" style="justify-content: space-between; gap: 20px;"></div>
                            <input class="btn btn-primary w-100 mb-2" type="submit" value="Continuar con proforma" name="continuar" />
                        </form>
                        <div class="d-flex flex-wrap">
                            <button class="btn btn-info w-100" id="agregar">Agregar otro mueble</button>
                        </div>
                    </div>
                </div>
                <?php require '../Partials/Footer.php' ?>
            </div>

            <script>
                "use strict"
                window.addEventListener("load", () => {
                    const form = document.querySelector("#form-container")
                    const btnAdd = document.querySelector("#agregar")
                    const btnNext = document.querySelector("#continuar")
                    const form1 = document.querySelector("#form")
                    form1.addEventListener("submit", (e) => {
                        console.log(e.target.elements)
                    })
                    loadMuebleForm()
                    btnAdd.addEventListener("click", () => {
                        const formR = new FormData();
                        formR.append("agregarMuebleForm", "agregarMuebleForm");
                        fetch("../Controllers/CC_emitirProforma.php", {
                            method: "POST",
                            body: formR
                        }).then(response => response.text()).then(data => {
                            const div = document.createElement("div");
                            div.innerHTML = data;
                            div.classList.add("col-12")
                            form.appendChild(div);
                            loadInputs()
                        })
                    })

                    function loadMuebleForm() {
                        const formR = new FormData();
                        formR.append("cargarMueble", "cargarMueble");
                        fetch("../Controllers/CC_emitirProforma.php", {
                            method: "POST",
                            body: formR
                        }).then(response => response.text()).then(data => {
                            const div = document.createElement("div");
                            div.innerHTML = data;
                            div.classList.add("col-12")
                            form.appendChild(div)
                            loadInputs()
                        })
                    }

                    function loadInputs() {
                        const nombreInputs = document.querySelectorAll(".nombre")
                        const precioInputs = document.querySelectorAll(".precio")
                        const img = document.querySelectorAll(".img")
                        const img2 = document.querySelectorAll(".img2")
                        const img3 = document.querySelectorAll(".img3")
                        const maxCantidadInputs = document.querySelectorAll(".maxcantidad")
                        const cantidadInputs = document.querySelectorAll(".cantidad")
                        const maderaInputs = document.querySelectorAll(".madera")
                        const nombreMuebleInputs = document.querySelectorAll(".nombreMueble")
                        nombreInputs.forEach((nombreInput, index) => {
                            nombreInput.addEventListener("change", (e) => {
                                const formR = new FormData();
                                formR.append("cargarDato", "changeInputs");
                                formR.append("idMueble", e.target.value);
                                fetch("../Controllers/CC_emitirProforma.php", {
                                    method: "POST",
                                    body: formR
                                }).then(response => response.json()).then(data => {
                                    precioInputs[index].value = data[0].precio
                                    maderaInputs[index].value = data[0].madera
                                    maxCantidadInputs[index].value = data[0].cantidad
                                    cantidadInputs[index].setAttribute("max", data[0].cantidad)
                                    nombreMuebleInputs[index].value = data[0].nombre
                                    img[index].setAttribute("src",data[0].imagen)
                                    img[index].style.display = "inline-block";
                                    img2[index].setAttribute("src",data[0].imagen2)
                                    img2[index].style.display = "inline-block";
                                    img3[index].setAttribute("src",data[0].imagen3)
                                    img3[index].style.display = "inline-block";
                                })
                            })
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