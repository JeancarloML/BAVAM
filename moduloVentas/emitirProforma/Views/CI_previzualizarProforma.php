<?php
include_once("../../../Shared/SideBar.php");
session_start();
class previzualizarProforma
{

    function previzualizarProformaShow($idMueble, $cantidad, $precio, $nombre)
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
                        <form id="form" action="../Controllers/CC_emitirProforma.php" method="post">
                            <h1>Previzualización de Proforma</h1>
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
                                <tbody>
                                    <?php $totalImporte = 0 ?>
                                    <?php for ($i = 0; $i < count($idMueble); $i++) {  ?>
                                        <tr>
                                            <th scope="row"><?php echo $i + 1 ?></th>
                                            <td class="nombre"><?php echo $nombre[$i] ?></td>
                                            <td class="cantidad"><?php echo $cantidad[$i] ?></td>
                                            <td class="precio">S/. <?php echo $precio[$i] ?></td>
                                            <td class="precioTotal">S/. <?php echo $precio[$i] * $cantidad[$i] ?></td>
                                            <input type="hidden" name="idMuebles[]" class="idMueble" value="<?php echo $idMueble[$i] ?>">
                                            <input type="hidden" name="nombres[]" class="nombre" value="<?php echo $nombre[$i] ?>">
                                            <input type="hidden" name="precios[]" class="precios" value="<?php echo $precio[$i] ?>">
                                            <input type="hidden" name="cantidades[]" class="cantidad" value="<?php echo $cantidad[$i] ?>">
                                            <input type="hidden" name="precioTotal[]" class="precioTotal" value="<?php echo $precio[$i] * $cantidad[$i] ?>">
                                            <?php $totalImporte = $totalImporte + ($precio[$i] * $cantidad[$i]) ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <h3>Importe Total = S/. <?php echo $totalImporte ?></h3>
                            <input type="hidden" name="totalImporte" class="totalImporte" value="<?php echo $totalImporte ?>">
                            <div class="d-block">
                                <input class="btn btn-primary w-100" id="emitirProforma" value="Emitir Proforma" name="emitirProforma" type="submit" />
                            </div>
                        </form>
                    </div>
                </div>
                <?php require '../../../Partials/Footer.php' ?>
            </div>
        </body>

        </html>
<?php
    }
}
?>