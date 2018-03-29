<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta charset="utf-8">
	<title>Landing</title>
	<?php session_start(); ?>
</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('header.php'); ?>


		<div class="container"><!--bloque del contenido central-->
			<img id="fondoInicio" src="img/BackgroundInicio.JPG" alt="BackgroundInicio" />
			<a class="button" style="color:#110000; background: #ffffff" href="registrate.php">Shop Now!</a>
		</div>
		<?php require('footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>