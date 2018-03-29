<?php 
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro</title>
	<?php session_start(); ?>
</head>

<body>

	<div id="contenedor">

		<?php require ('header.php'); ?>


		<div class="container">
			<h1> ¡Bienvenido, cervecero! </h1>
			<h2> Estás a punto de unirte a BeerEveryday... </h2>
				<div class="form">
	      			<form class="form-style" action="registro.php" method="post">
	          			<ul>
	          			<li>
	          				<label>Username</label>
	          				<input type="text" name="id" required/>
	          			</li>
			            <li>
			              <label>Nombre</label>
			              <input type="text" name="nombre" required autofocus/>
			            </li>
			            <li>
			              <label>Apellidos</label>
			              <input type="text" name="apellidos" value="" required/>
			            </li>
			            <li>
			              <label>Fecha de nacimiento</label>
			              <input type="date" name="fechaNac" placeholder="aaaa/mm/dd" required/>
			            </li>
			            <li>
			              <label>Ciudad</label>
			              <input type="text" name="ciudad" value=""/>
	            		</li>
			            <li>
			              <label>Mail</label>
			              <input type="email" name="mail" placeholder="example123@example.com" required/>
			            </li>
			             <li>
			              <label>Repita mail</label>
			              <input type="email" name="remail" placeholder="Ambos mail deben coindicir" required/>
			            </li>
			            <li>
			              <label>Contraseña</label>
			              <input type="password" name="pass" value="" required/>
			            </li>
			            <li>
			              <label>Repita contraseña</label>
			              <input type="password" name="repass" placeholder="Ambas contraseñas deben coindicir" value="" required/>
			            </li>
			            <li>
			      			<label class="foto_per_label">Foto de perfil</label>
			              <input class="foto_per" type="file" name="avatar" />
			            
			            </li>
			            <li>
			            	<label>¿Qué rol desea adoptar? </label> <br>
			            	<form>
			            		<input type="radio" name="rol" value="registrado" checked> Registrado <br>
			            		<input type="radio" name="rol" value="vendedor"> Vendedor <br>			            		
			            	</form>
			            </li>
			            <li>
			              <button class="submit" type="submit">Registrarte</button>
			            </li>
			            <li>
			              <button type="reset">Reestablecer</button>
			            </li>

			            <li>
			            	<p>Al hacer clic en "Registrarte", aceptas los
			            	<a href="terminos.php"> términos y condiciones del servicio </a> y confirmas que has leído nuestra
			            	<a href="politicadeprivacidad.php"> Política de privacidad. </a> </p>
			            </li>

	          			</ul>
	    			</form>
			
		</div>
	

		<?php require('footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>