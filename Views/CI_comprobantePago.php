<?php

class ComprobantePagoFinal
{
    function comprobantePagoFinalShow($comprobante, $contratoItems, $proformaItems, $idReferencial)
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
    <title>Comprobante de Pago</title>
    <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />

</head>

<body>
    <div class="" style="min-height: 100vh;">
        <div class="w-100" style="min-height: 90vh;">
            <div class="container p-5 m-auto">
                <form id="htmlData" action="../Controllers/CC_emitirContrato.php" method="POST">
                    <h1>Comprobante de Pago N° <?php echo $idReferencial ?></h1>
                    <div class="row mb-3" style="border: 1px solid black;">
                        <h4 class="alert alert-primary">Datos de <?php echo $labelComprobante?></h4>

                        <div class="mb-3 col-4">
                            <label for="nombre" class="form-label">Nombres</label>
                            <input readonly type="text" class="form-control" name="nombres"
                                value="<?php echo $contratoItems[0]['nombres'] ?>" />
                        </div>
                        <div class="mb-3 col-4">
                            <label for="apellidoP" class="form-label">Apellido Paterno</label>
                            <input readonly type="text" class="form-control" name="apellidoP"
                                value="<?php echo $contratoItems[0]['apellidoP'] ?>" />
                        </div>
                        <div class="mb-3 col-4">
                            <label for="apellidoM" class="form-label">Apellido Materno</label>
                            <input readonly type="text" class="form-control" name="apellidoM"
                                value="<?php echo $contratoItems[0]['apellidoM'] ?>" />
                        </div>
                        <div class="mb-3 col-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input readonly type="text" class="form-control" name="direccion"
                                value="<?php echo  $contratoItems[0]['direccion']  ?>" />
                        </div>
                        <div class="mb-3 col-4">
                            <label for="f_emision" class="form-label">Fecha de Emisión</label>
                            <input readonly type="text" class="form-control" name="f_emision" value="26/07/2021" />
                        </div>
                        <div class="mb-3 col-6">
                            <label for="dni" class="form-label">Documento de Identidad</label>
                            <input readonly type="number" class="form-control" name="dni"
                                value="<?php echo $contratoItems[0]['dni'] ?>" />
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
                                                $igv = $totalImporte - $subTotal;?>
                                <?php } ?>
                        </tbody>
                    </table>
                </form>
                <form class="container" method="POST" action="../Controllers/CC_emitirContrato.php">
                    <input class="btn btn-primary" aria-current="page" type="submit"
                        value="Volver a Menu Emitir Contrato" name="btnEmitirContrato" id="btnEmitirContrato">
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