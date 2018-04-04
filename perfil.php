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
		$User = new usuario($_SESSION["user"], $mysqli);
	?>
	<title>Landing</title>

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
				<p>User: <?php echo $User->getIdUsuario();?></p>
			</div>

			<div class = UserData>
				<p>Nombre: <?php echo $User->getNombre();?></p>
				<p>Apellidos: <?php echo $User->getCiudad();?></p>
				<p>Ciudad: <?php echo $User->getFechaNac();?></p>
			</div>

		</div>
		
		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>