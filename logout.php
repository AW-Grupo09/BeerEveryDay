<?php 
	session_start();
	session_destroy();
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
	<link rel="stylesheet" type="text/css" href="css/common.css"/>
	<meta charset="utf-8">
	<title>Logout</title>
</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('comun/header.php'); ?>

		<div class="container"><!--bloque del contenido central-->
			<h1>¡Hasta pronto!</h1>
			<p> Es una pena que te hayas ido... ¡Esperamos verte pronto! </p>
		</div>

		<?php require ('comun/footer.php'); ?>	
		
	</div> <!-- Fin del contenedor -->

</body>
</html>