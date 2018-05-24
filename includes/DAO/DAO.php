<?php

require_once __DIR__ . '/../../includes/Aplicacion.php';

class DAO {

    private $mysqli;

 	public function __construct(){
        $app = Aplicacion::getSingleton();
        $this->mysqli = $app->conexionBd();
    }

    public function ejecutarConsulta($sql){
        $app = Aplicacion::getSingleton();
        $this->mysqli = $app->conexionBd();
    	if($sql != ""){
    		$consulta = $this->mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
    		$tablaDatos = array();
    		while ($fila = mysqli_fetch_assoc($consulta)){  
    			array_push($tablaDatos, $fila);
			}
    		return $tablaDatos;
    	} else{
    		return 0;
    	}
    }

    public function ejecutarModificacion($sql){
        $app = Aplicacion::getSingleton();
        $this->mysqli = $app->conexionBd();
    	if($sql != ""){
    		$consulta = $this->mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
    		return $this->mysqli->affected_rows;
    	} else{
    		return 0;
    	}
    }
}

?>