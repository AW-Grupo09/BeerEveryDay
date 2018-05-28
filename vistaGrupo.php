<?php 
	session_start();
	require_once __DIR__.'/includes/FormularioGrupo.php';
	require_once __DIR__.'/includes/FormularioNuevoComentarioGrupo.php';
	require_once __DIR__.'/includes/Controller/controllerPedidos.php';
	require_once __DIR__.'/includes/Controller/controllerComentarios.php';
	require_once __DIR__.'/includes/Controller/controllerGrupos.php';
	require_once __DIR__.'/includes/TO/TOComentarios.php';
	require_once __DIR__.'/includes/TO/TOGrupos.php';
	require_once __DIR__.'/includes/TO/TOCervezas.php';
	global $sql;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="css/vistaGrupo.css"/>
	<script type="text/javascript" src="js/javascript.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<meta charset="utf-8">	
	<title>Grupo</title>

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
							$misGrupos = controllerGrupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
			                if($misGrupos != true){
			                $gruposUsuarios = controllerGrupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['idGrupo'], $_GET['unidades']);
			                }
						}
					}

					if(isset($_GET['idGrupo'])){
						$grupo = controllerGrupos::getGrupoById($_GET['idGrupo']);?>
						<?php
							$cerveza = controllerPedidos::getCervezaByIdGrupo($grupo->getId());
				            $cantidadtotal = controllerPedidos::cantidadTotal($grupo->getId());
							$fechaLimite = controllerPedidos::fechaLimite($grupo->getId());
				            $cantidadActual = controllerPedidos::cantidadActual( $grupo->getId());
							$cantidaddisponible = $cantidadtotal - $cantidadActual;
							if($cantidaddisponible == 0){
								controllerPedidos::actualizarEstadoPedido($grupo->getId());
							}
						?>
						<div class ="izquierda">
							<table>
								<thead>
									<tr>
										<th><div class = "titulo"><?=$grupo->getNombre() ?></div></th>
									</tr>
								</thead>

									<tr>
										<td><span>Cerveza: </span><?=$cerveza->getNombre()?></td>
									</tr>

									<tr>
										<td><span>Precio por unidad con el descuento: </span><?=$cerveza->getPrecio()?></td>
									</tr>

									<tr>
										<td><span>Dirección: </span> <?=$grupo->getDireccion()?></td>
									</tr>

									<tr>
										<td><span>Ciudad: </span> <?=$grupo->getCiudad()?></td>
									</tr>

									<tr>
										<td><span>Creado por: </span><?=$grupo->getCreador()?></td>
									</tr>

									<tr>
										<td><span>Fecha limite: </span><?=$fechaLimite?></td>
									</tr>

									<tr>
										<td><span>Cantidad total: </span><?=$cantidadtotal?></td>
									</tr>

									<tr>
										<td><span>Cantidad disponible: </span><?=$cantidaddisponible?></td>
									</tr>

							</table>
	                    </div>
			                    <div class="derecha">
				                <?php 	
				                	//Para que muestre una cosa u otra en funcion de si eres del grupo o no

				                    if(isset($_SESSION['login']) && $_SESSION['login']){
										$misGrupos = controllerGrupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
					                    if(!$misGrupos)
					                    	echo'<div class="titulo"> ¿Quieres unirte al grupo? </div>';
									    else 
											echo'<div class="titulo"> Eres miembro de este grupo </div>';
									}
								?>
					                <div>
					                	<?php 
					                	if(isset($_SESSION['login']) && $_SESSION['login']){
					                	$misGrupos = controllerGrupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
						                    if(!$misGrupos) { ?>
						                <form action="" method="get">
						                	<label> Unidades:</label>
											<input type="hidden" name="idGrupo" value="<?=$grupo->getId()?>">
					            			<input type="number" name="unidades" placeholder="Mínimo 1" min="1" max="<?=$cantidaddisponible?>" required/>
					            			<span id="comprobar_mensaje"></span>
				                    <?php 	}
				                		}

					                    if(isset($_SESSION['login']) && $_SESSION['login']){
											$misGrupos = controllerGrupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
						                    if(!$misGrupos){
						                    	echo '<button type="submit" class= "unirsebtn" onclick="unirse(<?=$grupo->getId()?>)">Confirmar</button>';

						                    }
										    else {

									             if(isset($_SESSION['login']) && $_SESSION['login']){
													$misGrupos = controllerGrupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
													
												    if($misGrupos){
												    	echo '<input type="button" id="salir" onclick="salirGrupo('. $_GET['idGrupo'] .', `'.$_SESSION['nombreUsuario'].'`)" value="Salir del grupo">';  
												    	$unidades = controllerPedidos::cantidadUsuarioGrupo($_GET['idGrupo'], $_SESSION['nombreUsuario']);
												    	echo "<p id='uds'> Las unidades que has solicitado son " . $unidades;
												    }
												 } 
										    }
										}
									?>
					                	</form>
					                </div>

					                <div id="admin"> 
					                	<?php 
					                	if(isset($_SESSION['login']) && $_SESSION['login']){
					                		if($grupo->getCreador() == $_SESSION['nombreUsuario']){
					                			echo "<h3> Eres el creador de este grupo</h3>";
					                			echo "<p> aquí tienes información del pedido </p>";
					                			$idPed = controllerPedidos::getIdPedidoByGroup($_GET['idGrupo']);
					                			echo "<p> Id del pedido: " . $idPed . "</p>";
					                			$estado = controllerPedidos::getEstadoPedidoGroup($_GET['idGrupo']);
					                			echo "Estado del pedido: " . $estado;
					                		}
					                		else
					                			echo "El creador del grupo tiene toda la info acerca del pedido";
					                	}
					                	?>


					                </div>


			                    </div>
					<?php 
				}
				?> 		
           	</div>
           	
           	<div class="structComentarios">
	            
	           	<div id = "comentarios">
		        	<?php
		        		
		        		$comentarios = controllerComentarios::cargarComentariosGrupos($_GET['idGrupo']);
				        if($comentarios != NULL){
				        	echo "<p id='titleComment'><span id='spanTitle'>Comentarios</span></p>";

				            foreach($comentarios as $comentario){				            	
				            	echo "<div id='showComment'>";
				            	echo "<p id = 'dateComent'> " . $comentario->getFecha(). "</p>";
				                echo "<p id = 'autorComent'><span id='spanId'>" . $comentario->getIdUsuario(). "</span></p>";
				                
				                echo "<p id = 'coment'>" . $comentario->getComentario(). "</p>";
				                echo "</div>";
			        		}
			        	}
			        		
		        	?>
	       		</div>
	     		<div id = "addComment">
		            	<?php
		            	
		            	//Formulario para aniadir comentario
						if(isset($_SESSION['login']) && $_SESSION['login']){
							$misGrupos = controllerGrupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
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