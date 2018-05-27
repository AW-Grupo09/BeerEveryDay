<?php

include_once('DAO.php');
require_once __DIR__.'/../TO/TOCervezas.php';

class DAOCervezas extends DAO{

    public function __construct() {
       parent::__construct();
    }

    public function loadCerveza($id){
    	$cerveza = new TOCervezas($id);

        $query = "SELECT * FROM cervezas WHERE id = $id ";
        $consulta = $this->ejecutarConsulta($query);

        if (count($consulta) > 0) {
            $cerveza->setNombre($consulta[0]["nombre"]);
            $cerveza->setArtesana($consulta[0]["artesana"]);
            $cerveza->setCapacidad($consulta[0]["capacidad"]);
            $cerveza->setColor($consulta[0]["color"]);
            $cerveza->setFabricante($consulta[0]["fabricante"]);
            $cerveza->setGrado($consulta[0]["grado"]);
            $cerveza->setGrano($consulta[0]["grano"]);
            $cerveza->setImagen($consulta[0]["Imagen"]);
            $cerveza->setPais($consulta[0]["pais"]);
            $cerveza->setPrecio($consulta[0]["precio"]);
            $cerveza->setTipo($consulta[0]["tipo"]);
            $cerveza->setValoracion($consulta[0]["valoracionMedia"]);
            return $cerveza;
        } else{
        	return null;
        }
    }

    public function getIdsCervezas($filtros,$orden){

		if(empty($filtros) && empty($orden))
			$sql = "SELECT id FROM cervezas";
		else
			$sql = "SELECT id FROM cervezas WHERE id > 0 ". $filtros . ' group by id ' . $orden;
		
		$consulta = $this->ejecutarConsulta($sql);

		$resultado = array();
		for($i = 0; $i < count($consulta); $i++ ){
			$resultado[$i] = $consulta[$i]["id"];
		}	
		return $resultado;
	}

 	public function addBeer($imageFileType,  $Artesana, $nombreCerveza, $capacidad, $Color, $Fabricante, $Grado, $grano, $precio, $pais, $Tipo){

        //$sql = sprintf("INSERT INTO cervezas(fabricante, nombre, grado, capacidad, precio, pais, artesana, color, grano, tipo, Imagen, valoracionMedia) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '1')",
        //	$Fabricante, $nombreCerveza, $Grado, $capacidad, $precio, $pais, $Artesana, $Color, $grano, $Tipo, $imageFileType, 1);
        $sql = "INSERT INTO cervezas(fabricante, nombre, grado, capacidad, precio, pais, artesana, color, grano, tipo, Imagen, valoracionMedia) VALUES('" . 
        $this->mysqli->real_escape_string($Fabricante) . "', '" . 
        $this->mysqli->real_escape_string($nombreCerveza) . "', '" . 
        $this->mysqli->real_escape_string($Grado) . "', '" . 
        $this->mysqli->real_escape_string($capacidad) . "', '" .
        $this->mysqli->real_escape_string($precio) . "', '" .
        $this->mysqli->real_escape_string($pais) . "', '" .
        $this->mysqli->real_escape_string($Artesana) . "', '" .
        $this->mysqli->real_escape_string($Color) . "', '" .
        $this->mysqli->real_escape_string($grano) . "', '" .
        $this->mysqli->real_escape_string($Tipo) . "', '" .
        $this->mysqli->real_escape_string($imageFileType) . "', '1')";

        $this->ejecutarModificacion($sql);
 	}

 	public function existeCerveza($nombre)
    {
        $query = "SELECT * FROM cervezas WHERE nombre = '" . $this->mysqli->real_escape_string($nombre) . "'";
        $consulta = $this->ejecutarConsulta($query);
        if (count($consulta) == 0) {
        	echo "esta en false";
            return false;
        } else {
        	echo "esta en true";
            return true;
        }
    }
}

?>