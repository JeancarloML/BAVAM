<?php
include_once("../DB/Coneccion.php");

class UsuarioPrivilegio extends Coneccion
{
    function __construct() {
        $this->obtenerConeccion();
    }

    public function  obtenerPrivilegiosUsuario($login)
		{
			$SQL = "SELECT P.label, P.path, P.image, P.name
			        FROM usuarios U, privilegios P, usuarioPrivilegios UP
					WHERE 
							U.login = UP.login AND
							P.id = UP.id       AND
							U.login ='$login'  ORDER BY P.grupo ";
			$result = mysqli_query($this->obtenerConeccion(), $SQL);
			$this -> desconectar();
			$numero_filas = mysqli_num_rows($result);
			for($i = 0; $i < $numero_filas; $i++)
				$privilegio[$i] = mysqli_fetch_array($result);
			return($privilegio);
		}	
  
}
