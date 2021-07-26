<?php
include_once("../Shared/SideBar.php");
session_start();
class FormularioContrato
{

    function formularioContratoShow($idreferencial, $departamentos)
    {
        $listaPrivilegios = $_SESSION['privilegios'];
        $sidebar = new SideBar;
        // $sidebar->SideBarShow($listaPrivilegios);
?>
        <!DOCTYPE html>
        <html lang="es-PE">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Formulario Emitir Contrato</title>
            <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" type="text/css" rel="stylesheet" />
        </head>

        <body>
            <div class="" style="min-height: 100vh;">
                <?php require '../Partials/Nav.php' ?>
                <div class="d-flex w-100" style="min-height: 90vh;">
                <?php $sidebar->SideBarShow($listaPrivilegios); ?>
                    <div class="form-container p-5" style="flex-basis: 80%;">
                        <form id="form" action="../Controllers/CC_emitirContrato.php" method="POST">
                            <h1>Formulario para Emitir Contratos</h1>
                            <div class="row mb-3" style="border: 1px solid black;">
                                <h4 class="alert alert-primary">Contrato</h4>
                                <div class="mb-3 col-12">
                                    <label for="cantidad" class="form-label">N° Proforma</label>
                                    <input readonly type="text" class="form-control cantidad" value="<?php echo $idreferencial ?>" name="idReferencial" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="nombre" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" name="nombres" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" name="apellidoP" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="apellidoM" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" name="apellidoM" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="number" class="form-control" name="celular" required min="900000000" max="1000000000">
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="number" class="form-control" name="dni" required min="100000" max="100000000">
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="correo" required>
                                </div>
                            </div>
                            <div class="row mb-3" style="border: 1px solid black;">
                                <h4 class="alert alert-primary">Datos de Domicilio</h4>
                                <div class="mb-3 col-4">
                                    <label for="departamento" class="form-label">Departamento</label>
                                    <select class="form-select nombre" aria-label="Default select example" id="departamento" name="departamento" required>
                                        <option selected disabled>Departamento</option>
                                        <?php foreach ($departamentos as $departamento) : ?>
                                            <option value="<?php echo $departamento['idDepartamento'] ?>"><?php echo $departamento['departamento'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="provincia" class="form-label">Provincia</label>
                                    <select class="form-select nombre" aria-label="Default select example" id="provincia" name="provincia" required>
                                        <option selected disabled>Provincia</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="distrito" class="form-label">Distrito</label>
                                    <select class="form-select nombre" aria-label="Default select example" id="distrito" name="distrito" required>
                                        <option selected disabled>Distrito</option>
                                        <?php foreach ($muebles as $mueble) : ?>
                                            <option value="<?php echo $mueble['idmuebles'] ?>"><?php echo $mueble['nombre'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" name="direccion" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="referencia" class="form-label">Referencia</label>
                                    <input type="text" class="form-control" name="referencia" required>
                                </div>
                                <div class="mb-3 col-12">
                                    <input type="submit" class="btn btn-primary w-100" value="Previzualizar Contrato" name="previzualizarContrato" id="previzualizarContrato" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php require '../Partials/Footer.php' ?>
            </div>
            <script>
                window.addEventListener("load", () => {
                    const provinciaRef = document.querySelector('#provincia');
                    const departamentoRef = document.querySelector('#departamento');
                    const distritoRef = document.querySelector('#distrito');
                    departamentoRef.addEventListener("change", (e) => {
                        const formData = new FormData()
                        formData.append("mostrarProvincias", "mostrarProvincias")
                        formData.append("idDepartamento", e.target.value)
                        fetch("../Controllers/CC_emitirContrato.php", {
                            method: "POST",
                            body: formData
                        }).then(res => res.json()).then(provincias => {
                            provincias.forEach(provincia => {
                                const option = document.createElement("option");
                                option.value = provincia.idProvincia;
                                option.innerHTML = provincia.provincia;
                                provinciaRef.appendChild(option);
                            });
                        })
                    })
                    provinciaRef.addEventListener("change", (e) => {
                        const formData = new FormData()
                        formData.append("mostrarDistritos", "mostrarDistritos")
                        formData.append("idProvincia", e.target.value)
                        fetch("../Controllers/CC_emitirContrato.php", {
                            method: "POST",
                            body: formData
                        }).then(res => res.json()).then(distritos => {
                            distritos.forEach(distrito => {
                                const option = document.createElement("option");
                                option.value = distrito.idDistrito;
                                option.innerHTML = distrito.distrito;
                                distritoRef.appendChild(option);
                            });
                        })
                    })
                })
            </script>
        </body>

        </html>
<?php
    }
}
?>