<?php 

	include('conexion.php');
	include('cerveza.php');
	include('pedido.php');

	if(!isset($_SESSION["deleteCesta"])
		$deleteCesta = false;
	else
		$deleteCesta = $_SESSION["deleteCesta"];

	if(isset($_SESSION["deleteElem"]))
		$deleteElem = false;
	else
		$deleteElem = $_SESSION["deleteElem"];

	$Cerv = $_GET["cerveza"];
	$Unids = $_GET["unidades"];

	$idCesta = pedidos::loadCesta($_SESSION["user"]);

	//Comprobamos si quieren borrar la cesta
	if($deleteCesta)
		//Queremos eliminar la cesta, y comprobamos previamente que tenemos la cesta
		if($idCesta != NULL)
			pedidos::eliminarPedido($idPedido);	
	else{
		//Comprobamos si quieren borrar algun elemento
		if($deleteElem){
		 	//Queremos eliminar un elemento de la cesta
			pedidos::eliminarElementoCesta($Cerv, $idCesta);
		 	
		}
		else{
			//Si no es ninguna de las dos, es porque se quiere aniadir algo a la cesta
			//Comprobamos si ya hay una inicializada para inicializarla o no
			if($idCesta != NULL)
				pedidos::addBeers($Cerv, $Unids, $idCesta);
			else
			 	pedidos::iniciarCesta($Cerv, $Unids);
		}
	}


	if($deleteElem)
		header('Location: ../mostrarCesta.php');
	else if ($deleteCesta)
		header('Location: ../index.php');
	else
		header('Location: ../catalogo.php')


?>