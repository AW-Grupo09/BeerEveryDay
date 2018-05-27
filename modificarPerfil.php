<?php 
	session_start();
	require_once __DIR__ .'/includes/FormularioModifica.php';

    if(!$_SESSION['login']){
		header('Location: index.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
		<title>Modifica usuario</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css"/>
		<link rel="stylesheet" type="text/css" href="css/perfil.css" />
		<meta charset="utf-8"/>	
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
		<script type="text/javascript" src="js/correoValido.js"></script>
		<?php
			$user = controllerUsuario::buscaUsuario($_SESSION['nombreUsuario']);
		?>
</head>

<body>
		<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>
	
		<div class="container">

			<?php   
				$opciones = array();

				$formulario = new FormularioModifica("formModifica", $opciones);
				$formulario->gestiona();

			?>

		</div>



		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Cierre del contenedor -->
		
</body>
</html>