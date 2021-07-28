<?php

class ContratoFinal
{
    function contratoFinalShow($idReferencial, $nombres, $apellidoP, $apellidoM, $celular, $dni, $correo, $departamento, $provincia, $distrito, $direccion, $referencia, $idProforma)
    {
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Contrato</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />

        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <div class="w-100" style="min-height: 90vh;">
                    <div class="container p-5 m-auto">
                        <form id="htmlData" action="../Controllers/CC_emitirContrato.php" method="POST">
                            <h1>Contrato</h1>
                            <h2 class="alert alert-primary">N° <?php echo $idReferencial ?></h2>
                            <div class="row mb-3" style="border: 1px solid black;">
                                <h4 class="alert alert-primary">Datos de Cliente</h4>
                                <div class="mb-3 col-12">
                                    <label for="cantidad" class="form-label">N° Proforma</label>
                                    <input readonly type="text" id="idProforma" class="form-control" value="<?php echo $idProforma ?>" name="idProforma" />
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
                        </form>
                        <form class="container" method="POST" action="../Controllers/CC_emitirContrato.php">
                            <input class="btn btn-primary" aria-current="page" type="submit" value="Volver a Menu Emitir Contrato" name="btnEmitirContrato" id="btnEmitirContrato">
                        </form>
                    </div>
                </div>
            </div>
            <script src="../html2canvas.min.js"></script>
            <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
            <script>
                "use strict"
                window.addEventListener("load", () => {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const proformaContainer = document.querySelector("#proforma-container")
                    const idProforma = document.querySelector("#idProforma")
                    const formR = new FormData();
                    const idProformaValue = idProforma.value
                    formR.append("buscarProforma", "buscarProforma");
                    formR.append("idReferencial", idProformaValue);
                    fetch("../Controllers/CC_emitirContrato.php", {
                        method: "POST",
                        body: formR
                    }).then(response => response.text()).then(data => {
                        const div = document.createElement("div");
                        div.innerHTML = data;
                        div.classList.add("col-12")
                        proformaContainer.innerHTML = '';
                        proformaContainer.append(div);
                        generatePdf()
                    })


                    const generatePdf = async () => {
                        window.scrollTo(0, 0);
                        const DATA = document.getElementById("htmlData");
                        const doc = new jsPDF("p", "pt", "a4");
                        const options = {
                            scale: 3,
                            useCORS: true,
                        };
                        html2canvas(DATA, options)
                            .then((canvas) => {
                                const img = canvas.toDataURL("image/PNG");
                                // Add image Canvas to PDF
                                const bufferX = 15;
                                const bufferY = 15;
                                const imgProps = doc.getImageProperties(img);
                                const pdfWidth = doc.internal.pageSize.getWidth() - 2 * bufferX;
                                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                                doc.addImage(
                                    img,
                                    "PNG",
                                    bufferX,
                                    bufferY,
                                    pdfWidth,
                                    pdfHeight,
                                    undefined,
                                    "FAST"
                                );
                                return doc;
                            })
                            .then((docResult) => {
                                docResult.save(`${new Date().toISOString()}_reporte.pdf`);
                            });
                    };
                })
            </script>
        </body>

        </html>


<?php

    }
}
?>