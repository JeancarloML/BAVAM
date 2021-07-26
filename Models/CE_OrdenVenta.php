<?php
include_once("../DB/Coneccion.php");

class OrdenVenta extends Coneccion
{

    function __construct()
    {
        $this->obtenerConeccion();
    }

    public function crearOrdenVenta(
        $idContrato,
        $idProforma
    ) {
        $idReferencialOrdenVenta = uniqid('n_', true);
        $sql = "INSERT INTO muebleria.ordenventa(`idProforma`,`idContrato`,`idReferencial`) VALUES('" . $idProforma . "','" . $idContrato . "','" . $idReferencialOrdenVenta . "');";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $this->desconectar();
        if ($resultado == 1) {
            return array('idOrdenVenta' => $idReferencialOrdenVenta, 'idContrato' => $idContrato, 'idProforma' => $idProforma);
        } else {
            return NULL;
        }
    }

    function buscarContrato($idReferencial)
    {
        $sql = "SELECT * FROM contratos WHERE idReferencial = '" . $idReferencial . "';";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $contrato = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($contrato) == 0) {
            return NULL;
        } else {
            return $contrato;
        }
    }

    function buscarOrdenVenta($idReferencial)
    {
        $sql = "SELECT * FROM muebleria.ordenventa WHERE idReferencial = '" . $idReferencial . "';";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $ordenventa = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($ordenventa) == 0) {
            return NULL;
        } else {
            return $ordenventa;
        }
    }

    public function obtenerDepartamentos()
    {
        $sql = "SELECT * FROM muebleria.departamentos";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $departamentos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($departamentos) == 0) {
            return NULL;
        } else {
            return $departamentos;
        }
    }
    public function obtenerUbicacion($idDepartamento, $idProvincia, $idDistrito)
    {
        $sql = "SELECT dep.departamento,pro.provincia,dis.distrito FROM muebleria.departamentos AS dep,muebleria.provincia AS pro,muebleria.distrito AS dis WHERE dep.idDepartamento=" . $idDepartamento . " 
        AND pro.idProvincia=" . $idProvincia . " AND dis.idDistrito=" . $idDistrito . ";";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $ubicacion = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($ubicacion) == 0) {
            return NULL;
        } else {
            return $ubicacion;
        }
    }

    public function obtenerProvincias($idDepartamento)
    {
        $sql = "SELECT * FROM muebleria.provincia WHERE idDepartamento=" . $idDepartamento . ";";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $provincias = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($provincias) == 0) {
            return NULL;
        } else {
            return $provincias;
        }
    }
    public function obtenerDistritos($idProvincia)
    {
        $sql = "SELECT * FROM muebleria.distrito WHERE idProvincia=" . $idProvincia . ";";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $distritos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($distritos) == 0) {
            return NULL;
        } else {
            return $distritos;
        }
    }
}
