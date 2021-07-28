<?php

class FormularioBuscarOrdenVenta
{
    function formularioBuscarOrdenVentaShow()
    {
?>
        <div class="row p-4 mb-3" style="border: 1px solid black;">
            <div class="col-6">
                <h4 class="alert alert-primary">N° de Orden de Venta</h4>
                <div class="mb-3 col-12">
                    <label for="name" class="form-label">Código</label>
                    <input name="idOrdenVenta" id="inputOrdenVenta" type="text" class="form-control" required />
                </div>
                <div class="mb-3 col-12">
                    <input class="btn btn-primary col-12" type="submit" id="buscarOrdenVenta" value="Buscar" name="buscarOrdenVenta" class="form-control" required />
                </div>
                <span>Ingresa el código de la orden de venta para verificar los datos de este.</span>
            </div>

        </div>
<?php
    }
}


?>