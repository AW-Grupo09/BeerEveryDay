<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<meta charset="utf-8">
	<title>BeerEveyday</title>
	<?php session_start(); ?>
</head>

<body>

	<?php require('comun/header.php'); ?>

	<div id="contenedor"> <!-- Contenedor-->

		<div class="container"><!--bloque del contenido central-->
			<img id="fondoInicio" src="img/BackgroundInicio.JPG" alt="BackgroundInicio" />
			<a class="button" style="color:#110000; background: #ffffff" href="BusinessObject.php">¡Compra ahora!</a>
		</div>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

</body>
</html>