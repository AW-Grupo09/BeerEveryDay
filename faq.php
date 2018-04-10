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
		<h2>FAQ - Preguntas y dudas frecuentes:</h2>
			<a href = "#who">1. ¿Quienes somos?</a>
			<a href = "#register">2. ¿Como me puedo dar de alta?</a>
			<a href = "#num">3. ¿Puedo tener más de una cuenta?</a>
			<a href = "#filter">4. ¿Como uso el filtro del Catálogo?</a>
			<a href = "#info">5. ¿Alguna duda más?</a>
				
			<h3><p id="who">1. ¿Quienes somos?</p></h3>
				
			<div id ="who"> Somos un grupo de 7 estudiantes de la asignatura AW de Ingeniería Informática de la UCM enamorados de la cerveza que intentamos hacer más facil a todos el acceso a grandes marcas artesanales, nacionales e internacionales.
			</div>


			<h3><p id="register">2. ¿Como me puedo dar de alta?</p></h3>
				
			<div id ="register" > Tan solo has de pinchar en Register y rellenar tus datos personales para que podamos
			dirigirnos a tí como es debido. 
			No olvides especificar el rol que deseas adoptar o bien Registrado para realizar tus compras o bien
			VendedorNo olvides que al hacer clic en "Registrarte", aceptas los
			<a href="terminos.php"> términos y condiciones del servicio </a> y confirmas que has leído nuestra
			<a href="politicadeprivacidad.php"> Política de privacidad. </a>
				
			</div>

			
			<h3><p id="num">3. ¿Puedo tener más de una cuenta?</p></h3>
				
			<div id ="num" >Puedes tener más de una cuenta siempre y cuando utilices un correo distinto y distintas credenciales para identificarte sin embargo no es recomendable y aconsejamos una sola cuenta por cada usuario.
				
			</div>


			<h3><p id="filter">4. ¿Como uso el filtro del catálogo</p></h3>
				
			<div id ="filter"> Filtra tus cervezas en función de tus gustos: Artesanas, Nacionales o por numero de graduación, puedes marcar tantos checkbox como quieras, además puedes ordenar tus resultados por numero de ventas o por precio.
			
			También puedes elegirlas por su color o por sus ingredientes. Una vez marcadas las opciones deseadas dar a "enviar"
			y los resultados apareceran a continuación.
				
			</div>



			<h3><p id="log">5. ¿Como accedo a mi cuenta tras mi registro?</p></h3>
				
			<div id ="log"> Tan solo has de acudir a perfil o login y pinchar en cualquiera de ambas, allí encontras dos campos uno para introducir tu nombre de usuario y otro para la contraseña que metiste a la hora de hacer el registro.
				
			</div>


			<h3><p id="info">6. ¿Alguna duda más?</p></h3>
				
			<div id ="info"> No dudes en enviarnos cualquier otro tipo de duda, evaluación, sugerencia o crítica que te surja pinchando en contacto.
				
			</div>


        </div>
        <?php require('comun/footer.php'); ?>
	</body>
</html>