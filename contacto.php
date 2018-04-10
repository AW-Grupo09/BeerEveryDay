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

				Nombre: <input type="text" name="nom">
				Email:  <input type="text" name="cont">
				Motivo de la consulta:
				<input type="radio" name="consulta" value="evaluacion" checked>Evaluación
				<input type="radio" name="consulta" value="sugerencias">Sugerencias
				<input type="radio" name="consulta" value="criticas">Críticas
				<input type="checkbox" name="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio

				<textarea name="texto" rows="5" cols="60">Escriba su consulta</textarea>
				<input type="submit" name="enviar">	
			
			</fieldset>		
			</form>
		</div>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

	</body>

</html>