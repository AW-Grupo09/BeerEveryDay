<?php

require_once __DIR__.'/../DAO/DAOCervezas.php';

class controllerCervezas {

    private static $daoCerveza;

    public static function loadCerveza($id){
    	$daoCerveza = new DAOCervezas();
        return $daoCerveza->loadCerveza($id);
    }

    public static function getCervezas($filtros,$orden){
        $daoCerveza = new DAOCervezas();
        $consulta = $daoCerveza->getIdsCervezas($filtros,$orden);
        $cervezas = array();
        foreach ($consulta as $key) {
            array_push($cervezas, $daoCerveza->loadCerveza($key));
        }
        return $cervezas;
	}

 	public static function addBeer($imageFileType,  $Artesana, $nombreCerveza, $capacidad, $Color, $Fabricante, $Grado, $grano, $precio, $pais, $Tipo){

        $daoCerveza = new DAOCervezas();
        $daoCerveza->addBeer($imageFileType,  $Artesana, $nombreCerveza, $capacidad, $Color, $Fabricante, $Grado, $grano, $precio, $pais, $Tipo);
 	}

 	public static function existeCerveza($nombre)
    {
        $daoCerveza = new DAOCervezas();
        return $daoCerveza->existeCerveza($nombre);
    }
}

?>