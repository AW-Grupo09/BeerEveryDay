<?php

require_once __DIR__ . '/../includes/Aplicacion.php';
include('includes/comentarios.php');

class controlComentarios {

    public static function cargarComentario($idComentario){

    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT * FROM `comentarios-cervezas` WHERE idComentario = '$idComentario'";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

        if (mysqli_num_rows($resultado) > 0) {
            $fila = $resultado->fetch_assoc();
            $comentario = new comentarios($idComentario, $fila["valoracion"], $fila["comentario"], $fila["idCerveza"], 
            	$fila["idUsuario"]);
            return $comentario;
        } else{
        	return null;
        }
    }

    public static function cargarComentariosCerveza($idCerveza){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idCerveza = '" . $idCerveza . "'";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

        $comentarios = array();
        if (mysqli_num_rows($consulta) != 0){

            while($fila = mysqli_fetch_assoc($consulta) ){
                array_push( $comentarios, controlComentarios::cargarComentario($fila["idComentario"]));
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }

    public static function cargarComentariosUsuario($idUsuario){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idUsuario = '" . $idUsuario . "'";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

        $comentarios = array();
        if (mysqli_num_rows($consulta) != 0){

            while($fila = mysqli_fetch_assoc($consulta) ){
                array_push( $comentarios, controlComentarios::cargarComentario($fila["idComentario"]));
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }

    public static function insertarComentario($valoracion, $comentario, $idCerveza, $idUsuario){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
    	$query = 'INSERT INTO `comentarios-cervezas`(valoracion, comentario, idCerveza, idUsuario) VALUES (' . $valoracion . ', "' . 
    		$comentario . '", "' . $idCerveza . '", "' . $idUsuario . '")';
    	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
    	//return controlComentarios::cargarComentario($mysqli->insert_id);
    }

    public static function eliminarComentario($idComentario){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
    	$query = 'DELETE FROM `comentarios-cervezas` WHERE idComentario = "' . $idComentario . '"';
    	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

    	if($mysqli->affected_rows == 0){
    		echo "Error al eliminar comentario";
    	}
    }

    public static function modificarComentario($idComentario, $valoracion, $comentario){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
    	$query = 'UPDATE `comentarios-cervezas` SET valoracion = ' . $valoracion . ', comentario = "' . $comentario . '" WHERE idComentario = "' . $idComentario . '"';
    	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

    	if($mysqli->affected_rows == 0){
    		echo "Error al modificar el comentario";
    	}
    }

    public static function valoracionMedia($idCerveza){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
    	$query = 'SELECT sum(valoracion)/count(valoracion) as valoracionMedia FROM `comentarios-cervezas` WHERE idCerveza = ' . $idCerveza . ' group by idCerveza';
    	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

    	if (mysqli_num_rows($resultado) > 0) {
            $fila = $resultado->fetch_assoc();
            $valoracion = $fila["valoracionMedia"];
            $valoracion = round($valoracion, 2);
            return $valoracion;
        } else{
        	return 0;
        }
    }

}

?>