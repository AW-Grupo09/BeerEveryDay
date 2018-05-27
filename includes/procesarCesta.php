<?php 

	session_start();
	require_once '../includes/Controller/controllerPedidos.php';
	require_once '../includes/TO/TOPedidos.php';
	require_once '../includes/TO/TOCervezas.php';


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


	$cesta = controllerPedidos::loadCesta($_SESSION["nombreUsuario"]);

	//Comprobamos si quieren borrar la cesta
	if($deleteCesta){
		//Queremos eliminar la cesta, y comprobamos previamente que tenemos la cesta
		if($cesta != NULL)
			controllerPedidos::eliminarPedido($idPedido);	
	}
	//Comprobamos si quieren borrar algun elemento
	else if($deleteElem){
		 	//Queremos eliminar un elemento de la cesta
			controllerPedidos::eliminarElementoCesta($Cerv, $cesta->getIdPedido());
	}
	else{
			//Si no es ninguna de las dos, es porque se quiere aniadir algo a la cesta
			//Comprobamos si ya hay una inicializada para inicializarla o no
			if($Cerv == NULL)
				echo "<p>Ha habido un problema con la cerveza que ha intentado añadir a la cesta<p>";
			if($cesta != NULL){
				//echo "se da la cesta por iniciada";
				controllerPedidos::addBeers($Cerv, $Unids, $cesta->getIdPedido());
				header('Location: ../mostrarCesta.php');
			}
			else{
				//echo "Se inicia cesta";
			 	controllerPedidos::iniciarCesta($Cerv, $Unids, $_SESSION["nombreUsuario"]);
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