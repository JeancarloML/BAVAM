<?php

class Squeleton
{

    protected function headSqueletonShow($titulo)
    {
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $titulo ?></title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />

        </head>

        <body>
            <div class="w-100">
                <div class="w-100 d-flex flex-wrap">
                <?php
            }
            protected function footerSqueletonShow()
            {
                ?>

                </div>
                <footer class="d-flex justify-content-center bg-dark" style="flex-basis: 100%; min-height: 10vh;">
                    <h5 class="align-self-center text-white">UNTELS <?php echo date("Y"); ?></h5>
                </footer>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </body>

        </html>
<?php
            }
        }


?>