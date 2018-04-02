<?php

	include('../conexion.php');
	include('../logica/usuario.php');
	include('../logica/TUsuario.php');

	$mysqli = conexion::getConection();

	$id = $_POST ['username'];

	
	$success = false;

	if(usuario::existeUsuario($id, $mysqli) != NULL){

		if(usuario::checkpass($id, $_POST["password"], $mysqli)){

			$_SESSiON["user"] = new TUsuario($id, $mysqli);
			$success = true;
			echo $_SESSION["user"]->getNombre();

		}

	}

	$_SESSION["LoginFailed"] = !$success;
	$_SESSION["logged"] =  $success;
/*
	if(!$success)
		header('Location: ../login.php');
	else
		header('Location: ../index.php');


	
/*
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
	$avatar = $_POST['avatar'];

	$usuario = new Usuario();

	if($usuario->existeUsuario($id, $mysqli) == NULL){
	
		if($_POST['mail'] != $_POST['remail']){
			$resultadoFormularioRegistro = "Los emails no coinciden..";
		} else if($_POST['pass'] != $_POST['repass']){
			$resultadoFormularioRegistro = "ERROR: las contraseñas no coinciden..";
		} else {
			$usuario->insertarUsuario($id, $nombre, $apellidos, $email, $password, $fechaNac, $ciudad, $avatar, $rol, $mysqli);
			$resultadoFormularioRegistro = "REGISTRADO CORRECTAMENTE";
			//header('Location: index.php');
		}
	}
	else{
		$resultadoFormularioRegistro = "ERROR: username ya en uso";
	}

	echo $resultadoFormularioRegistro;

*/
?>