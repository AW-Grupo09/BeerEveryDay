<?php

class TOCervezas{

	private $idCerveza;
	private $nombre;
	private $artesana;
	private $capacidad;
	private $color;
	private $fabricante;
	private $grado;
	private $grano;
	private $imagen;
	private $pais;
	private $precio;
	private $tipo;
	private $valoracion;

	public function __construct($id){
		$this->idCerveza = $id;
	}

	public function setIdCerveza($idCerveza){
			$this->idCerveza = $idCerveza;
	}
	public function getIdCerveza(){
		return $this->idCerveza;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getNombre(){
		return $this->nombre;
	}

	public function setArtesana($artesana){
		$this->artesana = $artesana;
	}
	public function getArtesana(){
		return $this->apellido;
	}

	public function setCapacidad($capacidad){
		$this->capacidad = $capacidad;
	}
	public function getCapacidad(){
		return $this->capacidad;
	}

	public function setColor($color){
		$this->color = $color;
	}
	public function getColor(){
		return $this->color;
	}

	public function setFabricante($fabricante){
		$this->fabricante = $fabricante;
	}
	public function getFabricante(){
		return $this->fechaNac;
	}

	public function setGrado($grado){
		$this->grado = $grado;
	}
	public function getGrado(){
		return $this->grado;
	}

	public function setGrano($grano){
		$this->grano = $grano;
	}
	public function getGrano(){
		return $this->grano;
	}

	public function setImagen($imagen){
		$this->imagen = $imagen;
	}
	public function getImagen(){
		return $this->imagen;
	}

	public function setPais($pais){
		$this->pais = $pais;
	}
	public function getPais(){
		return $this->pais;
	}
	
	public function setPrecio($precio){
		$this->precio = $precio;
	}
	public function getPrecio(){
		return $this->precio;
	}
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	public function getTipo(){
		return $this->tipo;
	}

    /**
     * @return mixed
     */
    public function getValoracion()
    {
        return $this->valoracion;
    }

    /**
     * @param mixed $valoracion
     *
     * @return self
     */
    public function setValoracion($valoracion)
    {
        $this->valoracion = $valoracion;

        return $this;
    }
}
?>