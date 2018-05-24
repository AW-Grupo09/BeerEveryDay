<?php

require_once __DIR__ . '/../Aplicacion.php';
require_once __DIR__ . '/../comentarios.php';


class controllerComentarios {


    public static function cargarValoracion($idComentario){

    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT * FROM `comentarios-cervezas` WHERE idComentario = '".$idComentario."'";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $date = date_create($fila["fecha"]);
            $date = date_format($date, 'Y/m/d H:i:s');
            $comentario = new comentarios($idComentario,  $fila["valoracion"], $fila["comentario"] ,$fila["idCerveza"] , $fila["idUsuario"], NULL, $date);
            return $comentario;
        } else{
        	return null;
        }
    }

    public static function cargarComentario($idComentario){

        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT * FROM `comentarios-grupos` WHERE idComentario = '".$idComentario."'";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $date = date_create($fila["fecha"]);
            $date = date_format($date, 'Y/m/d H:i:s');
            $comentario = new comentarios($idComentario,  1, $fila["comentario"] ,$fila["idCerveza"] , $fila["idUsuario"], $fila['idGrupo'], $date);
            return $comentario;
        } else{
            return null;
        }
    }

    public static function cargarValoraciones($idCerveza){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idCerveza = '" . $idCerveza . "' ORDER BY fecha";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

        $comentarios = array();
        if (mysqli_num_rows($resultado) != 0){

            while($fila = mysqli_fetch_assoc($resultado) ){
                $comentarios[] =  $fila["idComentario"];
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }


    public static function cargarComentariosGrupos($idGrupo){
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idGrupo = '" . $idGrupo . "' ORDER BY fecha";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

        $comentarios = array();
        if (mysqli_num_rows($consulta) != 0){

            while($fila = mysqli_fetch_assoc($consulta) ){
                $comentarios[] =  $fila["idComentario"];
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }

    public static function mostrarComentariosGrupo($idGrupo){

        $idsComentarios = controllerComentarios::cargarComentariosGrupos($idGrupo);
        foreach($idsComentarios as $idComentario){
            $comentario = controllerComentarios::cargarComentario($idComentario);
            echo "<p id = 'autorComent'>" . $comentario->getidUsuario(). "</p>";
            echo "<p id = 'dateComent'> Fecha:" . $comentario->getFecha(). "</p>";
            echo "<p id = 'coment'>" . $comentario->getComentario(). "</p>";                    
        }
    }

    public static function mostrarValoracionesCerveza($idCerveza){

        $idsComentarios = controllerComentarios::cargarValoraciones($idCerveza);
        foreach($idsComentarios as $idComentario){
            $comentario = controllerComentarios::cargarValoracion($idComentario);
            echo "<p id = 'autorComent'>" . $comentario->getidUsuario(). "</p>";
            echo "<p id = 'dateComent'> Fecha:" . $comentario->getFecha(). "</p>";
            echo "<p id = 'val'>" . $comentario->getValoracion(). "/5</p>";
            echo "<p id = 'coment'>" . $comentario->getComentario(). "</p>";

            if(isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] == $comentario->getIdUsuario())
                echo '<input type="button" id="myBtn" onclick="deleteVal('.$idComentario.')" value="Eliminar valoración">';             
            
        }

    }

    

    public static function insertarValoracion($valoracion, $comentario, $idCerveza, $idUsuario){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $sql = "SELECT max(idComentario) as idComentario FROM `comentarios-cervezas`";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $resultado = mysqli_fetch_assoc($consulta);
        $idComentario = $resultado['idComentario'] + 1;
    	$query = 'INSERT INTO `comentarios-cervezas`(idComentario, valoracion, comentario, idCerveza, idUsuario, fecha) VALUES ("'.$idComentario . '","'. $valoracion . '", "' .  $comentario . '", "' . $idCerveza . '", "' . $idUsuario . '", now())';
    	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
    	//return controllerComentarios::cargarComentario($mysqli->insert_id);
    }

    public static function insertarComentarioGrupo($comentario, $idGrupo, $idUsuario){
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $sql = "SELECT max(idComentario) FROM comentarios-grupos";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $resultado = mysqli_fetch_assoc($consulta);
        $idComentario = $resultado['idComentario'] + 1;
        $query = 'INSERT INTO `comentarios-grupos`(idComentario, comentario, idGrupo, idUsuario, fecha) VALUES ("'.$idComentario . '","' . $comentario . '", "' . $idGrupo . '", "' . $idUsuario . '", now())';
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        //return controllerComentarios::cargarComentario($mysqli->insert_id);
    }

    public static function eliminarValoracion($idComentario){
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
    	$query = 'DELETE FROM `comentarios-cervezas` WHERE idComentario = "' . $idComentario . '"';
    	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

    	if($mysqli->affected_rows == 0){
    		echo "Error al eliminar comentario";
    	}
        else
            Header('Location: '.$_SERVER['PHP_SELF']);
    }

    public static function updateValoracionMedia($idCerveza){
        //No se usa de momento
    	$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
    	$query = 'SELECT sum(valoracion)/count(valoracion) as valoracionMedia FROM `comentarios-cervezas` WHERE idCerveza = ' . $idCerveza . ' group by idCerveza';
    	$resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));

    	if (mysqli_num_rows($resultado) > 0) {

            $fila = $resultado->fetch_assoc();
            $valoracion = $fila["valoracionMedia"];
            $valoracion = round($valoracion);
            echo $valoracion;
            $sql = "UPDATE `cervezas` SET valoracionMedia = " . $valoracion . " WHERE id = " . $idCerveza;
            $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
            return $valoracion;
        } else{
        	return 0;
        }
    }

    public static function existeVal($idCerveza, $idUsuario){

        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "SELECT idComentario FROM `comentarios-cervezas` WHERE idUsuario = '" . $idUsuario . "' AND idCerveza = '".$idCerveza."'";
        $resultado = $mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        if(mysqli_num_rows($resultado) == 0)
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