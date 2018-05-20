<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__ .'/includes/FormularioModificaPassword.php';

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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript" src="js/guardaCambios.js"></script>
</head>

<body>
		<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>
	
		<div class="container">

			<?php   
				$opciones = array();

				$formulario = new FormularioModificaPassword("formModificaPassword", $opciones);
				$formulario->gestiona();

			?>

		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Cierre del contenedor -->
		
</body>
</html>