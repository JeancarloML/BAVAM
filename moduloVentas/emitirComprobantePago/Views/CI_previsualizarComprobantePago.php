<?php
include_once("../../../Shared/SideBar.php");
session_start();

class PrevisualizarComprobantePago
{

    function previsualizarComprobantePagoShow($comprobante, $contratoItems, $proformaItems, $idReferencial)
    {
        $listaPrivilegios = $_SESSION['privilegios'];
        $sidebar = new SideBar;
        if (isset($comprobante)) {
            if ($comprobante == 3) {
                $labelComprobante = 'Boleta de Venta';
            }
            if ($comprobante == 4) {
                $labelComprobante = 'Factura';
            }
        }
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Emitir Comprobante</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../../../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 90vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?> <form id="form" action="../Controllers/CC_emitirComprobantePago.php" method="post">
                        <form id="form" action="../Controllers/emitirComprobantePagoFinal.php" method="post">
                            <div id="htmlData" class="form-container p-5" style="flex-basis: 80%;">
                                <div id="title-form-container" class="row">
                                    <h1 id="title-form">Emitir Comprobante de Pago</h1>
                                </div>
                                <div class="row mb-3" style="border: 1px solid black;">
                                    <h4 class="alert alert-primary">Datos de <?php echo $labelComprobante ?></h4>
                                    <input type="hidden" id="idContrato" name="idContrato" value="<?php echo $contratoItems[0]['idReferencial']; ?>">
                                    <input type="hidden" id="idProforma" name="idProforma" value="<?php echo $proformaItems[0]['idreferencial']; ?>">
                                    <input type="hidden" id="idComprobante" name="idComprobante" value="<?php echo $comprobante; ?>">
                                    <input type="hidden" id="idOrdenVenta" name="idOrdenVenta" value="<?php echo $idReferencial; ?>">
                                    <div class="mb-3 col-4">
                                        <label for="nombre" class="form-label">Nombres</label>
                                        <input readonly type="text" class="form-control" name="nombres" value="<?php echo $contratoItems[0]['nombres'] ?>" />
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                        <input readonly type="text" class="form-control" name="apellidoP" value="<?php echo $contratoItems[0]['apellidoP'] ?>" />
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="apellidoM" class="form-label">Apellido Materno</label>
                                        <input readonly type="text" class="form-control" name="apellidoM" value="<?php echo $contratoItems[0]['apellidoM'] ?>" />
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input readonly type="text" class="form-control" name="direccion" value="<?php echo  $contratoItems[0]['direccion']  ?>" />
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="f_emision" class="form-label">Fecha de Emisión</label>
                                        <input readonly type="text" class="form-control" name="f_emision" value="26/07/2021" />
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="dni" class="form-label">Documento de Identidad</label>
                                        <input readonly type="number" class="form-control" name="dni" value="<?php echo $contratoItems[0]['dni'] ?>" />
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Mueble</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio x unidad</th>
                                            <th scope="col">Precio Total</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php $totalImporte = 0 ?>
                                        <?php for ($i = 0; $i < count($proformaItems); $i++) {  ?>
                                            <tr>
                                                <th scope="row"><?php echo $i + 1 ?></th>
                                                <td class="nombre"><?php echo $proformaItems[$i]["nombre"] ?></td>
                                                <td class="cantidad"><?php echo $proformaItems[$i]["cantidad"]  ?></td>
                                                <td class="precio">S/. <?php echo $proformaItems[$i]["precio"]  ?></td>
                                                <td class="precioTotal">S/. <?php echo $proformaItems[$i]["preciototal"]  ?></td>
                                                <?php $totalImporte = $totalImporte + $proformaItems[$i]["preciototal"];
                                                $subTotal = round($totalImporte / 1.18, 2);
                                                $igv = $totalImporte - $subTotal; ?>
                                            <?php } ?>
                                    </tbody>
                                </table>
                                <?php
                                if ($comprobante == 4) {
                                ?>
                                    <h4 class="py-2">Sub Total = S/. <?php echo $subTotal ?></h4>
                                    <h4 class="py-2">I.G.V. (18%) = S/. <?php echo $igv ?></h4>
                                <?php
                                }
                                ?>
                                <h3 class="">Importe Total = S/. <?php echo $totalImporte ?></h3>
                                <input type="hidden" name="totalImporte" class="totalImporte" value="<?php echo $totalImporte ?>">
                            </div>
                            <div class="d-block pb-5 text-center">
                                <input class="btn btn-primary m-auto" id="emitirProforma" value="Emitir <?php echo $labelComprobante; ?>" name="emitirComprobantePago" type="submit" />
                            </div>
                        </form>
                </div>
                <?php require '../../../Partials/Footer.php' ?>
            </div>
        </body>
        <script src="../../../utils/js/html2canvas.min.js"></script>
        <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
        <script>
            "use strict"
            window.addEventListener("load", () => {
                const {
                    jsPDF
                } = window.jspdf;
                const form = document.querySelector("#form")
                const titleForm = document.querySelector("#title-form")
                const idContrato = document.querySelector("#idContrato")
                const idProforma = document.querySelector("#idProforma")
                const idOrdenVenta = document.querySelector("#idOrdenVenta")
                const idComprobante = document.querySelector("#idComprobante")
                const titleContainer = document.querySelector("#title-form-container")
                form.addEventListener("submit", (e) => {
                    e.preventDefault();
                    const formR = new FormData();
                    formR.append("emitirComprobantePago", "emitirComprobantePago");
                    formR.append("idContrato", idContrato.value);
                    formR.append("idProforma", idProforma.value);
                    formR.append("idOrdenVenta", idOrdenVenta.value);
                    formR.append("idComprobante", idComprobante.value);
                    fetch("../Controllers/emitirComprobantePagoFinal.php", {
                        method: "POST",
                        body: formR
                    }).then(response => response.json()).then(data => {
                        if (data.ok) {
                            const p = document.createElement("h2");
                            p.classList.add("alert")
                            p.classList.add("alert-primary")
                            p.innerHTML = `N° ${data.idComprobantePago}`
                            titleForm.innerHTML = `Comprobante de Pago`
                            titleContainer.children.length == 2 ? null : titleContainer.appendChild(p);
                            generatePdf()
                        }
                    })
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

        </html>
<?php
    }
}
?>