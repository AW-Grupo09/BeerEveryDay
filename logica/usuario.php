<?php

class Usuario{

	public function getTableName(){
		return 'usuarios';
	}

	public function getClassName(){
		return 'Usuario';
	}

	public static function existeUsuario($id, $mysqli){
		$sql = "SELECT * FROM ". 'usuarios' . " WHERE id = '$id' ";

		$resultado = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1)); 	
		$usuarioValido = $resultado->fetch_assoc();	

		return $usuarioValido;
	}

	public function insertarUsuario($id, $nombre, $apellidos, $email, $password, $fechaNac, $ciudad, $avatar, $rol, $mysqli){
		$query = "INSERT INTO " . $this->getTableName() . " (id, nombre ,apellidos, email, password, fechaNac, tarjeta, ciudad, avatar, rol) VALUES ('$id', '$nombre', '$apellidos', '$email', '$password', '$fechaNac', NULL, '$ciudad', '$avatar', '$rol')";
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

}

?>