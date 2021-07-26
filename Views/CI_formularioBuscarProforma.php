<?php

class FormularioBuscarProforma
{
    function formularioBuscarProformaShow()
    {
?>
        <div class="row p-4 mb-3" style="border: 1px solid black;">
            <div class="col-6">
                <h4 class="alert alert-primary">N° de Proforma</h4>
                <div class="mb-3 col-12">
                    <label for="name" class="form-label">Código</label>
                    <input name="IdProforma" id="inputContrato" type="text" class="form-control" required />
                </div>
                <div class="mb-3 col-12">
                    <input class="btn btn-primary col-12" type="submit" id="buscarProforma" value="Buscar" name="buscarProforma" class="form-control" required />
                </div>
                <span>Ingresa el código de la proforma para verificar los datos de la proforma.</span>
            </div>

        </div>
<?php
    }
}


?>