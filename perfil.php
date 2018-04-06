<?php 
	include('logica/conexion.php');
	include('logica/usuario.php');
?>

<!DOCTYPE html>
<html>
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

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('comun/header.php'); ?>

		<div class="container"><!--bloque del contenido central-->
			
			<?php
			if(!$_SESSION["logged"])
				echo '<script type="text/javascript">window.location.replace("login.php");</script>';
			?>

			<div class = nickname>
				<p>User: <?php echo $user->getIdUsuario();?></p>
			</div>

			<div class = userData>
				<p>Nombre: <?php echo $user->getNombre();?></p>
				<p>Apellidos: <?php echo $user->getApellido();?></p>
				<p>Ciudad: <?php echo $user->getCiudad();?></p>
				<p>Fecha de nacimiento: <?php echo $user->getFechaNac(); ?> </p>
			</div>

			<div class = avatar>
				<?php echo "<img width='50%' height='50%' src='img/users/" . $user->getAvatar() . " ' ;" ?> ;
			</div>

		</div>
		
		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>