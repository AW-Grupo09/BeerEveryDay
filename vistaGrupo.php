<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioGrupo.php';
	require_once __DIR__.'/includes/FormularioNuevoComentarioGrupo.php';
	require_once __DIR__.'/includes/grupos.php';
	require_once __DIR__.'/includes/Controller/controllerComentarios.php';
	require_once __DIR__.'/includes/TO/TOComentarios.php';
	global $sql;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="css/vistaGrupo.css"/>
	<script type="text/javascript" src="js/javascript.js"></script>
	<meta charset="utf-8">	
	<title>Cervezas</title>

</head>
<body>
	<div id="contenedor"> <!-- Contenedor-->
		<?php require ('includes/comun/header.php'); ?>
		<div class="container"><!--bloque del contenido central-->	
			<div class="structGrupos">
				<?php
					if(isset($_GET['idGrupo'])){
						$grupo = Grupos::getGrupoById($_GET['idGrupo']);?>
						<div class ="izquierda">	

							<div class = "titulo"><h3> <?=$grupo->getNombre() ?> </h3></div>
							<div class = "informacionGrupos">
								<p><span>Dirección: </span> <?=$grupo->getDireccion()?></p>
		                        <p><span>Ciudad: </span> <?=$grupo->getCiudad()?></p>
		                        <p><span>Creado por: </span><?=$grupo->getCreador()?></p>
		                    </div>
	                    </div>

	                    <div class="derecha">
	                    	<div class="titulo">
			                    <h3> ¿Quieres unirte al grupo? </h3>
			                </div>
			                <div>
				                	<label> Unidades:</label>
			            			<input type="number" name="unidades" placeholder="1" min="1" required/>
			            			<span id="comprobar_mensaje"></span> 
				                	<button class= "unirsebtn"  onclick="unirse(<?=$grupo->getId()?>)">Confirmar</button>
			                </div>
	                    </div>

					<?php }
				?>	
				<?php
				if(isset($GET['cantidad'])){

					$cantidad = $GET['cantidad'];
					if($cantidad > 10 )
						echo "Este nick está ocupado"; 
				}

				?>
                <?php
	                if (isset($_GET['action']) && $_GET['action'] == 'unirse') {
	                    if(!$_SESSION['login']){
	                        header('Location: login.php');
	                    }
	                    else{

	                        $misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['id']);
	                        if($misGrupos!=true){
	                            $gruposUsuarios = Grupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['id'],10);
	                            if(isset($gruposUsuarios)){
	                                echo" <p> se ha unido correctamente </p>";
	                            }
	                        }
	                        else{

	                    }
	                        }
	                }
            	?>	    		
           	</div>

           	<div id = "comentarios">
	        	<?php
	        		/*
	        		$comentarios = controllerComentarios::cargarComentariosGrupos($_GET['idGrupo']);
			        if($comentarios != NULL)
			            foreach($comentarios as $comentario){
			                echo "<p id = 'autorComent'>" . $comentario->getIdUsuario(). "</p>";
			                echo "<p id = 'dateComent'> Fecha:" . $comentario->getFecha(). "</p>";
			                echo "<p id = 'coment'>" . $comentario->getComentario(). "</p>";
		        		}
		        	*/	
	        	?>
       		 </div>
		
            <div id = "addComment">
            	<?php
            	
            	//Formulario para aniadir comentario
				if(isset($_SESSION['login']) && $_SESSION['login']){
					$misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
					if($misGrupos){
						$opciones = array();
						$addToForm = array( 'idGrupo' => $_GET['nombreGrupo']);
				        $opciones = array_merge($addToForm, $opciones);
						$formulario = new FormularioNuevoComentarioGrupo("FormularioNuevoComentarioGrupo", $opciones);
						$formulario->gestiona();
					}
				}
					
				?>
			
            </div>
		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>