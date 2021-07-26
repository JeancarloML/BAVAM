<?php

class ProformaFinal
{
    function proformaFinalShow($idreferencial, $idMueble, $cantidad, $precio, $nombre, $totalImporte)
    {
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Proforma</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />

        </head>

        <body>
            <div class="container mt-5" id="htmlData">
                <h1>N° <?php echo $idreferencial ?></h1>
                <table class="table" id="htmlData">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mueble</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio x unidad</th>
                            <th scope="col">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($idMueble); $i++) {  ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1 ?></th>
                                <td class="nombre"><?php echo $nombre[$i] ?></td>
                                <td class="cantidad"><?php echo $cantidad[$i] ?></td>
                                <td class="precio">S/. <?php echo $precio[$i] ?></td>
                                <td class="precioTotal">S/. <?php echo $precio[$i] * $cantidad[$i] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <h2>Importe total = S/. <?php echo $totalImporte ?></h2>
            </div>
            <form class="container" method="POST" action="../Controllers/CC_emitirProforma.php">
                <input class="btn btn-primary" aria-current="page" type="submit" value="Volver a Menu Emitir Proforma" name="btnEmitirProforma" id="btnEmitProforma">
            </form>
            <script src="../html2canvas.min.js"></script>
            <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

            <script>
                window.addEventListener('load', () => {
                    const {
                        jsPDF
                    } = window.jspdf;
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
                    generatePdf()
                });
            </script>
        </body>

        </html>


<?php

    }
}
?>