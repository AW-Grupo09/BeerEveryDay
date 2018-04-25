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
	<div id = "toolbar">
		<div id = "items">
			<h3> <a href = 'index.php'> Home </a></h3>
			<h3> <a href = 'catalogo.php'> Catálogo </a> </h3>
			<h3> <a href = 'mostrarCesta.php'> Cesta </a> </h3>
			<h3> <a href = 'mostrarCesta.php'> Grupos </a> </h3>
		</div>

		<div id="titulo">
			<img src="./img/logo.png">
		</div>

		<div id = "login">
			<?php 
			if($_SESSION["logged"])
				echo "<h3>Hola " . $_SESSION["user"] . "</h3>";
			else
				echo "<h3>No has iniciado sesión</h3>";

			if(isset($_SESSION["user"])&&($_SESSION["user"] == true)){ ?>
				<h3> 
					<a href = 'perfil.php'> Perfil </a> 
					<a href = 'logout.php'> Salir </a> 
				</h3>
			<?php } else { ?>
				<h3>
					<a href = 'login.php'> Login </a> 
					<a href = 'registrate.php'> Regístrate </a> 
				</h3>
			<?php } ?>
		</div>

	</div>
</div>
