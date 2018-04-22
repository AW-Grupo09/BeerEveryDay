<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css"/>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

	<meta charset="utf-8">
	<title>BeerEveyday</title>
</head>
<body>
	<div id="contenedor"> <!-- Contenedor-->
		<?php require('comun/header.php'); ?>

		<div id="cont01" class="container">
                  <div>
                  	<img src="img/cervezalink1.jpg" alt="imagen cerveza"/>
                  	<div class = "texto-centrado"><a href="http://localhost/BeerEveryDay/catalogo.php">Top sold beers</a></div>
                  </div>
                  <div>
                  	<img src="img/cervezalink1.jpg" alt="imagen cerveza" />
                  	<div class = "texto-centrado"><a href="http://localhost/BeerEveryDay/catalogo.php">New arraivals</a></div>
                  </div>
                  <div>
                  	<img src="img/cervezalink1.jpg" alt="imagen cerveza" />
                  	<div class = "texto-centrado"><a href="http://localhost/BeerEveryDay/catalogo.php">Groups</a></div>
                  </div>
            </div>

		<?php require('comun/footer.php'); ?>
	</div> <!-- Fin del contenedor -->

</body>
</html>