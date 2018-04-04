<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta charset="utf-8">
	<title>logout</title>
	<?php 
		session_start();
		session_destroy();
		session_start();
	?>
</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('comun/header.php'); ?>


		<div class="container"><!--bloque del contenido central-->
			<h1>¡Hasta pronto!</h1>
		</div>

		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>