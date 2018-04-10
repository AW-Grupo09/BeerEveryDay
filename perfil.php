<?php 
	include('logica/conexion.php');
	include('logica/usuario.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta charset="utf-8">
	<?php
		$mysqli = conexion::getConection();
		$user = new usuario($_SESSION["user"], $mysqli);
	?>
	<title>Perfil</title>

</head>

<body>

	<?php require ('comun/header.php'); ?>

	<div id="contenedor"> <!-- Contenedor-->

		<div class="container"><!--bloque del contenido central-->
			
			<?php
			if(!$_SESSION["logged"])
				echo '<script type="text/javascript">window.location.replace("login.php");</script>';
			?>

			<div class = avatar>
				<?php 
					if($user->getAvatar() != NULL)
						echo "<img width='10%' height='10%' src='img/users/" . $user->getAvatar() . " ' alt = 'Imagen de perfil'>"; 
					else
						echo "<img width='10%' height='10%' src='img/users/default.png' alt = 'Imagen de perfil'>"; 
				?> 
			</div>

			<div class = nickname>
				<p>User: <?php echo $user->getIdUsuario();?></p>
			</div>

			<div class = userData>
				<p>Nombre: <?php echo $user->getNombre();?></p>
				<p>Apellidos: <?php echo $user->getApellido();?></p>
				<p>Ciudad: <?php echo $user->getCiudad();?></p>
				<p>Fecha de nacimiento: <?php echo $user->getFechaNac(); ?> </p>
			</div>

		</div>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

</body>
</html>