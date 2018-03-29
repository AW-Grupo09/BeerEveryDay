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
			<p> <a href="registrate.php"> Regístrate </a></p>
		</div>
		<?php require('footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>