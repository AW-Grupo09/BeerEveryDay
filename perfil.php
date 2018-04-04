<?php 
	include('logica/usuario.php');
	session_start(); 
	if(isset($_SESSION["logged"]))
		if(!$_SESSION["logged"])
			header('Location: login.php');
	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta charset="utf-8">
	<?php
		$mysqli = conexion::getConection();
		User = new usuario($_SESSION["user"], $mysqli);
	?>
	<title>Landing</title>

</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('header.php'); ?>

		<div class="container"><!--bloque del contenido central-->
			
			
			<div class = nickname>
				<p>User: <?php echo $User->getID();?></p>
			</div>

			<div class = UserData>

			</div>

		</div>
		
		<?php require('footer.php'); ?>

	</div> <!-- Fin del contenedor -->

</body>
</html>