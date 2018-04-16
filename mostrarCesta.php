<?php 
	include('logica/conexion.php');
	include('logica/usuario.php');
	if(!isset($_SESSION["logged"]))
		$_SESSION["logged"] = false;
	else{
		if(!$_SESSION["logged"])
			header('Location: login.php');
	}
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
	<title>Cesta</title>

</head>

<body>

	<?php require ('comun/header.php'); ?>

	<div id="contenedor"> <!-- Contenedor-->

		<div class="container"><!--bloque del contenido central-->
			

			

		</div>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

</body>
</html>