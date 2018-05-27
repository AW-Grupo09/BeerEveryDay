<?php 
	session_start();
	require_once __DIR__ .'/includes/FormularioModificaAvatar.php';
	require_once __DIR__ .'/includes/Controller/controllerUsuario.php';
	require_once __DIR__.'/includes/TO/TOUsuarios.php';

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
		<?php
			$user = controllerUsuario::buscaUsuario($_SESSION['nombreUsuario']);
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
					if($user->getAvatar() != "img/users/")
						echo "<img src='" . $user->getAvatar() . " ' alt = 'Imagen de perfil'>"; 
					else
						echo '<img src="img/users/default.png">'; 
					$_SESSION['avatar'] = $user->getAvatar();
				?>
			</div>

		</div>



		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Cierre del contenedor -->
		
</body>
</html>