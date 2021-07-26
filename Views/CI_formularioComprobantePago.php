<?php
class formularioComprobantePago
{

    function formularioComprobantePagoShow($comprobantes, $idOrdenVenta)
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
            <title>Emitir Comprobante</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 90vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 80%;">
                        <form id="form" action="../Controllers/CC_emitirComprobantePago.php" method="post">
                            <h1 class="py-3">Tipo de Comprobante</h1>
                            <input type="hidden" name="idOrdenVenta" value="<?php echo $idOrdenVenta; ?>">
                            <div class="row mb-3" style="border: 1px solid black;">
                                <h4 class="alert alert-primary">Datos de Comprobante de Pago</h4>
                                <div class="mb-3 col-4">
                                    <label for="departamento" class="form-label">Tipo de Comprobante</label>
                                    <select class="form-select nombre" aria-label="Default select example" id="comprobante" name="comprobante" required>
                                        <option selected disabled>Seleccione Comprobante</option>
                                        <?php foreach ($comprobantes as $comprobante) : ?>
                                            <option value="<?php echo $comprobante['idDocumento'] ?>"><?php echo $comprobante['documento'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="documento" class="form-label">Documento</label>
                                    <input type="text" class="form-control" id="documento" name="documento" required>
                                </div>

                            </div>
                            <div class="mb-3 col-12">
                                <input type="submit" class="btn btn-primary w-100" value="Continuar" name="tipoComprobantePago" id="emitirComprobantePago" />
                            </div>
                            <!-- </form>
                            <div class="d-block">
                                <input class="btn btn-primary w-100" id="emitirProforma" value="Emitir Proforma" name="emitirProforma" type="submit" />
                            </div>
                        </form> -->
                    </div>
                </div>
                <?php require '../Partials/Footer.php' ?>
            </div>
            <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
            <script type="text/javascript">
                window.addEventListener("load", () => {
                    $('#comprobante').change(function() {
                        $('#documento').val('')
                        if ($(this).val() == 3) {
                            $('#documento').prop('placeholder', 'Ingresa tu DNI');
                            $('#documento').attr('maxlength', '8');
                        }

                        if ($(this).val() == 4) {
                            $('#documento').prop('placeholder', 'Ingresa tu RUC');
                            $('#documento').attr('maxlength', '11');
                        }
                    });
                });
            </script>
        </body>

        </html>
<?php
    }
}
?>