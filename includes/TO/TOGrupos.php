<?php

class TOGrupos{

	private $nombre;
	private $direccion;
    private $creador;
    private $ciudad;
    private $id;
    private $idCerveza;
    private $cantidad;

    public function __construct($nombre, $direccion, $creador, $ciudad) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->creador = $creador;
        $this->ciudad = $ciudad;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getCreador() {
        return $this->creador;
    }

    public function setCreador($creador) {
        $this->creador = $creador;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCerveza() {
        return $this->cerveza;
    }

    public function setCerveza($cerveza) {
        $this->cerveza = $cerveza;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
}

?>