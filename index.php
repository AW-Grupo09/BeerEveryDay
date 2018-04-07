<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<meta charset="utf-8">
	<title>BeerEveyday</title>
	<?php session_start(); ?>
</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require('comun/header.php'); ?>

		<div class="container"><!--bloque del contenido central-->
			<img id="fondoInicio" src="img/BackgroundInicio.JPG" alt="BackgroundInicio" />
			<a class="button" style="color:#110000; background: #ffffff" href="BusinessObject.php">Shop Now!</a>
		</div>
		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>