<?php 
	session_start();
	require_once __DIR__.'/includes/FormularioRegistro.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/registrate.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>

	<div id="contenedor">
		<?php require ('includes/comun/header.php'); ?>

		<div class="container">
			<div class="titulo">
				<p><h1> ¡Bienvenido, cervecero! </h1></p>
				<p><h2> Estás a punto de unirte a BeerEveryday... </h2></p>
		    </div>

		   <?php 
				$opciones = array();

				$formulario = new FormularioRegistro("formRegistro", $opciones);
				$formulario->gestiona();

			?>

		</div> <!--Cierre del container-->


		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>