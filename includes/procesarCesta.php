<?php 

	//require_once __DIR__.'../includes/config.php';
	require_once '../includes/config.php';
	require_once '../includes/controlPedidos.php';

	include('cervezas.php');

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


	$idCesta = controlPedidos::loadCesta($_SESSION["nombreUsuario"]);

	//Comprobamos si quieren borrar la cesta
	if($deleteCesta){
		//Queremos eliminar la cesta, y comprobamos previamente que tenemos la cesta
		if($idCesta != NULL)
			controlPedidos::eliminarPedido($idPedido);	
	}
	//Comprobamos si quieren borrar algun elemento
	else if($deleteElem){
		 	//Queremos eliminar un elemento de la cesta
			controlPedidos::eliminarElementoCesta($Cerv, $idCesta);
	}
	else{
			//Si no es ninguna de las dos, es porque se quiere aniadir algo a la cesta
			//Comprobamos si ya hay una inicializada para inicializarla o no
			if($Cerv == NULL)
				echo "<p>Ha habido un problema con la cerveza que ha intentado añadir a la cesta<p>";
			if($idCesta != NULL){
				echo "se da la cesta por iniciada";
				controlPedidos::addBeers($Cerv, $Unids, $idCesta);
				header('Location: ../mostrarCesta.php');
			}
			else{
				echo "Se inicia cesta";
			 	controlPedidos::iniciarCesta($Cerv, $Unids, $_SESSION["nombreUsuario"]);
			 	header('Location: ../mostrarCesta.php');
			 }
		}
	
	
/*
	if($deleteElem)
		header('Location: ../mostrarCesta.php');
	else if ($deleteCesta)
		header('Location: ../index.php');
	else
		header('Location: ../catalogo.php')
*/

?>