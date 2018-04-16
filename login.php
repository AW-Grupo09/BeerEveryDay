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
						<legend>Usuario y contraseña</legend>
						<p><label>Nombre de usuario:</label> <input type="text" name="username"></p>
						<p><label>Contraseña:</label> <input type="password" name="password"><br></p>
						<button type="submit">Entrar</button>
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