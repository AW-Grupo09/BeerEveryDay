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
	<meta charset="utf-8">	
	<title>Cervezas</title>

</head>
<body>
	<div id="contenedor"> <!-- Contenedor-->
		<?php require ('includes/comun/header.php'); ?>
		<div class="container"><!--bloque del contenido central-->	
			<div id="izquierda">
				<?php
					if(isset($_GET['idGrupo'])){
							$grupo = Grupos::getGrupoById($_GET['idGrupo']);
							?>
							<div class = "titulo"><h1> <?=$grupo->getNombre() ?></h1></div>
							<p><span>Dirección: </span> <?=$grupo->getDireccion()?></p>
	                        <p><span>Ciudad: </span> <?=$grupo->getCiudad()?></p>
	                        <p><span>Creado por: </span><?=$grupo->getCreador()?></p>

					<?php }
				?>	
			</div>
            <div id="derecha">
                <div id="titulo">
                     ¿ Quieres unirte al grupo ?
                </div>

                <div> 
                	<button class= "unirsebtn" onclick="unirse()">Unirse</button>

                </div>
                
                <?php
	                if (isset($_GET['action']) && $_GET['action'] == 'unirse') {
	                    if(!$_SESSION['login']){
	                        header('Location: login.php');
	                    }
	                    else{

	                        $misGrupos = Grupos::buscaUsuarioenGrupos($_SESSION['nombreUsuario'], $_GET['id']);
	                        if($misGrupos!=true){
	                            $gruposUsuarios = Grupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $_GET['id'],10);
	                        /*hacer las comporbaciones de que no se pueda unir a su mismo grupo*/
	                        /*sigueinte modificacion es el numero de unidades de cerveza*/
	                            if(isset($gruposUsuarios)){
	                                echo" <p> se ha unido correctamente </p>";
	                            }
	                        }
	                    }
	                }
            	?>	    		
            </div>
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