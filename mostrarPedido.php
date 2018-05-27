<?php 

	session_start();
	require_once __DIR__.'/includes/Controller/controllerPedidos.php';
	require_once __DIR__.'/includes/Controller/controllerCervezas.php';
	require_once __DIR__.'/includes/TO/TOPedidos.php';
	require_once __DIR__.'/includes/TO/TOCervezas.php';
	require_once __DIR__.'/includes/FormularioPedido.php';

	if(!$_SESSION['login']){
			header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/mostrarPedido.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<title>Cesta</title>

</head>

<body>

	<div id="contenedor">

		<?php require ('includes/comun/header.php'); ?>
		<div class="container">
			
			<?php
				$pedido = null;

				if(isset($_GET['idPedido'])){
					$pedido = controllerPedidos::loadPedido($_GET['idPedido']);
				}else {
					echo "<div><p>Error: No se ha seleccionado el pedido</p></div>";
				}

						
				if($pedido == null){
					if(isset($_GET['idPedido'])){
						echo "<div><p>Error: El pedido " . $GET['idPedido'] . " no existe o no se ha encontrado<p></div>";
					}
				}else {

					if(sizeof($pedido->getCervezas()) > 0) {
						$cervezas = $pedido->getCervezas();
						$unidades = $pedido->getUnidades();
						$i = 0;
						$total = 0;

						echo "<div class='infoPedido'>";
						echo "<h2> DATOS GENERALES DEL PEDIDO </h2>";
						echo "<p> Id del pedido: " . $_GET['idPedido'] . "</p>";
						echo "<p> Su estado es: " . $pedido->getEstado() . "</p>";
						echo "<p> Fecha pedido: " . $pedido->getFechaPedido() . "</p>";
						echo "<p> Dirección de entrega: " . $pedido->getDir() . "</p>";
						echo "</div>";

						echo "<div>";
						foreach ($cervezas as $idCerveza) {
							$cerveza = controllerCervezas::loadCerveza($idCerveza);
							echo "<div class= 'mostrarCerveza'>";
								echo "<div class= 'nombreCerveza'>";
									echo "<h1>" . $cerveza->getNombre() . "</h1>";
								echo "</div>";// cierro div nombre
								echo "<div class= 'contenidoCerveza'>";
									echo "<div class= 'imagenCerveza'>";
										echo "<img alt='Imagen de cerveza' src=". $cerveza->getImagen()." width='300' height='300' />";
									echo "</div>";// cierro div imagen
									//Datos de la cerveza
									echo "<div class= 'datosCerveza'>";
										echo "<p>DESCRIPCIÓN DEL PRODUCTO: </p>";
										echo "<p>" . " <span>Capacidad : </span>". $cerveza->getCapacidad(). " Cl" ."</p>";
										echo "<p>" . " <span>Color : </span>". $cerveza->getColor() ."</p>";
										echo "<p>" . " <span>Tipo : </span>". $cerveza->getTipo() ."</p>";
										echo "<p>". " <span>Graduación : </span>". $cerveza->getGrado() . " % "."</p>";
										echo "<p>". " <span>Ingredientes : </span>". $cerveza->getGrano() ."</p>";
										echo "<p>"." <span>País : </span>" . $cerveza->getPais()."</p>";
										echo "<p>" . " <span>Precio : </span>". $cerveza->getPrecio(). " € ". "</p>";
									echo "</div>";//cierro div datos cerveza
									//Datos del pedido
									echo "<div class= 'datosCerveza'>";
										echo "<p>DATOS DEL PEDIDO:</p>";
										echo "<p><span>Precio unidad: </span>" . $cerveza->getPrecio() . " €</p>";
										echo "<p><span>Unidades: </span>" . $unidades[$i] . "</p>";
										echo "<p><span>Total: </span>" . $cerveza->getPrecio() * $unidades[$i] . " €</p>";
									echo "</div>";//cierro div datosCerveza 
									$total = $total + ($cerveza->getPrecio()*$unidades[$i]);
								echo "</div>";//cierro div contenidoCerveza
							echo "</div>";//cierro div mostrar cerveza
							$i++;
						}

						echo "<h1 align='right'>Total: " . $total . " €</h1>";
						echo "</div>";

					}else {
						echo "<div><h2>Error: El pedido no tiene ninguna cerveza.<h2></div>";
					}
				}
			?>
		
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div>
	

</body>
</html>