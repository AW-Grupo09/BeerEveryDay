<?php
	
	include('conexion.php');
	include('usuario.php');

	$mysqli = conexion::getConection();

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$email = $_POST['mail'];
	$remail = $_POST['remail'];
	$password = $_POST['pass'];
	$repass = $_POST['repass'];
	$fechaNac = $_POST['fechaNac'];
	$ciudad = $_POST['ciudad'];
	$rol = $_POST['rol'];
	$avatar = $_FILES['archivo']['name'];
	$size = $_FILES['archivo']['size'];
	$directorio = '../img/users/';

	$success = false;

	if(Usuario::existeUsuario($id, $mysqli) == NULL){
	
		if($email != $remail){
			$resultadoFormularioRegistro = "<p>Los emails no coinciden..</p>";
		} else if($password != $repass){ // en un futuro se puede comprobar la longitud de las contraseñas (mínimo 5 o algo así)
			$resultadoFormularioRegistro = "<p>ERROR: las contraseñas no coinciden..</p>";
		} else if(Usuario::esImagen($avatar) == false || Usuario::imgValida($avatar, $size) == false) {
			$resultadoFormularioRegistro = "<p>Inserte una imagen válida</p>";
		} else {
			Usuario::insertarUsuario($id, $nombre, $apellidos, $email, $password, $fechaNac, $ciudad, $avatar, $rol, $mysqli);
			move_uploaded_file($_FILES['archivo']['tmp_name'] ,$directorio.$avatar);
			$success = true;
			$_SESSION["user"]  = $id;
			$resultadoFormularioRegistro = "<p>REGISTRADO CORRECTAMENTE</p>";
		}
	}
	else{
		$resultadoFormularioRegistro = "<p>ERROR: nombre de usuario ya en uso</p>";
	}

	$_SESSION['regFailed'] = !$success;
	$_SESSION['logged'] =  $success;
	$_SESSION['msg'] = $resultadoFormularioRegistro;

	if(!$success)
		header('Location: ../registrate.php');
	else
		header('Location: ../index.php');
	

?>