<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/cervezas.php';
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
	//$mysqli = conexion::getConection();
	//$id = htmlspecialchars($_GET['id']);
	$cerveza = new cervezas($_GET['id']);
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
				echo '<form  action="includes/procesarCesta.php" method="GET">';			
				echo '<input type="number" name="unidades" min=1 placeholder="Unidades">';
				echo '<button class="submit" type="submit" name="cerveza" value="'. $cerveza->getIdCerveza().'">Añadir a la cesta</button>';
				echo '</form>';
			}
			echo "</div>";//cierro div contenidoCerveza
			echo "</div>";//cierro div mostrarCerveza

			
			//Formulario para aniadir comentario
			if(isset($_SESSION['login']) && $_SESSION['login']){
				$opciones = array();
				$addToForm = array( 'idCerveza' => $cerveza->getIdCerveza() );
	        	$opciones = array_merge($addToForm, $opciones);
				$formulario = new FormularioSubirCerveza("FormSubirCerveza", $opciones);
				$formulario->gestiona();
			}
?>
		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>