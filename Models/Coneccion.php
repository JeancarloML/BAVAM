<?php
class Coneccion
{
    protected function obtenerConeccion()
    {
        $server = "localhost";
        $user = "root";
        $pass = "admin";
        $db = "muebleria";
        $con = mysqli_connect($server, $user, $pass, $db);
        return ($con);
    }

    protected function desconectar()
    {
        mysqli_close($this->obtenerConeccion());
    }
}
