<?php
include_once("../DB/Coneccion.php");

class Usuario extends Coneccion
{
    function __construct()
    {
        $this->obtenerConeccion();
    }

    public function login($login, $password)
    {
        $sql = "SELECT nombre FROM usuarios WHERE login = '$login' AND password = '$password' AND estado = 1 ";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $res = mysqli_fetch_row($resultado);
        $_SESSION['nombre'] = $res[0];
        $numero_filas_encontradas = mysqli_num_rows($resultado);
        $this->desconectar();
        if ($numero_filas_encontradas === 1)
            return (1);
        else
            return (0);
    }
}
