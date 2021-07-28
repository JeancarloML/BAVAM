<?php

class OrdenVentaFinal
{
    function ordenVentaFinalShow($idOrdenVenta, $idContrato, $idProforma)
    {
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Orden de Venta</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <div class="w-100" style="min-height: 90vh;">
                    <div class="container p-5 m-auto">
                        <form id="htmlData" action="../Controllers/CC_emitirContrato.php" method="POST">
                            <h1>Orden de Venta</h1>
                            <h2 class="alert alert-primary"> N° <?php echo $idOrdenVenta ?></h2>
                            <input type="hidden" value="<?php echo $idContrato ?>" name="idContrato" id="idContrato" />
                            <input type="hidden" value="<?php echo $idProforma ?>" name="idProforma" id="idProforma">
                            <div class="row py-4" id="contrato-container"></div>
                        </form>
                        <form class="container" method="POST" action="../Controllers/CC_emitirOrdenVenta.php">
                            <input class="btn btn-primary" aria-current="page" type="submit" value="Volver a Menu Orden de Venta" name="btnEmitirOrdenVenta" id="btnEmitirOrdenVenta">
                        </form>
                    </div>
                </div>
            </div>
            <script src="../../../utils/js/html2canvas.min.js"></script>
            <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
            <script>
                "use strict"
                window.addEventListener("load", () => {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const contratoContainer = document.querySelector("#contrato-container")
                    const idProforma = document.querySelector("#idProforma")
                    const idContrato = document.querySelector("#idContrato")
                    buscarContrato();

                    function buscarContrato() {
                        const formR = new FormData();
                        formR.append("buscarContrato", "buscarContrato");
                        formR.append("idContrato", idContrato.value);
                        fetch("../Controllers/CC_emitirOrdenVenta.php", {
                            method: "POST",
                            body: formR
                        }).then(response => response.text()).then(data => {
                            const div = document.createElement("div");
                            div.innerHTML = data;
                            div.classList.add("col-12")
                            contratoContainer.innerHTML = '';
                            contratoContainer.append(div)
                            generatePdf();
                        })
                    }
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