<?php

require_once __DIR__.'/conexion.php';

class cervezas{

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

	public function __construct($id){
		//$mysqli = conexion::getConection();
		$app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
		$query="SELECT * FROM cervezas WHERE id = $id ";
		$resultado=$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
		if (mysqli_num_rows($resultado) > 0) {
		    // output data of each row
			$fila = $resultado->fetch_assoc();
			$this->idCerveza = $id;
			$this->nombre = $fila["nombre"];
			$this->artesana = $fila["artesana"];
			$this->capacidad = $fila["capacidad"];
			$this->color = $fila["color"];
			$this->fabricante = $fila["fabricante"];
			$this->grado = $fila["grado"];
			$this->grano = $fila["grano"];
			$this->imagen = $fila["Imagen"];
			$this->pais = $fila["pais"];
			$this->precio = $fila["precio"];
			$this->tipo = $fila["tipo"];
		}
	}

	public static function getIdsCervezas($filtros,$orden,$mysqli){
		
		if(empty($filtros) && empty($orden))
			$sql = "SELECT id FROM cervezas";
		else
			$sql = "SELECT id FROM cervezas WHERE id > 0 ".$filtros. ' group by id ' . $orden;
		
		$consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1)); 

		$resultado = array();
		$i = 0;
		while($fila= mysqli_fetch_assoc($consulta)){
			$resultado[$i]= $fila["id"];
			$i++;
		}	
		return $resultado;
	}

 	public static function addBeer($imageFileType,  $Artesana, $nombreCerveza, $capacidad, $Color, $Fabricante, $Grado, $grano, $precio, $pais, $Tipo){


        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $sql = "SELECT max(id) FROM cervezas";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $id = mysqli_fetch_assoc($consulta);
        $query = sprintf("INSERT INTO cervezas(id, fabricante, nombre, grado, capacidad, precio, pais, artesana, color, grano, grado, tipo, Imagen, valoracionMedia) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 1)",
        	$id, $Fabricante, $nombreCerveza, $Grado, $capacidad, $precio, $pais, $Artesana, $Color, $grano, $Grado, $Tipo,           $imageFileType);
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
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
}
?>
