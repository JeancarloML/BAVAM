<?php

include_once("Squeleton.php");
class FormularioMensajeSistema extends Squeleton
{
  public function FormularioMensajeSistema()
  {
    $this->headSqueletonShow("Iberica");
  }
  public  function FormularioMensajeSistemaShow($status, $titulo, $mensaje, $enlace, $btn = 'default')
  {
?>
    <div class="container">
      <div class="card mt-5 m-auto" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4 p-4">
            <?php if ($status == 0) { ?>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9C8XHg9I2Z4Evn4ly4OgjbtO0sm9Z4LJ3bQ&usqp=CAU" class="img-fluid rounded-start" alt="error">
            <?php } else { ?>
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Check_green_icon.svg/1200px-Check_green_icon.svg.png" class="img-fluid rounded-start" alt="error">
            <?php } ?>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h3 class="card-title"><?php echo $titulo; ?></h3>
              <p class="card-text"><?php echo $mensaje; ?></p>
              <p class="card-text"><small class="text-muted">
                  <?php switch ($btn) {
                    case ($btn == "btnEmitProforma"):
                      echo '<form method="POST" action="../Controllers/CC_emitirProforma.php">
                              <input class="mb-2 btn-primary btn w-100" aria-current="page" type="submit" value="Ok" name="btnEmitProforma" id="btnEmitProforma">
                            </form>';
                      break;
                    case ($btn == "btnEmitirContrato"):
                      echo '<form method="POST" action="../Controllers/CC_emitirContrato.php">
                              <input class="mb-2 btn-primary btn w-100" aria-current="page" type="submit" value="Ok" name="btnEmitirContrato" id="btnEmitirContrato">
                            </form>';
                      break;
                    case ($btn == "btnEmitirOrdenVenta"):
                      echo '<form method="POST" action="../Controllers/CC_emitirOrdenVenta.php">
                              <input class="mb-2 btn-primary btn w-100" aria-current="page" type="submit" value="Ok" name="btnEmitirOrdenVenta" id="btnEmitirOrdenVenta">
                            </form>';
                      break;
                    case ($btn == 'default'):
                      echo '<a class="btn btn-primary" href="' . $enlace . '">Volver a Inicio</a>';
                      break;
                  } ?>
                </small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}


?>