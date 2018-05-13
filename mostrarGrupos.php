<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioGrupo.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title> Grupos </title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
</head>

<body>

	<div id="contenedor">

		<?php require ('includes/comun/header.php'); ?>

		<div class="container">
			<div class="titulo">
				<p><h1> ¡Mis grupos! </h1></p>
		  	</div>

		   <?php 

				$opciones = array();

				$formulario = new FormularioGrupo("formGrupo", $opciones);
				$formulario->gestiona();

			?>

		</div>


		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>