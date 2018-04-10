<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<meta charset="utf-8">
	<title>About us</title>
	<?php session_start(); ?>
</head>

<body>

	<?php require('comun/header.php'); ?>

	<div id="contenedor"> <!-- Contenedor-->

		<h2>About us</h2>

		<h3> ¿Quiénes somos? </h3>

		<p> Somos un grupo de estudiantes de la Universidad Complutense de Madrid y esta es nuestra práctica para la asignatura de Aplicaciones Web.

		<li> Miembros del equipo: 
			<ul><a href = "#dario">Dario Fernando Gallegos</a></ul>
			<ul><a href = "#julioC">Julio de la Cruz Valderrama</a></ul>
			<ul><a href = "#silvia">Silvia Lendínez Fernández </a></ul>
			<ul><a href = "#julioA">Julio Aparicio Maroto</a></ul>
			<ul><a href = "#ruben">Ruben Izquierdo Belinchón</a></ul>
			<ul><a href = "#luis">Luis Fernández De Santos Borrallo</a></ul>
			<ul><a href = "#gonzalo">Gonzalo Molina Díaz </a></ul>
		</li>


		<h3> Información de cada uno de nosotros: </h3>

		<p id="dario">Información de Dario</p>
		<p> Me gusta leer libros de ficcion, salir a hacer deporte y patinar, el senderismo.Mi libro favorito el 100 años de soledad de Gabriel Garcia Marquez. </p>
		<p> Correo: Dariogal@ucm.es </p>

		<p id="julioC">Información de Julio de la Cruz</p>
		<p> Me considero amante del buen cine y de la buena música. Me encanta viajar y conocer diversas culturas. </p>
		<p> Correo: endela01@ucm.es </p>

		<p id="silvia">Información de Silvia</p>
		<p> Viajar, fotografía, tocar la guitarra y hacer deporte, en especial tenis y windsurf. </p>
		<p> Correo: sillendi@ucm.es </p>

		<p id="julioA">Información de Julio Aparicio</p>
		<p>Estudiante del Grado en Ingeniería Informática en la Universidad Complutense de Madrid. </p>
		<p>Correo: japari02@ucm.es </p>

		<p id="ruben">Información de Rubén</p>
		<p> Experto en perder el tiempo. </p>
		<p> Correo: rubenizq@ucm.es </p>

		<p id="luis">Información de Luis</p>
		<p> Fan incondicional del fútbol, del cine, de la guitarra eléctrica y de la naturaleza. </p>
		<p> Correo: luisgf01@ucm.es </p>

		<p id="gonzalo">Información de Gonzalo</p>
		<p> Amante de viajar y conocer otras culturas, cinéfilo y apasionado del fútbol. Entusiasta de tomarse unas buenas cañas con amigos. </p>
		<p> Correo: gonzamol@ucm.es </p>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

</body>
</html>