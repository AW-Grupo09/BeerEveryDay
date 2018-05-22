<?php 
	require_once __DIR__.'/includes/config.php';
	global $sql;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<meta charset="utf-8">	
	<title>Cervezas</title>

</head>
<body>
	<div id="contenedor"> <!-- Contenedor-->
		<?php require ('includes/comun/header.php'); ?>
		<div class="container"><!--bloque del contenido central-->					
		<?php
			if(isset($_GET['nombreGrupo'])){
				$p =   $_GET['nombreGrupo'];
				echo '<p> '.$p .'<p>';
			}
		?>	
		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>