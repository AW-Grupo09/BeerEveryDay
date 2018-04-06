<?php

	include('conexion.php');
	include('usuario.php');

	$mysqli = conexion::getConection();

	$id = $_POST['username'];

	
	$success = false;

	if(usuario::existeUsuario($id, $mysqli) != NULL){

		if(usuario::checkpass($id, $_POST["password"], $mysqli)){

			$success = true;
			$_SESSION["user"]  = $id;		

		}

	}

	$_SESSION["LoginFailed"] = !$success;
	$_SESSION["logged"] =  $success;

	if(!$success)
		header('Location: ../login.php');
	else
		header('Location: ../index.php');


?>