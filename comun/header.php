<?php

if(!isset($_SESSION["user"])) {
	$_SESSION["user"] = NULL;
}
if(!isset($_SESSION["LoginFailed"]))
	$_SESSION["LoginFailed"] = false;
if(!isset($_SESSION["logged"]))
	$_SESSION["logged"] = false;


if($_SESSION["logged"])
	echo "Welcome " . $_SESSION["user"];
else
	echo "Not logged";
?>
<link rel="icon" href="img/favicon.jpeg" type="image/ico">
<div nav = "toolbar">
	<a href = 'index.php'> Home </a>
	<a href = 'catalogo.php'> Catalogo </a>	
	<a href = 'perfil.php'> Perfil </a>
<?php if(isset($_SESSION["user"])&&($_SESSION["user"] == true)){ ?>
	<a href = 'logout.php'> Logout </a>
<?php } else { ?>
	<a href = 'login.php'> Login </a>
	<a href = 'registrate.php'> Register </a>
<?php } ?>
	
</div>