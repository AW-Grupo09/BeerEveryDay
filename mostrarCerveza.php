<?php 
	include('logica/conexion.php');
	include('logica/cervezas.php');
	global $sql;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta charset="utf-8">
	
	<title>Cervezas</title>

<?php
	$mysqli = conexion::getConection();
	$id = htmlspecialchars($_GET['id']);
	$cerveza = new cervezas($id, $mysqli);
?>

	
</head>

<body>

	<?php require ('comun/header.php'); ?>

	<div id="contenedor"> <!-- Contenedor-->

		<div class="container"><!--bloque del contenido central-->
			
			
			
<?php
			echo "<div>";
			
			echo "<h1> ". $cerveza->getIdCerveza() . " - " . $cerveza->getNombre(). " </h1>";
			echo "<img alt='Imagen de cerveza' src=". $cerveza->getImagen()." width='200' height='200' />";
			echo "<p>" . " Capacidad : ". $cerveza->getCapacidad(). " Cl" ."</p>";
			echo "<p>" . " Color : ". $cerveza->getColor() ."</p>";
			echo "<p>" . " Tipo : ". $cerveza->getTipo() ."</p>";
			echo "<p>". " Graduación : ". $cerveza->getGrado() . " % "."</p>";
			echo "<p>". " Ingredientes : ". $cerveza->getGrano() ."</p>";
			echo "<p>"." País : " . $cerveza->getPais()."</p>";
			echo "<p>" . " Precio : ". $cerveza->getPrecio(). " € ". "</p>";
			
			echo "</div>";

			if($_SESSION["logged"]){
				$cantidad = array("0" , "1" , "2" , "3");
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
			echo '<input type="submit" name="comprar">';
		}
?>
		</div>

	</div> <!-- Fin del contenedor -->

	<?php require('comun/footer.php'); ?>

</body>
</html>