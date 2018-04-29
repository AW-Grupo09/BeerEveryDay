<?php 
	
	require_once __DIR__.'/includes/config.php';
	include('logica/pedidos.php');

	if(!$_SESSION['login']){
		header('Location: index.php');
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/pedidos.css" />
	<title> Mis Pedidos</title>

</head>

<body>

	<div id="contenedor">

		<?php require ('includes/comun/header.php'); ?>
		<div class="container">
			
			<?php
							
				$idPedido = pedidos::loadPedidos($_SESSION['nombreUsuario']);
		
						
				if($idPedido == null){

					echo "<p><h2> No tienes pedidos, " . $_SESSION['nombreUsuario'] ." </h2></p>";
					echo " <div class='info'><p><h1> ¿ Por qué no echas un vistazo a nuestro catálogo ? </h1></p></div>";
					echo " <div class='subinfo'><p> Puedes acceder pinchando <a href = 'catalogo.php'>aquí.</a></p></div>";
				}else {
					echo " <h2> Esta es la página donde puedes visualizar tus pedidos,".  $_SESSION['nombreUsuario'] .  ". </h2>";
					

					$numero = sizeof($idPedido);
					echo "<div class ='espaciado'><h1><ul>Tus pedidos son los siguientes: </h1></div>";

					for ($i = 0; $i < $numero; $i++) {
						
					    echo "<p><h2><li>Id del pedido: $idPedido[$i] </li></h2></p>";
					    $pedido = new pedidos($idPedido[$i]);
					    $estado = $pedido->getEstado();
					    echo "Su estado es : $estado  , ";
					    
					    $unidades = $pedido->getUnidades();
					    $numUnidades = array_values($unidades)[0];
					    echo " las unidades pedidas son: $numUnidades";

					    $cervezas = $pedido->getCervezas();
					    $numCerves = array_values($cervezas)[0];;
					    echo " y el identificador de la cerveza es: $numCerves .";
					   
						
					}
					echo "</ul>";
				}


			?>
		
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div>

	

</body>
</html>
