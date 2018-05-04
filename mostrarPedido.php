<?php 

	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/pedidos.php';
	require_once __DIR__.'/includes/cervezas.php';
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
					$pedido = new pedidos($_GET['idPedido']);
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

						echo "<div>";
						foreach ($cervezas as $idCerveza) {
							$cerveza = new cervezas($idCerveza);
							echo "<div>";

								echo "<img alt='Imagen de cerveza' src=". $cerveza->getImagen()." width='200' height='200' />";
								echo "<p>" . $cerveza->getNombre() . "</p>";
								echo "<p>Precio unidad: " . $cerveza->getPrecio() . " €</p>";
								echo "<p>Unidades: " . $unidades[$i] . "</p>";
								echo "<p>Total: " . $cerveza->getPrecio() * $unidades[$i] . " €</p>";
								$total = $total + ($cerveza->getPrecio()*$unidades[$i]);

							echo "</div>";
							$i++;
						}

						echo "<h1>Total: " . $total . " €</h1>";
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