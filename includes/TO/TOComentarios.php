<?php

class TOComentarios {

    private $idComentario;
    private $valoracion;
    private $comentario;
    private $idCerveza;
    private $idUsuario;
    private $idGrupo;
    private $fecha;

    public function __construct($idComentario, $valoracion, $comentario, $idCerveza, $idUsuario, $idGrupo, $fecha){

        $this->idComentario = $idComentario;
        $this->valoracion = $valoracion;
        $this->comentario = $comentario;
        $this->idCerveza = $idCerveza;
        $this->idUsuario = $idUsuario;
        $this->idGrupo = $idGrupo;
        $this->fecha = $fecha;

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

    public function getIdGrupo(){
        return $this->idUsuario;
    }

    public function setIdGrupo($idGrupo){
        $this->idGrupo = $idGrupo;
        return $this;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
        return $this;
    }

}

?>