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
	<script type="text/javascript" src="js/javascript.js"></script>
	<title>Mi cesta</title>
</head>

<body>

	<div id="contenedor">

		<?php require ('includes/comun/header.php'); ?>
		<div class="container">
			
			<?php
				$cesta = controllerPedidos::loadCesta($_SESSION["nombreUsuario"]);

				if(isset($_POST['Eliminar'])){
					controllerPedidos::eliminarCesta($cesta->getIdPedido());
					$cesta = null;
				}
						
				if($cesta == null){
					echo "<div><h1>Tu cesta está vacía.<h1></div>";
				}else {
					//$cesta = controllerPedidos::loadPedido($idCesta);

					foreach ($cesta->getCervezas() as $idCerveza) {
						if(isset($_POST[$idCerveza])){
							controllerPedidos::eliminarElementoCesta($idCerveza, $cesta->getIdPedido());
							$cesta = controllerPedidos::loadPedido($cesta->getIdPedido());
						}
					}
					if($cesta == null){
						echo "<div><h1>Tu cesta está vacía.<h1></div>";
					}
					else if(sizeof($cesta->getCervezas()) > 0) {
						$cervezas = $cesta->getCervezas();
						$unidades = $cesta->getUnidades();
						$i = 0;
						$total = 0;

						echo "<div>";
						foreach ($cervezas as $idCerveza) {
							$cerveza = controllerCervezas::loadCerveza($idCerveza);
							echo "<div class= 'mostrarCerveza'>";
								echo "<div class= 'nombreCerveza'>";
									echo "<h1>" . $cerveza->getNombre() . "</h1>";
								echo "</div>";//nombre Cerveza
								echo "<div class= 'contenidoCerveza'>";
									echo "<div class= 'imagenCerveza'>";
										echo "<img alt='Imagen de cerveza' src=". $cerveza->getImagen()." width='300' height='300' />";
									echo "</div>";//imagen cerveza
										//Datos del pedido
									echo "<div class= 'datosCerveza'>";
										echo "<p>Datos del pedido: </p>";
										echo "<p><span>Precio unidad: </span>" . $cerveza->getPrecio() . " €</p>";
										echo "<p><span>Unidades: </span>" . $unidades[$i] . "</p>";
										echo "<p><span>Total: </span>" . $cerveza->getPrecio() * $unidades[$i] . " €</p>";
									echo "</div>";//cierro div datos cerveza
									echo "<form action='mostrarCesta.php' method='post'>";
										$total = $total + ($cerveza->getPrecio()*$unidades[$i]);
										echo "<button class='delete' type='submit' name='" . $idCerveza . "' value='Eliminar'>Eliminar de la cesta</button>";
									echo "</form>";
								echo "</div>";//contenidocerveza
							echo "</div>";//mostrar cerveza
							$i++;
						}
						echo "<div class='right'><h1 align='right'>Total: " . $total . " €</h1></div>";
						echo "<div class='left'><form action='mostrarCesta.php' method='post' align='right'>";
								echo "<button class='submit' type='submit' name='Eliminar' value='Eliminar cesta'>Eliminar la cesta</button>";
						echo "</form></div>";
						echo "</div>";
						?>
						<button class='submit' onclick="myFunction()">Comprar la cesta</button>
							<div id="procesarCesta">

								<?php 
									$opciones = array();

									$formulario = new FormularioPedido("formPed", $opciones);
									$formulario->gestiona();

								?>

							</div> 
						<?php
					}else {
						controllerPedidos::eliminarCesta($cesta->getIdPedido());
						echo "<div><h1>Tu cesta está vacía.<h1></div>";
					}
				}
			?>
		
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div>

</body>
</html>
