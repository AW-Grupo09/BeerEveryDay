<?php

include_once('DAO.php');
require_once __DIR__.'/../TO/TOComentarios.php';

class DAOComentarios extends DAO{


    public function cargarValoracion($idComentario){

        $query = "SELECT * FROM `comentarios-cervezas` WHERE idComentario = '".$idComentario."'";
        $resultado = $this->ejecutarConsulta($query);
        if (count($resultado) > 0) {
            $date = date_create($resultado[0]["fecha"]);
            $date = date_format($date, 'Y/m/d H:i:s');
            $comentario = new TOComentarios($idComentario,  $resultado[0]["valoracion"], $resultado[0]["comentario"] ,$resultado[0]["idCerveza"] , $resultado[0]["idUsuario"], NULL, $date);
            return $comentario;
        } else{
        	return NULL;
        }
    }

    public function cargarComentario($idComentario){

        $query = "SELECT * FROM `comentarios-grupos` WHERE idComentario = '".$idComentario."'";
        $resultado = $this->ejecutarConsulta($query);
        if (count($resultado) > 0) {
            $date = date_create($resultado[0]["fecha"]);
            $date = date_format($date, 'Y/m/d H:i:s');
            $comentario = new TOcomentarios($idComentario,  1, $resultado[0]["comentario"] ,NULL , $resultado[0]["idUsuario"], $resultado[0]['idGrupo'], $date);
            return $comentario;
        } else{
            return null;
        }
    }

    public function cargarValoraciones($idCerveza){

        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idCerveza = '" . $idCerveza . "' ORDER BY fecha";
        $resultado = $this->ejecutarConsulta($query);

        $comentarios = array();
        if (count($resultado) != 0){

            foreach ($resultado as $fila) {
                array_push($comentarios,  $fila["idComentario"]);
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }


    public function cargarComentariosGrupos($idGrupo){

        $query = "SELECT idComentario FROM `comentarios-grupos` WHERE idGrupo = '" . $idGrupo . "' ORDER BY fecha DESC";
        $resultado = $this->ejecutarConsulta($query);

        $comentarios = array();
        if (count($resultado) != 0){

            foreach ($resultado as $fila) {
                array_push($comentarios,  $fila["idComentario"]);
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }
    

    public function insertarValoracion($valoracion, $comentario, $idCerveza, $idUsuario){
        $sql = "SELECT max(idComentario) as idComentario FROM `comentarios-cervezas`";
        $consulta = $this->ejecutarConsulta($sql);
        if(count($consulta) > 0){
            $idComentario = $consulta[0]['idComentario'] + 1;
            $query = 'INSERT INTO `comentarios-cervezas`(idComentario, valoracion, comentario, idCerveza, idUsuario, fecha) VALUES ("'.$idComentario . '","'. $valoracion . '", "' .  $this->mysqli->real_escape_string($comentario) . '", "' . $idCerveza . '", "' . $this->mysqli->real_escape_string($idUsuario) . '", now())';
            $this->ejecutarModificacion($query);
        }
    }

    public function insertarComentarioGrupo($comentario, $idGrupo, $idUsuario){


        $sql = "SELECT max(idComentario) as idComentario FROM `comentarios-grupos`";
        $resultado = $this->ejecutarConsulta($sql);
        if(count($resultado) > 0){
            $newID = $resultado[0]['idComentario'] + 1;
            $query = 'INSERT INTO `comentarios-grupos`(idComentario, comentario, idGrupo, idUsuario, fecha) VALUES ("'.$newID . '","' . $this->mysqli->real_escape_string($comentario) . '", "' . $idGrupo . '", "' . $this->mysqli->real_escape_string($idUsuario) . '", now())';
            $this->ejecutarModificacion($query);
        }
    }

    public function eliminarValoracion($idComentario){
    	$query = 'DELETE FROM `comentarios-cervezas` WHERE idComentario = "' . $idComentario . '"';
    	$resultado = $this->ejecutarModificacion($query);

    	if($resultado == 0){
    		return "Error al eliminar comentario";
    	}
    }

    public function updateValoracionMedia($idCerveza){
    	$query = 'SELECT sum(valoracion)/count(valoracion) as valoracionMedia FROM `comentarios-cervezas` WHERE idCerveza = ' . $idCerveza . ' group by idCerveza';
    	$resultado = $this->ejecutarConsulta($query);

    	if (count($resultado) > 0) {
            $fila = $resultado[0];
            $valoracion = $fila["valoracionMedia"];
            $valoracion = round($valoracion);
            //echo $valoracion;
            $sql = "UPDATE `cervezas` SET valoracionMedia = " . $valoracion . " WHERE id = " . $idCerveza;
            $this->ejecutarModificacion($sql);
            return $valoracion;
        } else{
        	return 0;
        }
    }

    public function existeVal($idCerveza, $idUsuario){

        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idUsuario = '" . $this->mysqli->real_escape_string($idUsuario) . "' AND idCerveza = '" . $idCerveza . "'";
        $resultado = $this->ejecutarConsulta($query);
        if(count($resultado) == 0)
            return false;
        else 
            return true;
    }

}


//////////////////////////////////CAJON DE LAS FUNCIONES OLVIDADAS///////////////////////////////////////////////////////
/*
    public static function cargarComentariosUsuario($idUsuario){
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idUsuario = '" . $idUsuario . "'";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

        $comentarios = array();
        if (mysqli_num_rows($consulta) != 0){

            while($fila = mysqli_fetch_assoc($consulta) ){
                array_push( $comentarios, controllerComentarios::cargarComentario($fila["idComentario"]));
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }
*/
/*
    public static function modificarComentario($idComentario, $valoracion, $comentario){
        //No se usa de momento
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = 'UPDATE `comentarios-cervezas` SET valoracion = ' . $valoracion . ', comentario = "' . $comentario . '" WHERE idComentario = "' . $idComentario . '"';
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

        if($mysqli->affected_rows == 0){
            echo "Error al modificar el comentario";
        }
    }
*/


?>