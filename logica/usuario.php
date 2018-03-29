<?php

class Usuario{

	public function getTableName(){
		return 'usuarios';
	}

	public function getClassName(){
		return 'Usuario';
	}

	public function existeUsuario($id, $mysqli){
		$sql = "SELECT * FROM ". $this->getTableName() . " WHERE id = '$id' ";

		$resultado = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1)); 	
		$usuarioValido = $resultado->fetch_assoc();	

		return $usuarioValido;
	}

	public function insertarUsuario($id, $nombre, $apellidos, $email, $password, $fechaNac, $ciudad, $avatar, $rol, $mysqli){
		$query = "INSERT INTO " . $this->getTableName() . " (id, nombre ,apellidos, email, password, fechaNac, tarjeta, ciudad, avatar, rol) VALUES ('$id', '$nombre', '$apellidos', '$email', '$password', '$fechaNac', NULL, '$ciudad', '$avatar', '$rol')";
		$correcto = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

}

?>