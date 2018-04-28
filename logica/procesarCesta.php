<?php 

	//require_once __DIR__.'../includes/config.php';
	require_once '../includes/config.php';
	include('conexion.php');
	include('cervezas.php');
	include('pedidos.php');

	$deleteCesta;
	$deleteElem;

	if(!isset($_GET["deleteCesta"]))
		$deleteCesta = false;
	else
		$deleteCesta = $_GET["deleteCesta"];

	if(!isset($_GET["deleteElem"]))
		$deleteElem = false;
	else
		$deleteElem = $_GET["deleteElem"];

	if(!isset($_GET["cerveza"]))
		$Cerv= NULL;
	else
		$Cerv= $_GET["cerveza"];

	if(!isset($_GET["unidades"]))
		$Unids = 1;
	else
		$Unids = $_GET["unidades"];


	$mysqli = conexion::getConection();
	$idCesta = pedidos::loadCesta($_SESSION["nombreUsuario"], $mysqli);

	//Comprobamos si quieren borrar la cesta
	if($deleteCesta){
		//Queremos eliminar la cesta, y comprobamos previamente que tenemos la cesta
		if($idCesta != NULL)
			pedidos::eliminarPedido($idPedido, $mysqli);	
	}
	else{
		//Comprobamos si quieren borrar algun elemento
		if($deleteElem){
		 	//Queremos eliminar un elemento de la cesta
			pedidos::eliminarElementoCesta($Cerv, $idCesta, $mysqli);
		 	
		}
		else{
			//Si no es ninguna de las dos, es porque se quiere aniadir algo a la cesta
			//Comprobamos si ya hay una inicializada para inicializarla o no
			if($Cerv == NULL)
				echo "<p>Ha habido un problema con la cerveza que ha intentado añadir a la cesta<p>";
			if($idCesta != NULL){
				echo "se da la cesta por iniciada";
				pedidos::addBeers($Cerv, $Unids, $idCesta, $mysqli);
			}
			else{
				echo "Se inicia cesta";
			 	pedidos::iniciarCesta($Cerv, $Unids, $mysqli);
			 }
		}
	}
	echo $Cerv, $Unids;
/*
	if($deleteElem)
		header('Location: ../mostrarCesta.php');
	else if ($deleteCesta)
		header('Location: ../index.php');
	else
		header('Location: ../catalogo.php')
*/

?>