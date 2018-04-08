<?php 
	include('logica/conexion.php');
	global $sql;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Filtro de Búsqueda PHP</title>
		<meta charset="utf-8">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>

	<?php require ('comun/header.php'); ?>

		<div id="contenedor">

			<div class="container">
				<header>
					<div class="alert alert-info">
					<h2>Filtro de Búsqueda PHP</h2>
					</div>
				</header>
				<section>
					<form action="catalogo.php" method="post">
					<?php
						 $sql= '';
						echo '<fieldset>';
						if (isset($_POST['artesana'])){
							echo '<input type="checkbox" name="artesana" checked>Artesanas<br/>';
							$sql = $sql . 'and artesana = 1 ';
						}else{
							echo '<input type="checkbox" name="artesana">Artesanas<br/>'; 
						}
						if (isset($_POST['nacional'])){
							echo '<input type="checkbox" name="nacional" checked>Nacionales<br/>';
							$sql = $sql . 'and pais = "España" ';
						}else{
							echo '<input type="checkbox" name="nacional">Nacionales<br/>'; 
						}
						$grados = array("" => "", 
										"Menor de 5" => " grado <= 5 ", 
										"Entre 5 y 7" => " grado >= 5 and grado <= 7 ", 
										"Mayor de 7" => " grado >= 7 ");
						echo 'Grado Alcohólico: <select name="grado">';
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
						echo '</select><br/>';

						$orden = array("" => "", 
										"Mas vendidas" => " order by cervezasVendidas desc",
										"Precio de mayor a menor" => " order by precio desc", 
										"Precio de menor a mayor" => " order by precio");
						echo 'Ordernar por: <select name="ordenar">';
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
								echo '<input type="checkbox" name="' . $i . '" checked>' . $i . '<br/>';
								if(strcmp($sqlColor, "") == 0){
									$sqlColor = $sqlColor . '(color = "' . $i . '" ';
								}else{
									$sqlColor = $sqlColor . 'or color = "' . $i . '" ';
								}
							}else{
								echo '<input type="checkbox" name="' . $i . '">' . $i . '<br/>'; 
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
								echo '<input type="checkbox" name="' . $i . '" checked>' . $i . '<br/>';
								if(strcmp($sqlGranos, "") == 0){
									$sqlGranos = $sqlGranos . '(grano = "' . $i . '" ';
								}else{
									$sqlGranos = $sqlGranos . 'or grano = "' . $i . '" ';
								}
							}else{
								echo '<input type="checkbox" name="' . $i . '">' . $i . '<br/>'; 
							}
						}
						if(strcmp($sqlGranos, "") != 0){
							$sql = $sql . 'and ' . $sqlGranos . ') ';
						}
						echo '</fieldset>';
						$sql =''. $sql;	
					?>
					<input type="submit" name="buscar">
					</form>


					<?php
				
						$sql = 'select id, nombre, artesana, capacidad, color, fabricante, grado, grano, imagen, pais, precio, tipo, sum(unidades) as cervezasVendidas FROM cervezas, `pedidos-cervezas` where id = idCerveza ' . $sql . ' group by id ' . $sqlOrden;							$mysqli = conexion::getConection();
						$consulta = mysqli_query($mysqli,$sql);
						while($fila= mysqli_fetch_assoc($consulta)){
							echo $fila['nombre'] . ' --- ' . $fila['capacidad'] . ' --- ' . $fila['color'] . ' --- ' . $fila['tipo'] . ' --- ' . $fila['grado'] . ' --- ' . $fila['grano'] . ' --- ' . $fila['pais'] . ' --- ' . $fila['precio'] . '<br/>';
							echo '<img src="' .  $fila['imagen'] . '" height="200" width="200"><br/>';
						}
						$sql='';
					?>

				</section>
			</div>
		</div>

		<?php require('comun/footer.php'); ?>
	</body>
</html>
