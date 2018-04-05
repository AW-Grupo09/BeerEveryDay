<?php
	
	include('conexion.php');
	include('usuario.php');

	$mysqli = conexion::getConection();

	$id = $_POST ['id'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$email = $_POST['mail'];
	$remail = $_POST['remail'];
	$password = $_POST['pass'];
	$repass = $_POST['repass'];
	$fechaNac = $_POST['fechaNac'];
	$ciudad = $_POST['ciudad'];
	$rol = $_POST['rol'];
	$avatar = $_POST['archivo'];


	if(Usuario::existeUsuario($id, $mysqli) == NULL){
	
		if($email != $remail){
			$resultadoFormularioRegistro = "Los emails no coinciden..";
		} else if($password != $repass){ // en un futuro se puede comprobar la longitud de las contraseñas (mínimo 5 o algo así)
			$resultadoFormularioRegistro = "ERROR: las contraseñas no coinciden..";
		}
		else if(Usuario::esImagen($avatar) == false) {
			$resultadoFormularioRegistro = "Inserte una imagen válida";
		} else {
			Usuario::insertarUsuario($id, $nombre, $apellidos, $email, $password, $fechaNac, $ciudad, $avatar, $rol, $mysqli);
			$resultadoFormularioRegistro = "REGISTRADO CORRECTAMENTE";
			//header('Location: ../index.php');
		}
	}
	else{
		$resultadoFormularioRegistro = "ERROR: username ya en uso";
	}

	echo $resultadoFormularioRegistro;


?>