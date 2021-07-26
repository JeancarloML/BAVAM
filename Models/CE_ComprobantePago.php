<?php
include_once("../DB/Coneccion.php");

class ComprobantePago extends Coneccion
{

    function __construct()
    {
        $this->obtenerConeccion();
    }

    public function crearComprobantePago(
        $idOrdenVenta,
        $comprobante,
        $idProforma,
        $idContrato
    ) {
        $idReferencialComprobantePago = uniqid('n_', true);
        $sql = "INSERT INTO comprobantes(`idProforma`,`idContrato`,`idReferencial`, `tipoComprobante`, `idOrdenVenta`) VALUES('" . $idProforma . "','" . $idContrato . "','" . $idReferencialComprobantePago . "','" . $comprobante . "','" . $idOrdenVenta . "');";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $this->desconectar();
        if ($resultado == 1) {
            return array("ok" => true, "mensaje" => "Comprobante Pago creado con exito", "idComprobantePago" => $idReferencialComprobantePago);
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
        $sql = "SELECT * FROM ordenventa WHERE idReferencial = '" . $idReferencial . "';";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $contrato = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($contrato) == 0) {
            return NULL;
        } else {
            return $contrato;
        }
    }

    public function obtenerTiposComprobantes()
    {
        $sql = "SELECT * FROM muebleria.documentos WHERE grupo = 'comprobante' AND estado = '1'";
        $resultado = mysqli_query($this->obtenerConeccion(), $sql);
        $comprobantes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        $this->desconectar();
        if (sizeof($comprobantes) == 0) {
            return NULL;
        } else {
            return $comprobantes;
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
