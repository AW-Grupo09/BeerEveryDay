<?php
include('logica/TUsuario.php');

if(!isset($_SESSION["user"])) {
	$_SESSION["user"] = NULL;
}
if(!isset($_SESSION["LogginFailed"]))
	$_SESSION["LogginFailed"] = false;
if(!isset($_SESSION["logged"]))
	$_SESSION["logged"] = false;


if($_SESSION["logged"])
	echo $_SESSION["user"];
else
	echo "Not logged";
?>
<div class = "toolbar">
	<p><a href = 'index.php'> Home </a></p>
	<p><a href = 'registrate.php'> Register </a></p>
	<p><a href = 'catalogo.php'> Catalogo </a></p>
	<p><a href = 'login.php'> Login </a></p>
	<p><a href = 'perfil.php'> Perfil </a></p>
	<p><a href = 'logout.php'> Logout </a></p>
</div>