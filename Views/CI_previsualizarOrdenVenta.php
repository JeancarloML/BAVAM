<?php
class PrevisualizarOrdenVenta
{

    function previsualizarOrdenVentaShow($contrato, $proforma, $idOrdenVenta)
    {
?>
        <div class="w-100">
            <div class="container">
                <h1>Datos de Orden De Venta</h1>
                <input type="hidden" id="idContrato" class="form-control" value="<?php echo $contrato[0]['idReferencial'] ?>" name="idContrato" />
                <input type="hidden" id="idProforma" class="form-control" value="<?php echo $proforma[0]["idreferencial"] ?>" name="idProforma" />
                <div class="row mb-3" style="border: 1px solid black;">
                    <h4 class="alert alert-primary">Datos de Cliente</h4>
                    <input type="hidden" name="idOrdenVenta" value="<?php echo $idOrdenVenta; ?>">
                    <div class="mb-3 col-12">
                        <label for="cantidad" class="form-label">N° Proforma</label>
                        <input readonly type="text" id="idProforma" class="form-control" value="<?php echo $contrato[0]['idProforma'] ?>" name="idProforma" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input readonly type="text" class="form-control" name="nombres" value="<?php echo $contrato[0]['nombres'] ?>" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="apellidoP" class="form-label">Apellido Paterno</label>
                        <input readonly type="text" class="form-control" name="apellidoP" value="<?php echo $contrato[0]['apellidoP'] ?>" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="apellidoM" class="form-label">Apellido Materno</label>
                        <input readonly type="text" class="form-control" name="apellidoM" value="<?php echo $contrato[0]['apellidoM'] ?>" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="celular" class="form-label">Celular</label>
                        <input readonly type="number" class="form-control" name="celular" value="<?php echo $contrato[0]['celular'] ?>" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="dni" class="form-label">DNI</label>
                        <input readonly type="number" class="form-control" name="dni" value="<?php echo $contrato[0]['dni'] ?>" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input readonly type="email" class="form-control" name="correo" value="<?php echo $contrato[0]['correo'] ?>" />
                    </div>
                </div>
                <div class="row mb-3" style="border: 1px solid black;">
                    <h4 class="alert alert-primary">Datos de Domicilio</h4>
                    <div class="mb-3 col-4">
                        <label for="departamento" class="form-label">Departamento</label>
                        <input readonly type="text" class="form-control" name="departamento" value="<?php echo $contrato[0]['departamento'] ?>" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="provincia" class="form-label">Provincia</label>
                        <input readonly type="text" class="form-control" name="provincia" value="<?php echo $contrato[0]['provincia'] ?>" />
                    </div>
                    <div class="mb-3 col-4">
                        <label for="distrito" class="form-label">Distrito</label>
                        <input readonly type="text" class="form-control" name="distrito" value="<?php echo $contrato[0]['distrito'] ?>" />
                    </div>
                    <div class="mb-3 col-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input readonly type="text" class="form-control" name="direccion" value="<?php echo  $contrato[0]['direccion']  ?>" />
                    </div>
                    <div class="mb-3 col-6">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input readonly type="text" class="form-control" name="referencia" value="<?php echo  $contrato[0]['referencia']  ?>" />
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

                <h2>Importe Total = S/. <?php echo $totalImporte ?></h2>
                <input type="hidden" name="totalImporte" class="totalImporte" value="<?php echo $totalImporte ?>">
            </div>
        </div>
<?php
    }
}
?>