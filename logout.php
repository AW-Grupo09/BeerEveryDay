<?php 
	session_start();

	//Doble seguridad: unset + destroy
	unset($_SESSION["login"]);
	unset($_SESSION["esAdmin"]);
	unset($_SESSION["nombre"]);

	session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css"/>
	<link rel="stylesheet" type="text/css" href="css/logout.css"/>
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<meta charset="utf-8">
	<title>Logout</title>
</head>

<body>

<div id="contenedor"> <!-- Contenedor-->

	<?php require ('includes/comun/header.php'); ?>

	<div class="container"><!--bloque del contenido central-->
		<div class="centrado">
			<h1>¡Hasta pronto!</h1>
			<div class= "espaciado">
				<p> Es una pena que te hayas ido... ¡Esperamos verte pronto! </p>
			</div>
		</div>
	</div>

	<?php require ('includes/comun/footer.php'); ?>	
	
</div> <!-- Fin del contenedor -->

</body>
</html>