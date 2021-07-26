<?php
class PrevizualizarProformaContrato
{

    function previzualizarProformaContratoShow($proforma)
    {
?>
        <h1>Lista de Muebles</h1>
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
                <?php for ($i = 0; $i < count($proforma); $i++) {  ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1 ?></th>
                        <td class="nombre"><?php echo $proforma[$i]["nombre"] ?></td>
                        <td class="cantidad"><?php echo $proforma[$i]["cantidad"]  ?></td>
                        <td class="precio">S/. <?php echo $proforma[$i]["precio"]  ?></td>
                        <td class="precioTotal">S/. <?php echo $proforma[$i]["preciototal"]  ?></td>
                        <?php $totalImporte = $totalImporte + $proforma[$i]["preciototal"] ?>
                    <?php } ?>
            </tbody>
        </table>
        <h2 class="py-3">Total = S/. <?php echo $totalImporte ?></h2>
<?php
    }
}
?>