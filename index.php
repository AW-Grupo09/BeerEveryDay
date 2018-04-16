<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta charset="utf-8">
	<title>BeerEveyday</title>
</head>
<body>

	<div id="contenedor"> <!-- Contenedor-->
		<?php require('comun/header.php'); ?>

			<div class="container"><!--bloque del contenido central-->
				<img id="fondoInicio" src="img/BackgroundInicio.JPG" alt="BackgroundInicio" />
				<a class="button" style="color:#110000; background: #ffffff" href="catalogo.php">¡Compra ahora!</a>
			</div>

		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>