<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__ .'/includes/FormularioSubirCerveza.php';

    if(!$_SESSION['login']){
		header('Location: index.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
		<title>Añadir cervezas</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css"/>
		<meta charset="utf-8"/>	
</head>

<body>
		<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>
	

		<div class="container">

		<h3>Modifica los datos de usuario:</h3>
			
			<?php   
				$opciones = array();

				$formulario = new FormularioSubirCerveza("FormSubirCerveza", $opciones);
				$formulario->gestiona();
										
			?>
			
		</div>


		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Cierre del contenedor -->
		

	</body>
</html>