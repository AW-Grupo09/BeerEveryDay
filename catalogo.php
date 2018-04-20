
	<?php 
		include('logica/conexion.php');
		include('logica/cervezas.php');
		global $sql;
	?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Catálogo</title>
		<meta charset="utf-8">
		<link href="css/estilo.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/common.css">
	</head>
	<body>
		<div id="contenedor">
			<?php require ('comun/header.php'); ?>
			<div class="container">
				<header>
					<div class="alert alert-info">
					<h2>Filtro de Búsqueda </h2>
					</div>
				</header>
				<section>
					<form action="catalogo.php" method="post">
					<?php
						 $sql= '';
						echo '<fieldset>';
						if (isset($_POST['artesana'])){
							echo '<input type="checkbox" name="artesana" checked>Artesanas';
							$sql = $sql . 'and artesana = 1 ';
						}else{
							echo '<input type="checkbox" name="artesana">Artesanas'; 
						}
						if (isset($_POST['nacional'])){
							echo '<input type="checkbox" name="nacional" checked>Nacionales';
							$sql = $sql . 'and pais = "España" ';
						}else{
							echo '<input type="checkbox" name="nacional">Nacionales'; 
						}
						$grados = array("" => "", 
										"Menor de 5" => " grado <= 5 ", 
										"Entre 5 y 7" => " grado >= 5 and grado <= 7 ", 
										"Mayor de 7" => " grado >= 7 ");
						echo ' Grado: <select name="grado">';
							foreach ($grados as $i => $v) {
								if($_POST['grado'] == $i){
									echo '<option value="'.  $i .'" selected="true">' . $i . '</option>';
									if(strcmp($v, "") != 0){
										$sql = $sql . 'and ' . $v;
									}
								}else{
									echo '<option value="'.  $i .'">' . $i . '</option>';
								}
							}
						echo '</select>';

						$orden = array("" => "", 
										/*"Mas vendidas" => " order by cervezasVendidas desc",*/
										"Precio de mayor a menor" => " order by precio desc", 
										"Precio de menor a mayor" => " order by precio");
						echo ' Ordernar por: <select name="ordenar">';
						foreach ($orden as $i => $v) {
							if($_POST['ordenar'] == $i){
								echo '<option value="'.  $i .'" selected="true">' . $i . '</option>';
								$sqlOrden = $v;
							}else{
								echo '<option value="'.  $i .'">' . $i . '</option>';
							}
						}
						echo '</select>';

						echo '</fieldset>';
						//------------------------------------------------------------------------------
						$colores = array("Rubia", "Negra", "Roja", "Tostada", "Blanca");
						$sqlColor = '';
						echo '<fieldset>';
						echo '<legend>Color</legend>';
						foreach ($colores as $i) {
						    if (isset($_POST[$i])){
								echo '<input type="checkbox" name="' . $i . '" checked>' . $i . '';
								if(strcmp($sqlColor, "") == 0){
									$sqlColor = $sqlColor . '(color = "' . $i . '" ';
								}else{
									$sqlColor = $sqlColor . 'or color = "' . $i . '" ';
								}
							}else{
								echo '<input type="checkbox" name="' . $i . '">' . $i . ''; 
							}
						}
						if(strcmp($sqlColor, "") != 0){
								$sql = $sql . 'and ' . $sqlColor . ') ';
						}
						echo '</fieldset>';
						//----------------------------------------------------------------------------------
						$granos = array("Cebada", "Trigo", "Avena");
						$sqlGranos = '';
						echo '<fieldset>';
						echo '<legend>Ingredientes</legend>';
						foreach ($granos as $i) {
						    if (isset($_POST[$i])){
								echo '<input type="checkbox" name="' . $i . '" checked>' . $i . '';
								if(strcmp($sqlGranos, "") == 0){
									$sqlGranos = $sqlGranos . '(grano = "' . $i . '" ';
								}else{
									$sqlGranos = $sqlGranos . 'or grano = "' . $i . '" ';
								}
							}else{
								echo '<input type="checkbox" name="' . $i . '">' . $i . ''; 
							}
						}
						if(strcmp($sqlGranos, "") != 0){
							$sql = $sql . 'and ' . $sqlGranos . ') ';
						}
						echo '</fieldset>';
						$sql =''. $sql;	
					?>
					<input type="button" name="buscar">
					</form>

					<?php
						$mysqli = conexion::getConection();
						$idsCervezas = cervezas::getIdsCervezas($sql,$sqlOrden,$mysqli);
						foreach ($idsCervezas as $key => $value) {
							$cerveza = new cervezas($value,$mysqli);
							echo "<div>";
							echo "<h1> <a href = mostrarCerveza.php?id=" . $cerveza->getIdCerveza() . ">" . $cerveza->getNombre() . "</a></h1>";
							echo "<img alt='Imagen de cerveza' src=". $cerveza->getImagen()." width='200' height='200' />";
							echo "<p>" . $cerveza->getCapacidad(). " ". $cerveza->getColor()." ". $cerveza->getTipo()." ". $cerveza->getGrado()." ". $cerveza->getGrano(). " ".
								$cerveza->getPais()."</p>";
							echo "<p>" . $cerveza->getPrecio(). " € ". "</p>";
							echo "</div>";
						}
						$sql='';
					?>
				</section>
			</div>		
		<?php require('comun/footer.php'); ?>
		</div>
	</body>
</html>