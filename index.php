<?php
      require_once __DIR__.'/includes/config.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css"/>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
      <link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<meta charset="utf-8">
	<title>BeerEveyday</title>
</head>
<body>
	<div id="contenedor"> <!-- Contenedor-->
		<?php require('./includes/comun/header.php'); ?>

		<div id="cont01" class="container">
                  <div>
                  	<img src="img/index/cervezalink2.png" alt="imagen cerveza"/>
                  	<div class = "texto-centrado"><a href="catalogo.php">TOP SOLD BEERS</a></div>
                  </div>
                  <div>
                  	<img src="img/index/cervezalink1.jpg" alt="imagen cerveza" />
                  	<div class = "texto-centrado"><a href="catalogo.php">NEW ARRIVALS</a></div>
                  </div>
                  <div>
                  	<img src="img/index/cervezalink4.jpg" alt="imagen cerveza" />
                  	<div class = "texto-centrado"><a href="mostrarGrupos.php">GROUPS</a></div>
                  </div>
            </div>

		<?php require('./includes/comun/footer.php'); ?>
	</div> <!-- Fin del contenedor -->

</body>
</html>