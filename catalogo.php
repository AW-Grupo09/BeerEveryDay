<?php 
	include('conexion.php');
	global $sql;
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Filtro de Búsqueda PHP</title>
		<meta charset="utf-8">
		<link href="css/estilos.css" rel="stylesheet">
	</head>
	<body>

		<div id="contenedor">

			<?php require ('header.php'); ?>

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
							if(strcmp($sql, "") == 0){
								$sql = $sql . 'where artesana = 1 ';
							}else{
								$sql = $sql . 'and artesana = 1 ';
							}
						}else{
							echo '<input type="checkbox" name="artesana">Artesanas<br/>'; 
						}

						if (isset($_POST['nacional'])){
							echo '<input type="checkbox" name="nacional" checked>Nacionales<br/>';
							if(strcmp($sql, "") == 0){
								$sql = $sql . 'where pais = "España" ';
							}else{
								$sql = $sql . 'and pais = "España" ';
							}
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
										if(strcmp($sql, "") == 0){
											$sql = 'where ' . $v;
										}else{
											$sql = $sql . 'and ' . $v;
										}
									}
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
							if(strcmp($sql, "") == 0){
								$sql = 'where ' . $sqlColor . ') ';
							}else{
								$sql = $sql . 'and ' . $sqlColor . ') ';
							}
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
							if(strcmp($sql, "") == 0){
								$sql = 'where ' . $sqlGranos . ') ';
							}else{
								$sql = $sql . 'and ' . $sqlGranos . ') ';
							}
						}
						echo '</fieldset>';
						$sql =''. $sql;	
					?>
					<input type="submit" name="buscar">
					</form>


					<?php
				
						if($sql==''){
							$sql = 'SELECT * FROM cervezas';
							$mysqli = conexion::getConection();
							$consulta = mysqli_query($mysqli,$sql);
							while($fila= mysqli_fetch_assoc($consulta)){
								echo $fila['nombre'];
							}
						}else{
							$sql = 'select * from cervezas '.$sql;
							$mysqli = conexion::getConection();
							$consulta = mysqli_query($mysqli,$sql);
							while($fila= mysqli_fetch_assoc($consulta)){
								echo $fila['nombre'];
							}
						}
						$sql='';
					?>

				</section>
			</div>
			<?php require('footer.php'); ?>
		</div>
	</body>
</html>
