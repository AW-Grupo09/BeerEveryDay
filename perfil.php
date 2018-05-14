<?php 
	/*include('logica/conexion.php');
	include('logica/usuario.php');*/

	require_once __DIR__.'/includes/config.php';
    include('includes/Usuario.php');

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
	<meta charset="utf-8">
	<?php
		$user = Usuario::buscaUsuario($_SESSION['nombreUsuario']);
	?>
	<title>Perfil</title>

</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>

		<center>

		<div class="container"><!--bloque del contenido central-->
			

			<div class = avatar>
				<?php 
					if($user->avatar() != NULL)
						echo "<img width='10%' height='10%' src='" . $user->avatar() . " ' alt = 'Imagen de perfil'>"; 
					else
						echo "<img width='10%' height='10%' src='img/users/default.png' alt = 'Imagen de perfil'>"; 
					$_SESSION['avatar'] = $user->avatar();
				?> 
			</div>

			<div class = nickname>
				<p>User: <?php echo $user->nombreUsuario();?></p>
			</div>

			<div class = userData>
				<p>Nombre: <?php echo $user->nombre();?></p>
				<p>Apellidos: <?php echo $user->apellidos();?></p>
				<p>Ciudad: <?php echo $user->ciudad();?></p>
				<?php 
				$fecha = $user->fechaNac();
				?>
				<p>Fecha de nacimiento: <?php echo date("d-m-Y",strtotime($fecha)) ;?></p>
			
			</div>
			<a id="item" href = 'listaPedidos.php'> Mis pedidos </a>

			<a id="item" href = "modificarPerfil.php"> Modificar perfil</a>

		</div>
		</center>

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->	

</body>
</html>