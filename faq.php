<?php 
	include('logica/conexion.php');
	global $sql;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>FAQ</title>
		<meta charset="utf-8">
		<link href="css/estilos.css" rel="stylesheet">
	</head>
	<body>
	<?php require ('comun/header.php'); ?>

		<div id="main">

			<h2> FAQ - Frequently asked questions </h2>

		<li> Preguntas y dudas frecuentes:</li>
			<ul><a href = "#who">1. ¿Quienes somos?</a></ul>
			<ul><a href = "#register">2. ¿Como me puedo dar de alta?</a></ul>
			<ul><a href = "#num">3. ¿Puedo tener más de una cuenta?</a></ul>
			<ul><a href = "#filter">4. ¿Como uso el filtro del Catálogo?</a></ul>
			<ul><a href = "#log">5. ¿Como accedo a mi cuenta tras mi registro?</a></ul>
			<ul><a href = "#addr">6. ¿A que dirección llegan los pedidos de un grupo de consumo?</a></ul>
			<ul><a href = "#info">7. ¿Alguna duda más?</a></ul>
	
				
			<h3 id="who">1. ¿Quienes somos?</h3>				
			<p> Somos un grupo de 7 estudiantes de la asignatura AW de Ingeniería Informática de la UCM enamorados de la cerveza que intentamos hacer más facil a todos el acceso a grandes marcas artesanales, nacionales e internacionales.
			</p>

			<h3 id="register">2. ¿Como me puedo dar de alta?</h3>			
			<p> Tan solo has de pinchar en Register y rellenar tus datos personales para que podamos
			dirigirnos a tí como es debido. 
			No olvides especificar el rol que deseas adoptar o bien Registrado para realizar tus compras o bien
			VendedorNo olvides que al hacer clic en "Registrarte", aceptas los
			<a href="terminos.php"> términos y condiciones del servicio </a> y confirmas que has leído nuestra
			<a href="politicadeprivacidad.php"> Política de privacidad. </a>				
			</p>

			
			<h3 id="num">3. ¿Puedo tener más de una cuenta?</h3>				
			<p>Puedes tener más de una cuenta siempre y cuando utilices un correo distinto y distintas credenciales para identificarte sin embargo no es recomendable y aconsejamos una sola cuenta por cada usuario.				
			</p>


			<h3 id="filter">4. ¿Como uso el filtro del catálogo</h3>				
			<p> Filtra tus cervezas en función de tus gustos: Artesanas, Nacionales o por numero de graduación, puedes marcar tantos checkbox como quieras, además puedes ordenar tus resultados por numero de ventas o por precio.			
			También puedes elegirlas por su color o por sus ingredientes. Una vez marcadas las opciones deseadas dar a "enviar"
			y los resultados apareceran a continuación.				
			</p>



			<h3 id="log">5. ¿Como accedo a mi cuenta tras mi registro?</h3>				
			<p> Tan solo has de acudir a perfil o login y pinchar en cualquiera de ambas, allí encontras dos campos uno para introducir tu nombre de usuario y otro para la contraseña que metiste a la hora de hacer el registro.	
			</p>

			<h3 id="addr">6. ¿A que dirección llegan los pedidos de un grupo de consumo?</h3>				
			<p> Tan solo tienes que mirar la dirección que puso el jefe del grupo de consumo en el que realizaste tu pedido y a esa dirección sera enviado tu pedido junto con el resto de cervezas que pidio el grupo.				
			</p>
			

			<h3 id="info">7. ¿Alguna duda más?</h3>				
			<p> No dudes en enviarnos cualquier otro tipo de duda, evaluación, sugerencia o crítica que te surja pinchando en <a href="contacto.php"> contacto </a>.
			</p>


        </div>
        <?php require('comun/footer.php'); ?>
	</body>
</html>