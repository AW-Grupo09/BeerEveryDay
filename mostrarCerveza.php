<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/cervezas.php';
	//include('logica/cervezas.php');
	global $sql;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/mostrarCerveza.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<meta charset="utf-8">
	
	<title>Cervezas</title>

<?php
	$mysqli = conexion::getConection();
	$id = htmlspecialchars($_GET['id']);
	$cerveza = new cervezas($id, $mysqli);
?>

	
</head>

<body>

	<div id="contenedor"> <!-- Contenedor-->

		<?php require ('includes/comun/header.php'); ?>

		<div class="container"><!--bloque del contenido central-->
					
			
<?php
			echo "<div class= 'mostrarCerveza'>";
			echo "<div class= 'nombreCerveza'>";
			echo "<h1> ". $cerveza->getIdCerveza() . " - " . $cerveza->getNombre(). " </h1>";
			echo "</div>";// cierro div nombre
			echo "<div class= 'contenidoCerveza'>";
			echo "<div class= 'imagenCerveza'>";
			echo "<img alt='Imagen de cerveza' src=". $cerveza->getImagen()." width='300' height='300' />";
			echo "</div>";// cierro div imagen
			echo "<div class= 'datosCerveza'>";
			echo "<p>" . " <span>Capacidad : </span>". $cerveza->getCapacidad(). " Cl" ."</p>";
			echo "<p>" . " <span>Color : </span>". $cerveza->getColor() ."</p>";
			echo "<p>" . " <span>Tipo : </span>". $cerveza->getTipo() ."</p>";
			echo "<p>". " <span>Graduación : </span>". $cerveza->getGrado() . " % "."</p>";
			echo "<p>". " <span>Ingredientes : </span>". $cerveza->getGrano() ."</p>";
			echo "<p>"." <span>País : </span>" . $cerveza->getPais()."</p>";
			echo "<p>" . " <span>Precio : </span>". $cerveza->getPrecio(). " € ". "</p>";
			echo "</div>";//cierro div datosCerveza

			if(isset($_SESSION['login']) && $_SESSION['login']){
				echo '<form  action="logica/procesarCesta.php" method="GET">';
			/*	$cantidad = array("0" , "1" , "2" , "3");
						echo ' Cantidad: <select name="cantidad">';
							foreach ($cantidad as $i => $v) {
								if($_POST['cantidad'] == $i){
									echo '<option value="'.  $i .'" selected="true">' . $i . '</option>';
									if(strcmp($v, "") != 0){
										$sql = $sql . 'and ' . $v;
									}
								}else{
									echo '<option value="'.  $i .'">' . $i . '</option>';
								}
							}
						echo '</select>';
			*/	echo '<input type="number" name="unidades" min=1 placeholder="Unidades">';
				//echo '<input type="submit" name="cerveza" value="'. $cerveza->getIdCerveza().'" placeholder="Añadir a la cesta""> ';
				echo '<button class="submit" type="submit" name="cerveza" value="'. $cerveza->getIdCerveza().'">Añadir a la cesta
				</button>';
				echo '</form>';
			}
			echo "</div>";//cierro div contenidoCerveza
			echo "</div>";//cierro div mostrarCerveza
?>
		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>