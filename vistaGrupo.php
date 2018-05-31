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
					if(isset($_GET['salir'])){
						controllerGrupos::salirGrupo($_SESSION['nombreUsuario'], $_GET['idGrupo']);
					}
					if(isset($_GET['eliminar'])){
						controllerGrupos::eliminarGrupo($_SESSION['nombreUsuario'], $_GET['idGrupo']);
						header('Location: misGrupos.php');
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
	                    </div> <!-- cierre izquierda -->

	                    <div class="derecha">
		                <?php 	
		                    if(isset($_SESSION['login']) && $_SESSION['login']){
								$misGrupos = controllerGrupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['idGrupo']);
								$grupos = controllerGrupos::getGrupoById($_GET['idGrupo']);
								
			                    if(!$misGrupos && $cantidaddisponible > 0){
			                    	echo'<div class="titulo"> ¿Quieres unirte al grupo? </div>';
			                    	echo '<div>'; // div del form
			                    	?>
			                 		<form action="" method="get">
					                	<label> Unidades:</label>
										<input type="hidden" name="idGrupo" value="<?=$grupo->getId()?>">
				            			<input type="number" id="addUds" name="unidades" placeholder="Mínimo 1" min="1" max="<?=$cantidaddisponible?>" required/>
				            			<span id="comprobar_mensaje"></span>
			            			
			                   <?php  
				                   echo '<button type="submit" class= "unirsebtn" onclick="unirse('.$grupo->getId().')">Confirmar</button>';
				                   echo "</form>";
				                   echo "</div>"; // cierre id form
			               		}
							    else if($cantidaddisponible > 0 || $misGrupos) { // El usuario es miembro 
									echo'<div class="titulo"> Eres miembro de este grupo </div>';
										if($cantidaddisponible == 0){
											echo "<p id='infoEstado'> Este pedido ya ha sido enviado </p>";											
										}
										else if($grupos->getCreador()!= $_SESSION['nombreUsuario']){
											echo '<form action="" method="get">
												  <input type="hidden" name="idGrupo" value='.$_GET['idGrupo'].'>
												  <button id="salir" type="submit" name="salir" class= "unirsebtn">Salir del grupo</button>
												  </form>'; 
										}
										else{
											echo '<form action="" method="get">
												  <input type="hidden" name="idGrupo" value='.$_GET['idGrupo'].'>
												  <button type="submit" name="eliminar" class= "unirsebtn">Eliminar el grupo</button>
												  </form>'; 
										}

										$unidades = controllerPedidos::cantidadUsuarioGrupo($_GET['idGrupo'], $_SESSION['nombreUsuario']);
										echo "<p id='uds'> Las unidades que has solicitado son: " . $unidades . "</p>";
							    }
							    else{
							    	echo "<p id='infoEstado'> Vaya.. Has llegado tarde.. No hay unidades disponibles.. </p>";
							    }
							}
						?>	

		                <div id="admin"> 
		                	<?php 
		                	if(isset($_SESSION['login']) && $_SESSION['login']){
		                		echo "<div id='infoGrupo'>";
		                		if($grupo->getCreador() == $_SESSION['nombreUsuario']){
		                			echo "<h3> Eres el creador de este grupo </h3>";
		                			$idPed = controllerPedidos::getIdPedidoByGroup($_GET['idGrupo']);
		                			echo "<p> Id del pedido: " . $idPed . "</p>";
		                			$estado = controllerPedidos::getEstado($idPed);
		                			echo "<p> Estado del pedido: " . $estado . "</p>";
		                		}
		                		else{
		                			echo "El creador del grupo tiene toda la info acerca del pedido";
		                		}

		                		if($cantidaddisponible == 1){
		                			echo "<p> ¡Aún hay " . $cantidaddisponible . " unidad disponible!</p>";
		                		}
		                		else if ($cantidaddisponible > 0) {
									echo "<p> ¡Aún hay " . $cantidaddisponible . " unidades disponibles!</p>";
		                		}
		                		else {
		                			echo "<p>¡El pedido está en camino! </p>";
		                		}
		                		echo "</div>";
		                	}
		                	?>
					    </div> <!-- cierre id admin -->
						
						</div> <!-- cierre derecha -->
					<?php 
				}
				?> 				
           	</div> <!-- cierre structGrupos -->
           	
           	<div class="structComentarios">
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
	
	        </div> <!-- cierre structComentarios -->

	    </div> <!-- cierre vistaGrupo -->


		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->	

</body>
</html>