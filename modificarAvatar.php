<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__ .'/includes/FormularioModificaAvatar.php';

    if(!$_SESSION['login']){
		header('Location: index.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
		<title>Modifica usuario</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css"/>
		<link rel="stylesheet" type="text/css" href="css/perfil.css" />
		<meta charset="utf-8"/>	
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
		<script type="text/javascript" src="js/guardaCambios.js"></script>
		<?php
			$user = Usuario::buscaUsuario($_SESSION['nombreUsuario']);
		?>
</head>

<body>
		<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>
	
		<div class="container">

			<?php   
				$opciones = array();

				$formulario = new FormularioModificaAvatar("formModificaAvatar", $opciones);
				$formulario->gestiona();

			?>

			<div class = "avatarMod">
				<?php 
					if($user->avatar() != NULL)
						echo "<img src='" . $user->avatar() . " ' alt = 'Imagen de perfil'>"; 
					else
						echo "<img src='/img/users/default.png' alt = 'Imagen de perfil'>"; 
				?> 
			</div>

		</div>



		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Cierre del contenedor -->
		
</body>
</html>