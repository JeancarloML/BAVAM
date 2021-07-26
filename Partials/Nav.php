<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand px-5" href="#">IBERICA SA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex w-100 align-items-center" style="justify-content: flex-end;">
                <h4 class="text-white px-3">Hola, <?php session_start();
                                                    echo ucfirst($_SESSION['nombre']); ?></h4>
                <form action="../controllers/CC_AutenticarUsuario.php" method="post">
                    <input class="btn btn-danger" type="submit" name="btnLogout" value="Cerrar Sesión">
                </form>
            </div>
        </div>
    </div>
</nav>