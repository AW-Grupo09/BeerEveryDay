<?php

class Usuario{

	private $idUsuario;
	private $nombre;
	private $apellido;
	private $cuidad;
	private $email;
	private $fechaNac;
	private $rol;
	private $tarjeta;
	private $avatar;
	private $password;

	public function __construct($id, $mysqli){

		$query="SELECT * FROM usuarios WHERE id LIKE '$id'";
		$resultado=$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
		if (mysqli_num_rows($resultado) > 0) {
		    // output data of each row
			$fila = $resultado->fetch_assoc();
			$this->idUsuario = $id;
			$this->nombre = $fila["nombre"];
			$this->apellido = $fila["apellidos"];
			$this->cuidad = $fila["ciudad"];
			$this->email = $fila["email"];
			$this->fechaNac = $fila["fechaNac"];
			$this->rol = $fila["rol"];
			$this->tarjeta = $fila["tarjeta"];
			$this->avatar = $fila["avatar"];
			$this->password = $fila["password"];
		}
	}


	public static function existeUsuario($id, $mysqli){
		$sql = "SELECT * FROM ". 'usuarios' . " WHERE id = '$id' ";

		$resultado = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1)); 	
		$usuarioValido = $resultado->fetch_assoc();	

		return $usuarioValido;
	}

	public static function insertarUsuario($id, $nombre, $apellidos, $email, $password, $fechaNac, $ciudad, $avatar, $rol, $mysqli){
		$query = "INSERT INTO " . 'usuarios' . " (id, nombre ,apellidos, email, password, fechaNac, tarjeta, ciudad, avatar, rol) VALUES ('$id', '$nombre', '$apellidos', '$email', '$password', '$fechaNac', NULL, '$ciudad', '$avatar', '$rol')";
		$correcto = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

	public static function checkPass($id, $passposted, $mysqli){

		$query="SELECT password FROM usuarios WHERE id LIKE '$id'";
		$resultado=$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
		$r = $resultado->fetch_assoc();
		if($r["password"]== $passposted)
			return true;
		else
			return false;

	}

	public static function esImagen($src_file_name) {
		
		$supported_image = array(
		'gif',
		'jpg',
		'jpeg',
		'png'
		);

		$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
		if (in_array($ext, $supported_image)) {
			return true;
		} else {
			return false;
		}
	}

	public static function imgValida($avatar, $size){
		if(($avatar == !NULL) && ($size <= 2000000))
			return true;
		else
			return false;
	}

	public function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
	}
	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getNombre(){
		return $this->nombre;
	}

	public function setApellido($apellido){
		$this->apellido = $apellido;
	}
	public function getApellido(){
		return $this->apellido;
	}

	public function setCiudad($cuidad){
		$this->cuidad = $cuidad;
	}
	public function getCiudad(){
		return $this->cuidad;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
	}

	public function setFechaNac($fechaNac){
		$this->fechaNac = $fechaNac;
	}
	public function getFechaNac(){
		return $this->fechaNac;
	}

	public function setRol($rol){
		$this->rol = $rol;
	}
	public function getRol(){
		return $this->rol;
	}

	public function setTarjeta($tarjeta){
		$this->tarjeta = $tarjeta;
	}
	public function getTarjeta(){
		return $this->tarjeta;
	}

	public function setAvatar($avatar){
		$this->avatar = $avatar;
	}
	public function getAvatar(){
		return $this->avatar;
	}
	
	public function setPassword($password){
		$this->password = $password;
	}
	public function getPassword(){
		return $this->password;
	}

}

?>