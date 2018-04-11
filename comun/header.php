<?php

if(!isset($_SESSION["user"])) {
	$_SESSION["user"] = NULL;
}
if(!isset($_SESSION["LoginFailed"]))
	$_SESSION["LoginFailed"] = false;
if(!isset($_SESSION["logged"]))
	$_SESSION["logged"] = false;


if($_SESSION["logged"])
	echo "<h2>Hola " . $_SESSION["user"] . "</h2>";
else
	echo "<h2>No has iniciado sesión</h2>";
?>
<link rel="icon" href="img/favicon.jpeg" type="image/ico">
<div nav = "toolbar">
	<a href = 'index.php'> Home </a>
	<a href = 'catalogo.php'> Catálogo </a>	
	
<?php if(isset($_SESSION["user"])&&($_SESSION["user"] == true)){ ?>
	<a href = 'perfil.php'> Perfil </a>
	<a href = 'logout.php'> Salir </a>
<?php } else { ?>
	<a href = 'login.php'> Login </a>
	<a href = 'registrate.php'> Regístrate </a>
<?php } ?>
	
</div>