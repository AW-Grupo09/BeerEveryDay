<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>login</title>
	<?php session_start(); ?>
</head>

<body>

	<div id="contenedor">

		<?php require ('header.php'); ?>


		<div class="container">
			<?php 
			if($_SESSION["user"] == NULL){
				?>
				<form action="logica/ProcesarLogin.php" method="POST">
						<fieldset>
						<legend>Usuario y contraseña</legend>
						<p><label>Name:</label> <input type="text" name="username"></p>
						<p><label>Password:</label> <input type="password" name="password"><br></p>
						<button type="submit">Entrar</button>
						</fieldset>
				</form>
				<?php 
				if($_SESSION["LogginFailed"])
					echo "<p>Contraseña o usuario incorrectos<p>";
			}
			else{
				?>
				<script type="text/javascript"> window.location.replace("index.php");</script>
				<?php
			}
			?>
		</div>
		

		<?php require('footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>