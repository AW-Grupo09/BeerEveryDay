<?php

class Registro {

	public function obtenerDatos() {
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$email = $_POST['mail'];
		$remail = $_POST['remail'];
		$password = $_POST['pass'];
		$repass = $_POST['repass'];
		$fechaNac = $_POST['fechaNac'];
		$ciudad = $_POST['ciudad'];
		$avatar = $_POST['avatar'];
		$rol = 'registrado';
		$correcto = "0";
	}
}


?>