<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta charset="utf-8">
		<title> Contacto </title>
	</head>
	<body>

	<?php require ('comun/header.php'); ?>

	<div id="contenedor">

		<div id="main">
			<h1> Contacto </h1>

			<form action="mailto:beer@everyday.es" method="POST">
			<fieldset>
			<legend> Datos personales </legend>

				Nombre:<br> <input type="text" name="nom"><br>
				Email: <br> <input type="text" name="cont"><br>
				<br>Motivo de la consulta:<br>
				<br><input type="radio" name="consulta" value="evaluacion" checked>Evaluación<br>
				<br><input type="radio" name="consulta" value="sugerencias">Sugerencias<br>
				<br><input type="radio" name="consulta" value="criticas">Críticas<br>
				<br><input type="checkbox" name="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio<br>

				<br><textarea name="texto" rows="5" cols="60">Escriba su consulta</textarea><br>
				<br> <input type="submit" name="enviar"><br>		
			
			</fieldset>		
			</form>
		</div>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

	</body>

</html>