<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<meta charset="utf-8">
		<title> Contacto </title>
	</head>
	<body>

	<div id="contenedor">
		<?php require ('includes/comun/header.php'); ?>

		<div class="container">
			<h1> Contacto </h1>

			<form action="mailto:beer@everyday.es" method="POST">
			<fieldset>
			<legend> Datos personales </legend>

				<p> Nombre: <input type="text" name="nom"> </p>
				<p> Email:  <input type="text" name="cont"> </p>
				<p> Motivo de la consulta: </p>
				<p> <input type="radio" name="consulta" value="evaluacion" checked>  Evaluación </p>
				<p> <input type="radio" name="consulta" value="sugerencias"> Sugerencias </p>
				<p> <input type="radio" name="consulta" value="criticas"> Críticas </p>
				<p> <input type="checkbox" name="terminos">Marque esta casilla para verificar que ha leído nuestros términos y condiciones del servicio </p>

				<p> <textarea name="texto" rows="5" cols="60">Escriba su consulta</textarea> </p> 
				<p> <input type="submit" name="enviar">	</p>
			
			</fieldset>		
			</form>
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

	</body>

</html>