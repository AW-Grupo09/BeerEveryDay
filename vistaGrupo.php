<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioGrupo.php';
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
    			<div id="titulo">
		            <?php
						if(isset($_GET['nombreGrupo'])){
							$nombre =   $_GET['nombreGrupo'];
							echo '<h1> '.$nombre .'</h1>';
						}
					?>	
                </div>

               <div id="grupo">
                <?php
                 /*informacion de los grupos.
                */?>
            	</div>
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
		</div><!-- Fin del container -->

		<?php require('includes/comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->
	

</body>
</html>