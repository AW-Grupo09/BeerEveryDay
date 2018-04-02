<?php 
session_start();
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
					<form method="post">
						<input type="text" placeholder="Nombre..." name="nombre"/>
						<select name="pais">
							<option value=""> Pais</option>
							<?
								while ($listaCervezas = $conexion->fetch_array(MYSQLI_BOTH))
								{
									echo '<option value="'.$listaCervezas[''].'">'.$registroCarreras['carrera'].'</option>';
								}
							?>
						</select>

						<select name="color">
							<option value="">No. de Registros</option>
							<option value="rubia">rubia</option>
							<option value="tostada">tostada</option>
							<option value="negra">negra</option>
						</select>
						<button name="buscar" type="submit">Buscar</button>
					</form>
				</section>
			</div>
			<?php require('footer.php'); ?>
		</div>
	</body>
</html>