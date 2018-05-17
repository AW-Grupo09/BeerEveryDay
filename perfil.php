<?php 
	/*include('logica/conexion.php');
	include('logica/usuario.php');*/

	require_once __DIR__.'/includes/config.php';
    include('includes/Usuario.php');

    if(!$_SESSION['login']){
		header('Location: index.php');
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
		$user = Usuario::buscaUsuario($_SESSION['nombreUsuario']);
	?>
	<title>Perfil</title>

</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>

		<div class="container"><!--bloque del contenido central-->
			<div class = "avatar">
				<?php 
					if($user->avatar() != NULL)
						echo "<img src='" . $user->avatar() . " ' alt = 'Imagen de perfil'>"; 
					else
						echo "<img src='/img/users/default.png' alt = 'Imagen de perfil'>"; 
					$_SESSION['avatar'] = $user->avatar();
				?> 
			</div>

			<div class = "userData">
				<fieldset>
				<legend>Datos del usuario</legend>
					<p>Nombre de usuario: <?php echo $user->nombreUsuario();?></p>
					<p>Nombre: <?php echo $user->nombre();?></p>
					<p>Apellidos: <?php echo $user->apellidos();?></p>
					<p>Email: <?php echo $user->email();?></p>
					<p>Ciudad: <?php echo $user->ciudad();?></p>
					<p>Fecha de nacimiento: <?php echo date("d-m-Y",strtotime($user->fechaNac())) ;?></p>
					<form action="modificarPerfil.php">
						<label> <button> Modificar perfil</button> </label>
					</form>
				</fieldset>
			</div>

			<?php 
			if($user->rol() == 'admin'){ ?>
				<div class = "adminView">
					<h2> Esta vista es única para el administrador </h2>
					<p> En ella podrá ver los diferentes cambios que puede realizar en la aplicación </p>
						<form action="vistaAddBeers.php">
							<label> <button> Añadir cerveza</button> </label>
						</form>
				</div>
			<?php } ?>
			
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->	

</body>
</html>