<?php 
	session_start();

    if(!$_SESSION['login']){
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="css/admin.css" />
	<meta charset="utf-8">
	<title>Admin</title>

</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>

		<div class="container"><!--bloque del contenido central-->

				<div class = "vistaAdmin">
					<fieldset>
						<h2> ¡BIENVENIDO, <?php echo $_SESSION['nombreUsuario']; ?>!</h2>
						<p>Esta vista es exclusiva para los administradores de la aplicación web.</p>
						<p>En ella podrás encontrar todas aquellas opciones que solo un administrador puede llevar a cabo </p>
						<form action="vistaAddBeers.php">
							<label> <button> Añadir cerveza</button> </label>
						</form>
					</fieldset>
				</div>
		</div>


		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->	

</body>
</html>