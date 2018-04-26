<?php
	session_start();
	if(!isset($_SESSION["logged"]))
		$_SESSION["logged"] = false;
	else{
		if($_SESSION["logged"])
			header('Location: index.php');
	}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/login.css" />
	<title> Login </title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>

	<div id="contenedor">

		<?php require ('comun/header.php'); ?>

		<div class="container">
			<?php 
			if($_SESSION["user"] == NULL){
				?>
				<form action="logica/procesarLogin.php" method="POST">
						<fieldset>
						<legend> Formulario de inicio de sesión: </legend>

						<div class="imgcontainer">
					   		<img src="img/users/default.png" alt="Avatar" class="avatar">
					    </div>

						
						<label for="username"><b>Nombre de usuario: </b></label>
					    <input type="text" placeholder="Introduzca aquí el nombre de usuario" name="username" required>


						<!--<p><label>Contraseña:</label> <input type="password" name="password"><br></p>-->
						<label for="password"><b>Contraseña: </b></label>
					    <input type="password" placeholder="Introduzca aquí la contraseña" name="password" required>


						<p><button type="submit">Entrar</button></p>

						<!--<label>
					      <input type="checkbox" checked="checked" name="remember"> Recuérdame
					    </label>-->

					    <div>
						    <!--<button type="button" class="cancelbtn">Atrás</button>-->
						    <input type="button" value="Atrás" class="atrasbtn" onclick = "location='./index.php'"/>
						    
						    <span class="psw">Has olvidado tu <a href="#">contraseña?</a></span>
						</div>

					</fieldset>
				</form>

				<?php 
				if($_SESSION["LoginFailed"])
					echo "<p>Contraseña o usuario incorrectos<p>";
					$_SESSION["LoginFailed"] = false;
			}
			else{
				//<script> window.location.replace("index.php");</script>
				?>
				<?php
			}
			?>
		</div>


		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>