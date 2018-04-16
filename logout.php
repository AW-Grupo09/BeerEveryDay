<?php 
		session_start();
		session_destroy();
		session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<!--<link rel="stylesheet" type="text/css" href="css/logout.css" />-->
	<meta charset="utf-8">
	<title>logout</title>
</head>

<body>

	<?php require ('comun/header.php'); ?>

	<div id="contenedor"> <!-- Contenedor-->

		<div class="container"><!--bloque del contenido central-->
			<h1>¡Hasta pronto!</h1>
		</div>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

</body>
</html>