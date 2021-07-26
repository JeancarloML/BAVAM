<?php

class FormularioProforma
{
    function formularioProformaShow($muebles)
    {
?>
        <div class="row mb-3" style="border: 1px solid black;">
            <h4 class="alert alert-primary">Mueble</h4>
            <input type="hidden" value="0" class="nombreMueble" name="nombre[]" required>
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Selecciona un Mueble</label>
                <select class="form-select nombre" aria-label="Default select example" name="mueble[]" required>
                    <option selected disabled>Mueble</option>
                    <?php foreach ($muebles as $mueble) : ?>
                        <option value="<?php echo $mueble['idmuebles'] ?>"><?php echo $mueble['nombre'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control cantidad" name="cantidad[]" max="56" required>
            </div>
            <div class="mb-3 col-4">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" readonly class="form-control precio" name="precio[]" required>
            </div>
            <div class="mb-3 col-4">
                <label for="madera" class="form-label">Tipo de Madera</label>
                <input readonly type="text" class="form-control madera" name="madera" required>
            </div>
            <div class="mb-3 col-4">
                <label for="maxcantidad" class="form-label">Max.Disponible</label>
                <input readonly type="text" class="form-control maxcantidad" name="maxcantidad" required>
            </div>
            <div class="mb-3 row">
            <picture class="w-100 d-flex justify-content-around">
                <img src="" alt="" class="img" style="max-width: 300px; display: none; flex-basis: 30%;" />
                <img src="" alt="" class="img2" style="max-width: 300px; display: none; flex-basis: 30%;" />
                <img src="" alt="" class="img3" style="max-width: 300px; display: none; flex-basis: 30%;" />
            </picture>
            </div>
        </div>
<?php
    }
}


?>