<?php

require_once __DIR__.'/../DAO/DAOComentarios.php';

class controllerComentarios {

    private static $daoComentarios;

    public static function cargarValoracion($idComentario){
    	$daoComentarios = new DAOComentarios();
        return $daoComentarios->cargarValoracion($idComentario);
    }

    public static function cargarComentario($idComentario){
        $daoComentarios = new DAOComentarios();
        return $daoComentarios->cargarComentario($idComentario);
    }

    public static function cargarValoraciones($idCerveza){
    	$daoComentarios = new DAOComentarios();
        $resultado = $daoComentarios->cargarValoraciones($idCerveza);
        $comentarios = array();
        if ($resultado != NULL && count($resultado) != 0){
            foreach ($resultado as $idComentario){
                array_push($comentarios,  controllerComentarios::cargarValoracion($idComentario));
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }


    public static function cargarComentariosGrupos($idGrupo){
        $daoComentarios = new DAOComentarios();
        $resultado = $daoComentarios->cargarComentariosGrupos($idGrupo);
        $comentarios = array();
        if ($resultado != NULL && count($resultado) != 0){
            foreach ($resultado as $idComentario){
                array_push($comentarios,  controllerComentarios::cargarComentario($idComentario));
            }
            return $comentarios;
        }     
        else {
            return NULL;
        }
    }
    

    public static function insertarValoracion($valoracion, $comentario, $idCerveza, $idUsuario){
    	$daoComentarios = new DAOComentarios();
        $daoComentarios->insertarValoracion($valoracion, $comentario, $idCerveza, $idUsuario);
    }

    public static function insertarComentarioGrupo($comentario, $idGrupo, $idUsuario){
        $daoComentarios = new DAOComentarios();
        $daoComentarios->insertarComentarioGrupo($comentario, $idGrupo, $idUsuario);
    }

    public static function eliminarValoracion($idComentario){
    	$daoComentarios = new DAOComentarios();
        $daoComentarios->eliminarValoracion($idComentario);
    }

    public static function updateValoracionMedia($idCerveza){
        $daoComentarios = new DAOComentarios();
        return $daoComentarios->updateValoracionMedia($idCerveza);
    }

    public static function existeVal($idCerveza, $idUsuario){
        $daoComentarios = new DAOComentarios();
        return $daoComentarios->existeVal($idCerveza, $idUsuario);
    }
}

    /*public static function mostrarComentariosGrupo($idGrupo){

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
        if($idsComentarios != NULL)
            foreach($idsComentarios as $idComentario){
                $comentario = controllerComentarios::cargarValoracion($idComentario);
                echo "<p id = 'autorComent'>" . $comentario->getidUsuario(). "</p>";
                echo "<p id = 'dateComent'> Fecha:" . $comentario->getFecha(). "</p>";
                echo "<p id = 'val'>" . $comentario->getValoracion(). "/5</p>";
                echo "<p id = 'coment'>" . $comentario->getComentario(). "</p>";

                if(isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] == $comentario->getIdUsuario())
                    echo '<input type="button" id="myBtn" onclick="deleteVal('.$idComentario.')" value="Eliminar valoración">';             
                
        }

    }*/


?>