<?php 

	session_start();
    include('includes/Controller/controllerUsuario.php');
    include('includes/TO/TOUsuarios.php');

    if(!$_SESSION['login']){
		header('Location: login.php');
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="css/perfil.css" />
	<meta charset="utf-8">
	<?php
		$user = controllerUsuario::buscaUsuario($_SESSION['nombreUsuario']);
	?>
	<title>Perfil</title>

</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>

		<div class="container"><!--bloque del contenido central-->
			<div class = "perfil">
				<div class = "avatar">
					<?php 
						if($user->getAvatar() != "img/users/")
							echo "<img src='" . $user->getAvatar() . " ' alt = 'Imagen de perfil'>"; 
						else
							echo '<img src="img/users/default.png">'; 
						$_SESSION['avatar'] = $user->getAvatar();
					?> 
					<form action="modificarAvatar.php">
						<label> <button id = "modCont"> Modificar foto de perfil</button> </label>
					</form>
				</div>

				<div class = "userData">
					<fieldset>
						<legend>MI PERFIL</legend>
						<p><span>Nombre de usuario: </span><?php echo $user->getNombreUsuario();?></p>
						<p><span>Nombre: </span><?php echo $user->getNombre();?></p>
						<p><span>Apellidos: </span><?php echo $user->getApellidos();?></p>
						<p><span>Email: </span><?php echo $user->getEmail();?></p>
						<p><span>Ciudad: </span><?php echo $user->getCiudad();?></p>
						<p><span>Fecha de nacimiento: </span><?php echo date("d-m-Y",strtotime($user->getFechaNac())) ;?></p>
						<form action="modificarPerfil.php">
							<label> <button> Modificar perfil</button> </label>
						</form>
						<form action="modificarPassword.php">
							<label> <button id = "modCont"> Modificar contraseña</button> </label>
						</form>
					</fieldset>
				</div>
		</div>

			<?php 
			/*if($user->rol() == 'admin'){ ?>
				<div class = "adminView">
					<h2> Esta vista es única para el administrador </h2>
					<p> En ella podrá ver los diferentes cambios que puede realizar en la aplicación </p>
						<form action="vistaAddBeers.php">
							<label> <button> Añadir cerveza</button> </label>
						</form>
				</div>
			<?php }*/ ?>
			
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->	

</body>
</html>