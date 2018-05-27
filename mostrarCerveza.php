<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/TO/TOCervezas.php';
	require_once __DIR__.'/includes/Controller/controllerCervezas.php';
	require_once __DIR__.'/includes/TO/TOComentarios.php';
	require_once __DIR__.'/includes/Controller/controllerComentarios.php';
	require_once __DIR__.'/includes/FormularioNuevoComentarioCerve.php';
	
	global $sql;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/mostrarCerveza.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<script type="text/javascript" src="js/deleteComent.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<meta charset="utf-8">	
	<title>Cervezas</title>
<?php
	if(isset($_GET['id'])){
		$cerveza = controllerCervezas::loadCerveza($_GET['id']);
	}else{
		header('Location: catalogo.php');
	}
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
			$maxI = $cerveza->getValoracion();
			echo "<p id='titleComment'><span id='spanTitle'>Puntuación: </span></p>";
			for($i=1;$i<=$maxI;$i++)
				echo"<label id=star>★</label>";
			

			echo "</div>";// cierro div imagen
			echo "<div class= 'datosCerveza'>";
			echo "<p><span>Capacidad : </span>". $cerveza->getCapacidad(). " Cl" ."</p>";
			echo "<p><span>Color : </span>". $cerveza->getColor() ."</p>";
			echo "<p><span>Tipo : </span>". $cerveza->getTipo() ."</p>";
			echo "<p><span>Graduación : </span>". $cerveza->getGrado() . " % "."</p>";
			echo "<p><span>Ingredientes : </span>". $cerveza->getGrano() ."</p>";
			echo "<p><span>País : </span>" . $cerveza->getPais()."</p>";
			echo "<p><span>Precio : </span>". $cerveza->getPrecio(). " € ". "</p>";
			echo "</div>";//cierro div datosCerveza
			
			if(isset($_SESSION['login']) && $_SESSION['login']){
				echo '<form  action="includes/procesarCesta.php" method="GET">';			
				echo '<input type="number" name="unidades" min="1" placeholder="Unidades">';
				echo '<button class="submit" type="submit" name="cerveza" value="'. $cerveza->getIdCerveza().'">Añadir a la cesta</button>';
				echo '</form>';
			}

			echo "</div>";//cierro div contenidoCerveza
			echo "</div>";//cierro div mostrarCerveza
		?>

        <div id = "valoraciones">
        	<?php

        		$comentarios = controllerComentarios::cargarValoraciones($cerveza->getIdCerveza());
		        if($comentarios != NULL){
		        	echo "<p id='titleComment'><span id='spanTitle'>Comentarios:</span></p>";

		            foreach($comentarios as $comentario){
		            	 
		            	echo "<div id='showComment'>";
		            	echo "<p id = 'dateComent'> Fecha: " . $comentario->getFecha(). "</p>";

		            	echo "<p id = 'autorComent'><span id='spanId'>" . $comentario->getIdUsuario(). "
		                </span></p>";
		                
						for($i=1;$i<=$comentario->getValoracion();$i++)echo"<label id=star>★</label>";	
						echo "<p id = 'coment'>" . $comentario->getComentario(). "</p>";
		                echo "</div>";

		                if(isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] == $comentario->getIdUsuario())
		                    echo '<input type="button" id="myBtn" onclick="deleteVal('. $comentario->getIdComentario() .')" value="Eliminar valoración">';             
		          	}
		        }
        	  ?>
        </div>
		
		<div id = "addComment">
            	<?php
            	//Formulario para aniadir comentario
				if(isset($_SESSION['login']) && $_SESSION['login']){
					if(!controllerComentarios::existeVal($cerveza->getIdCerveza(),$_SESSION['nombreUsuario'])){
						$opciones = array();
						$addToForm = array( 'idCerveza' => $cerveza->getIdCerveza() );
			        	$opciones = array_merge($addToForm, $opciones);
						$formulario = new FormularioNuevoComentarioCerve("FormularioNuevoComentarioCerve", $opciones);
						$formulario->gestiona();
					}
					else
						echo "<p>Ya has valorado esta cerveza! Si quieres volver a valorarla necesitas eliminar tu valoración anterior</p>";
				}
				?>
			
        </div>

	</div><!-- Fin del container -->

	<?php require('includes/comun/footer.php'); ?>

</div> <!-- Fin del contenedor -->
	

</body>
</html>