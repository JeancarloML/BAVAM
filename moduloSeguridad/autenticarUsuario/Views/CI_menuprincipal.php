<?php
include_once("../../../Shared/SideBar.php");
session_start();

class formMenuPrincipal
{
    function formMenuPrincipalShow()
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
            <title>Emitir Proforma</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../../../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 85vh;">
                    <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 85%;">
                        <h1>Bienvenido(a): <?php echo ucfirst($_SESSION['nombre']); ?></h1>
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