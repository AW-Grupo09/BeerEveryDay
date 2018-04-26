<?php

if(!isset($_SESSION["user"])) {
	$_SESSION["user"] = NULL;
}
if(!isset($_SESSION["LoginFailed"]))
	$_SESSION["LoginFailed"] = false;
if(!isset($_SESSION["logged"]))
	$_SESSION["logged"] = false;

?>
<link rel="icon" href="img/favicon.jpeg" type="image/ico">

<div class="header">
	<div id = "up">
		<div id="titulo">
			<a href="index.php"> <img src="./img/logo.png"/> </a>
		</div>
		
		<div id="login">

			<?php 

			if($_SESSION["logged"])
				echo "Hola " . $_SESSION["user"] . "";
			else
				echo "No has iniciado sesión";

			if(isset($_SESSION["user"])&&($_SESSION["user"] == true)){ ?>

				<a href = 'perfil.php'> Perfil </a> 
				<a href = 'logout.php'> Salir </a> 

			<?php } else { ?>
				<a href = 'login.php'> Login </a> 
				<a href = 'registrate.php'> Regístrate </a> 
				
			<?php } ?>

		</div>

	</div>
		
	<id id = "items">
		<a id="item" href = 'index.php'> Home </a>
		<a id="item" href = 'catalogo.php'> Catálogo </a> 
		<a id="item" href = 'grupos.php'> Grupos </a> 
		<a id="item" href = 'mostrarCesta.php'> Mi cesta </a>
			
	</id>

</div> <!-- Cierre de header-->

