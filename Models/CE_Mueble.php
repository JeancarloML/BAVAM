<?php
include_once("Coneccion.php");

class Mueble extends Coneccion
{
    public $precio;
    public $idMueble;
    public $cantidad;
    public $nombre;

    function __construct()
    {
        $this->obtenerConeccion();
    }

    public function obtenerMuebles()
    {
        $sql = "SELECT * FROM muebles";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $muebles = mysqli_fetch_all($resultado, MYSQLI_BOTH);
        $this->desconectar();
        return $muebles;
    }
    public function obtenerMueble($idMueble)
    {
        $sql = "SELECT * FROM muebles where idmuebles=" . $idMueble;
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $mueble = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        return $mueble;
    }
}
