<?php
	session_start();
	if(!isset($_SESSION["logged"]))
		$_SESSION["logged"] = false;
	else{
		if($_SESSION["logged"])
			header('Location: index.php');
	}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> Grupos </title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>

	<div id="contenedor">

		<?php require ('comun/header.php'); ?>

		<div class="container">
		
			<!-- COLOCAR AQUI EL CODIGO DE GRUPOS-->

		</div>


		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>