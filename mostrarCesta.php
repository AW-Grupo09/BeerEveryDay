<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/controlPedidos.php';
	require_once __DIR__.'/includes/pedidos.php';
	require_once __DIR__.'/includes/cervezas.php';
	require_once __DIR__.'/includes/FormularioPedido.php';


	/*include('includes/usuario.php');
	include('includes/pedidos.php');
	include('includes/cervezas.php');*/

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
				$idCesta = controlPedidos::loadCesta($_SESSION["nombreUsuario"]);

				if(isset($_POST['Eliminar'])){
					controlPedidos::eliminarCesta($idCesta);
					$idCesta = null;
				}
						
				if($idCesta == null){
					echo "<div><h1>Tu cesta está vacía.<h1></div>";
				}else {
					$cesta = controlPedidos::loadPedido($idCesta);

					/*foreach ($cesta->getCervezas() as $idCerveza) {
						if(isset($_POST[$idCerveza])){
							controlPedidos::eliminarElementoCesta($idCerveza, $idCesta);
							$cesta = controlPedidos::loadPedido($idCesta);
						}
					}*/
					if(sizeof($cesta->getCervezas()) > 0) {
						$cervezas = $cesta->getCervezas();
						$unidades = $cesta->getUnidades();
						$i = 0;
						$total = 0;

						echo "<div>";
						foreach ($cervezas as $idCerveza) {
							$cerveza = new cervezas($idCerveza);
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
										echo "<button class='submit' type='submit' name='" . $idCerveza . "' value='Eliminar'>Eliminar de la cesta</button>";
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
						controlPedidos::eliminarCesta($idCesta);
						echo "<div><h1>Tu cesta está vacía.<h1></div>";
					}
				}
			?>
		
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div>

<script>
function myFunction() {
    var x = document.getElementById("procesarCesta");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
	

</body>
</html>
