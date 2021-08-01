<?php
include_once("Coneccion.php");

class Proforma extends Coneccion
{

    function __construct()
    {
        $this->obtenerConeccion();
    }

    public function buscarProforma($idReferencial)
    {
        $sql = "SELECT p.* , m.precio FROM muebleria.proformas as p INNER JOIN muebleria.muebles as m WHERE p.idmuebles= m.idmuebles AND  p.idreferencial='" . $idReferencial . "';";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $proformaItems = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($proformaItems) == 0) {
            return NULL;
        } else {
            return $proformaItems;
        }
    }

    public function
    emitirProformaFinal($idMuebles, $cantidades, $precioTotal, $nombres)
    {
        $idReferencial = uniqid('n_', true);
        for ($i = 0; $i < count($nombres); $i++) {
            $sql = "INSERT INTO proformas (nombre,cantidad,preciototal,idreferencial,idmuebles) VALUES('" . $nombres[$i] . "'," . $cantidades[$i] . "," . $precioTotal[$i] . ",'" . $idReferencial . "'," . $idMuebles[$i] . ");";
            $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        }
        $this->desconectar();
        if (isset($resultado)) {
            return $idReferencial;
        } else {
            return 0;
        }
    }
}
