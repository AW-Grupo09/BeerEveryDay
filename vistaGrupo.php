<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioGrupo.php';
	require_once __DIR__.'/includes/FormularioNuevoComentarioGrupo.php';
	require_once __DIR__.'/includes/Controller/controllerPedidos.php';
	require_once __DIR__.'/includes/Controller/controllerComentarios.php';
	require_once __DIR__.'/includes/grupos.php';
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

		<div class="vistaGrupo">
			<div class="structGrupos">
				<?php
					if (isset($_GET['unidades'])) {
						if(!$_SESSION['login']){
			                header('Location: login.php');
			            }else{
							$misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
			                if($misGrupos != true){
			                $gruposUsuarios = Grupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['idGrupo'], $_GET['unidades']);
				                if(isset($gruposUsuarios)){
				                    echo "<div class='mensajeInfo'><div class='titulo2'> Te has unido correctamente </div> </div>";
				                }
			                }
			                else{
			                    echo "<div class='mensajeInfo'> <div class='titulo2'> Ya perteneces al grupo </div></div>";
			                }
						}
					}


					if(isset($_GET['idGrupo'])){
						$grupo = Grupos::getGrupoById($_GET['idGrupo']);?>
						<?php
							$cerveza = controllerPedidos::getCervezasById($grupo->getId());
				            $cantidadtotal = controllerPedidos::cantidadTotal($grupo->getId());
							$fechaLimite = controllerPedidos::fechaLimite($grupo->getId());
				            $cantidadActual = controllerPedidos::cantidadActual( $grupo->getId());
							$cantidaddisponible = $cantidadtotal - $cantidadActual;
						?>
						<div class ="izquierda">
							<div class = "titulo"><?=$grupo->getNombre() ?></div>
							<div class = "informacionGrupos">
								<p><span>Cerveza:</span></p><?=$cerveza?></p>
								<p><span>Dirección: </span> <?=$grupo->getDireccion()?></p>
		                        <p><span>Ciudad: </span> <?=$grupo->getCiudad()?></p>
		                        <p><span>Creado por: </span><?=$grupo->getCreador()?></p>
		                        <p><span>Fecha limite: </span><?=$fechaLimite?></p>
		                        <p><span>Cantidad total: </span><?=$cantidadtotal?></p>
		                        <p><span>Cantidad disponible: </span><?=$cantidaddisponible?></p>
		                    </div>
	                    </div>

	                    <div class="derecha">
	                    	<div class="titulo">
			                     ¿ Quieres unirte al grupo ?
			                </div>
			                <div>
				                <form action="" method="get">
				                	<label> Unidades:</label>
									<input type="hidden" name="idGrupo" value="<?=$grupo->getId()?>">
			            			<input type="number" name="unidades" placeholder="1" min="1" max="<?=$cantidaddisponible?>" required/>
			            			<span id="comprobar_mensaje"></span>
				                	<button type="submit" class= "unirsebtn" onclick="unirse(<?=$grupo->getId()?>)">Confirmar</button>
			                	</form>
			                </div>

			                <?php /*if (isset($_GET['unidades'])) {
								if(!$_SESSION['login']){
			                        header('Location: login.php');
			                    }else{
									$misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
			                        if($misGrupos != true){
			                            $gruposUsuarios = Grupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['idGrupo'], $_GET['unidades']);
			                            if(isset($gruposUsuarios)){
			                                echo "<div class='mensajeInfo'><div class='titulo2'> Te has unido correctamente </div> </div>";
			                            }
			                        }
			                        else{
			                        	 	echo "<div class='mensajeInfo'> <div class='titulo2'> Ya perteces al grupo </div></div>";
			                        }
								}
							}*/?>
	                    </div>
					<?php }
				?> 		
           	</div>
           	
           	<div class="structComentarios">
	           	<div id = "comentarios">
		        	<?php
		        		
		        		$comentarios = controllerComentarios::cargarComentariosGrupos($_GET['idGrupo']);
				        if($comentarios != NULL)
				            foreach($comentarios as $comentario){
				                echo "<p id = 'autorComent'>" . $comentario->getIdUsuario(). "</p>";
				                echo "<p id = 'dateComent'> Fecha:" . $comentario->getFecha(). "</p>";
				                echo "<p id = 'coment'>" . $comentario->getComentario(). "</p>";
			        		}
			        		
		        	?>
	       		</div>
		
	            <div id = "addComment">
	            	<?php
	            	
	            	//Formulario para aniadir comentario
					if(isset($_SESSION['login']) && $_SESSION['login']){
						echo "1";
						$misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
						if($misGrupos){
							$opciones = array();
							$addToForm = array( 'idGrupo' => $_GET['idGrupo']);
					        $opciones = array_merge($addToForm, $opciones);
							$formulario = new FormularioNuevoComentarioGrupo("FormularioNuevoComentarioGrupo", $opciones);
							$formulario->gestiona();
						}
					}
						
					?>
	            </div>
	        </div>
	    </div>


		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>