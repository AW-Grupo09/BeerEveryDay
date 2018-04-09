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
		<h2><em>FAQ - Preguntas y dudas frecuentes:</em></h2>
			<a href = "#who">1. ¿Quienes somos?</a><br>
			<a href = "#register">2. ¿Como me puedo dar de alta?</a><br>
			<a href = "#num">3. ¿Puedo tener más de una cuenta?</a><br>
			<a href = "#filter">4. ¿Como uso el filtro del Catálogo?</a><br>
			<a href = "#info">5. ¿Alguna duda más?</a><br>
				
			<h3><em><p id="who">1. ¿Quienes somos?</p></em></h3>
				
			<div id ="who"> Somos un grupo de 7 estudiantes de la asignatura AW de Ingeniería Informática de la UCM enamorados de la cerveza que intentamos hacer más facil a todos el acceso a grandes marcas artesanales, nacionales e internacionales.<br><br><br>
			</div>


			<h3><em><p id="register">2. ¿Como me puedo dar de alta?</p></em></h3>
				
			<div id ="register" > Tan solo has de pinchar en <em>Register</em> y rellenar tus datos personales para que podamos
			dirigirnos a tí como es debido. <br>
			No olvides especificar el rol que deseas adoptar o bien <em>Registrado</em> para realizar tus compras o bien
			<em>Vendedor</em><br>No olvides que al hacer clic en "Registrarte", aceptas los
			<a href="terminos.php"> términos y condiciones del servicio </a> y confirmas que has leído nuestra
			<a href="politicadeprivacidad.php"> Política de privacidad. </a>
				<br><br><br>
			</div>

			
			<h3><em><p id="num">3. ¿Puedo tener más de una cuenta?</p></em></h3>
				
			<div id ="num" >Puedes tener más de una cuenta siempre y cuando utilices un correo distinto y distintas credenciales para identificarte sin embargo no es recomendable y aconsejamos una sola cuenta por cada usuario.
				<br><br><br>
			</div>


			<h3><em><p id="filter">4. ¿Como uso el filtro del catálogo</p></em></h3>
				
			<div id ="filter"> Filtra tus cervezas en función de tus gustos: Artesanas, Nacionales o por numero de graduación, puedes marcar tantos checkbox como quieras, además puedes ordenar tus resultados por numero de ventas o por precio.
			<br>
			También puedes elegirlas por su color o por sus ingredientes. Una vez marcadas las opciones deseadas dar a "enviar"
			y los resultados apareceran a continuación.
				<br><br><br>
			</div>



			<h3><em><p id="log">5. ¿Como accedo a mi cuenta tras mi registro?</p></em></h3>
				
			<div id ="log"> Tan solo has de acudir a perfil o login y pinchar en cualquiera de ambas, allí encontras dos campos uno para introducir tu nombre de usuario y otro para la contraseña que metiste a la hora de hacer el registro.
				<br><br><br>
			</div>


			<h3><em><p id="info">6. ¿Alguna duda más?</p></em></h3>
				
			<div id ="info"> No dudes en enviarnos cualquier otro tipo de duda, evaluación, sugerencia o crítica que te surja pinchando en contacto.
				<br>
			</div>


        </div>
        <?php require('comun/footer.php'); ?>
	</body>
</html>