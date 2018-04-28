<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/logica/pedidos.php';
	require_once __DIR__.'/logica/cervezas.php';
	/*include('logica/usuario.php');
	include('logica/pedidos.php');
	include('logica/cervezas.php');*/

	if(!$_SESSION['login']){
			header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<title>Cesta</title>

</head>

<body>

	<div id="contenedor">

		<?php require ('includes/comun/header.php'); ?>
		<div class="container">
			
			<?php
				$idCesta = pedidos::loadCesta($_SESSION["nombreUsuario"]);

				if(isset($_POST['Eliminar'])){
					pedidos::eliminarCesta($idCesta);
					$cesta = null;
				}
						
				if($idCesta == null){
					echo "<div><h1>Tu cesta está vacía.<h1></div>";
				}else {
					$cesta = new pedidos($idCesta);

					foreach ($cesta->getCervezas() as $idCerveza) {
						if(isset($_POST[$idCerveza])){
							pedidos::eliminarElementoCesta($idCerveza, $idCesta);
							$cesta = new pedidos($idCesta);
						}
					}
					if(sizeof($cesta->getCervezas()) > 0) {
						$cervezas = $cesta->getCervezas();
						$unidades = $cesta->getUnidades();
						$i = 0;
						$total = 0;

						echo "<div>";
						foreach ($cervezas as $idCerveza) {
							$cerveza = new cervezas($idCerveza);
							echo "<div>";
								echo "<form action='mostrarCesta.php' method='post'>";
									echo "<img alt='Imagen de cerveza' src=". $cerveza->getImagen()." width='200' height='200' />";
									echo "<p>" . $cerveza->getNombre() . "</p>";
									echo "<p>Precio unidad: " . $cerveza->getPrecio() . " €</p>";
									echo "<p>Unidades: " . $unidades[$i] . "</p>";
									echo "<p>Total: " . $cerveza->getPrecio() * $unidades[$i] . " €</p>";
									$total = $total + ($cerveza->getPrecio()*$unidades[$i]);
									echo "<input type='submit' name='" . $idCerveza . "' value='Eliminar'>";
								echo "</form>";
							echo "</div>";
							$i++;
						}
						echo "<h1>Total: " . $total . " €</h1>";
						echo "<form action='mostrarCesta.php' method='post'>";
								echo "<input type='submit' name='Eliminar' value='Eliminar cesta'>";
						echo "</form>";
						echo "</div>";
					}else {
						pedidos::eliminarCesta($idCesta);
						echo "<div><h1>Tu cesta está vacía.<h1></div>";
					}
				}
			?>
		
		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div>

	

</body>
</html>
