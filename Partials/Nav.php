<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <div class="px-2 d-flex align-items-center">
            <img src="../../../utils/img/logo.jpeg" alt="BAVAM" style="width: 60px;" />
            <h2 class="px-4 text-white">BAVAM</h2>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex w-100 align-items-center" style="justify-content: flex-end;">
                <h4 class="text-white px-3">Hola, <?php session_start();
                                                    echo ucfirst($_SESSION['nombre']); ?></h4>
                <form action="../../../moduloSeguridad/autenticarUsuario/Controllers/CC_AutenticarUsuario.php" method="POST">
                    <input class="btn btn-danger" type="submit" name="btnLogout" value="Cerrar Sesión">
                </form>
            </div>
        </div>
    </div>
</nav>