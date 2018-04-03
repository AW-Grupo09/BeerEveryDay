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