<?php

class TOPedidos {

    private $idPedido;
    private $user;
    private $grupo;
    private $cervezas = array();
    private $unidades = array();
    private $dir;
    private $estado;
    private $fechaPedido;
    private $fechaLimite;
    private $fechaEntrega;

    public function __construct($idPedido){
        $this->idPedido = $idPedido;
    }


    public function getIdPedido(){
        return $this->idPedido;
    }


    public function setIdPedido($idPedido){
        $this->idPedido = $idPedido;
        return $this;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    public function getGrupo(){
        return $this->grupo;
    }

    public function setGrupo($grupo){
        $this->grupo = $grupo;
        return $this;
    }

    public function getCervezas(){
        return $this->cervezas;
    }

    public function setCervezas($cervezas){
        $this->cervezas = $cervezas;
        return $this;
    }

    public function getUnidades(){
        return $this->unidades;
    }

    public function setUnidades($unidades){
        $this->unidades = $unidades;
        return $this;
    }

    public function getDir(){
        return $this->dir;
    }

    public function setDir($dir){
        $this->dir = $dir;
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }

    public function getFechaPedido(){
        return $this->fechaPedido;
    }

    public function setFechaPedido($fechaPedido){
        $this->fechaPedido = $fechaPedido;
        return $this;
    }

    public function getFechaLimite(){
        return $this->fechaLimite;
    }

    public function setFechaLimite($fechaLimite){
        $this->fechaLimite = $fechaLimite;
        return $this;
    }

    public function getFechaENtrega(){
        return $this->fechaEntrega;
    }

    public function setFechaEntrega($fechaEntrega){
        $this->fechaEntrega = $fechaEntrega;
        return $this;
    }
}

?>