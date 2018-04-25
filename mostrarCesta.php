<?php 
	include('logica/conexion.php');
	include('logica/usuario.php');
	include('logica/pedidos.php');
	include('logica/cervezas.php');
	if(!isset($_SESSION["logged"]))
		$_SESSION["logged"] = false;
	else{
		if(!$_SESSION["logged"])
			header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<?php
		$mysqli = conexion::getConection();
		$user = new usuario($_SESSION["user"], $mysqli);
	?>
	<title>Cesta</title>

</head>

<body>

	<div id="contenedor">

		<?php require ('comun/header.php'); ?>
		<div class="container">
			
			<?php
						$mysqli = conexion::getConection();
						$idCesta = pedidos::loadCesta($user->getIdUsuario(),$mysqli);

						if(isset($_POST['Eliminar'])){
							pedidos::eliminarCesta($idCesta, $mysqli);
							$cesta = null;
						}

						if($idCesta == null){
							echo "<div><h1>Tu cesta está vacía.<h1></div>";
						}
						else{
							$cesta = new pedidos($idCesta, $mysqli);

							foreach ($cesta->getCervezas() as $idCerveza) {
								if(isset($_POST[$idCerveza])){
									//echo "<p>" . $idCerveza . "</p>";
									pedidos::eliminarElementoCesta($idCerveza, $idCesta, $mysqli);
									$cesta = new pedidos($idCesta, $mysqli);
								}
							}
							if(sizeof($cesta->getCervezas()) > 0)
							{
								$cervezas = $cesta->getCervezas();
								$unidades = $cesta->getUnidades();
								$i = 0;
								$total = 0;

								echo "<div>";
								foreach ($cervezas as $idCerveza) {
									$cerveza = new cervezas($idCerveza, $mysqli);
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
							}
							else
							{
								pedidos::eliminarCesta($idCesta, $mysqli);
								echo "<div><h1>Tu cesta está vacía.<h1></div>";
							}
						}
					?>
		
		</div>

		<?php require('comun/footer.php'); ?>

	</div>

	

</body>
</html>
