<?php
	session_start();
	require_once __DIR__.'/includes/Controller/controllerUsuario.php';
	require_once __DIR__.'/includes/TO/TOUsuarios.php';
	require_once __DIR__.'/includes/FormularioLogin.php';

 ?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/login.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<title> Login </title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>

	<div id="contenedor">

		<?php require ('includes/comun/header.php'); ?>

		<div class="container">

			<?php 
				$opciones = array();

				$formulario = new FormularioLogin("formLogin", $opciones);
				$formulario->gestiona();

			?>

		</div> <!-- Cierre del container -->


		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>