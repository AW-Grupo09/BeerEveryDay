<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioGrupo.php';
	require_once __DIR__.'/includes/FormularioNuevoComentarioGrupo.php';
	require_once __DIR__.'/includes/grupos.php';
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
			
				<?php
					if(isset($_GET['idGrupo'])){
						$grupo = Grupos::getGrupoById($_GET['idGrupo']);?>
						<div id="izquierda">	

							<div class = "titulo"><h1> <?=$grupo->getNombre() ?></h1></div>
							<p><span>Dirección: </span> <?=$grupo->getDireccion()?></p>
	                        <p><span>Ciudad: </span> <?=$grupo->getCiudad()?></p>
	                        <p><span>Creado por: </span><?=$grupo->getCreador()?></p>
	                    </div>

	                    <div id="derecha">
	                    	<div id="titulo">
			                     ¿ Quieres unirte al grupo ?
			                </div>
			                <div> 
			                	<button class= "unirsebtn"  onclick="unirse(<?=$grupo->getId()?>)">Unirse</button>
			                </div>
	                    </div>

					<?php }
				?>	
			
                <?php
	                if (isset($_GET['action']) && $_GET['action'] == 'unirse') {
	                    if(!$_SESSION['login']){
	                        header('Location: login.php');
	                    }
	                    else{

	                    	echo "estoy en los grupos de dentro ";
	                        $misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['id']);
	                        if($misGrupos!=true){
	                            $gruposUsuarios = Grupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['id'],10);
	                            if(isset($gruposUsuarios)){
	                                echo" <p> se ha unido correctamente </p>";
	                            }
	                        }
	                    }
	                }
            	?>	    		
           
            <div id = "addComment">
            	<?php
            	/*
            	//Formulario para aniadir comentario
				if(isset($_SESSION['login']) && $_SESSION['login']){
					
					$opciones = array();
					$addToForm = array( 'idGrupo' => $_GET['nombreGrupo']);
			        $opciones = array_merge($addToForm, $opciones);
					$formulario = new FormularioNuevoComentarioGrupo("FormularioNuevoComentarioGrupo", $opciones);
					$formulario->gestiona();
				}
					*/
				?>
			
            </div>
		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>