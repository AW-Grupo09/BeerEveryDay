<?php

class comentarios {

    private $idComentario;
    private $valoracion;
    private $comentario;
    private $idCerveza;
    private $idUsuario;
    private $idGrupo;

    public function __construct($idComentario, $valoracion, $comentario, $idCerveza, $idUsuario, $idGrupo){

        $this->idComentario = $idComentario;
        $this->valoracion = $valoracion;
        $this->comentario = $comentario;
        $this->idCerveza = $idCerveza;
        $this->idUsuario = $idUsuario;

    }

    public static function addCommentCerve($comentario, $idCerveza, $idUsuario, $valoracion){
        //Add comment to dataBase


    }

    public static function addCommentGroup($comentario, $idGrupo, $idUsuario){
        //add comment to database


    }

    public static function updateBeerRating($idCerveza){
        //Se encarga de actualizar la valoracion de una cerveza

    }

    public function getIdComentario(){
        return $this->idComentario;
    }


    public function setIdComentario($idComentario){
        $this->idComentario = $idComentario;
        return $this;
    }

    public function getValoracion(){
        return $this->valoracion;
    }

    public function setValoracion($valoracion){
        $this->valoracion = $valoracion;
        return $this;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
        return $this;
    }

    public function getIdCerveza(){
        return $this->idCerveza;
    }

    public function setIdCerveza($idCerveza){
        $this->idCerveza = $idCerveza;
        return $this;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
        return $this;
    }

}

?>