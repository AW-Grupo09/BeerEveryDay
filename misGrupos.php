<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioGrupo.php';

	if(!$_SESSION['login']){
			header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/misGrupos.css" />
	<link rel="stylesheet" type="text/css" href="css/common.css" />
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>


</head>

<body>

	<div id="contenedor">

		<?php require ('includes/comun/header.php'); ?>
		<div class="container">
            <h1> ¡Te encuentras en la sección de "Mis grupos"! </h1>
            <div id="izquierda">
    			<div id="titulo">
                    Aquí puedes ver cuáles son tus grupos:
                </div>

               <div id="grupo">
                <?php
                 $grupos = Grupos::getGruposByUser($_SESSION['nombreUsuario']);
                    foreach ($grupos as $grupo) { ?>
                        <fieldset>
                        <legend><a href = "vistaGrupo.php?idGrupo=<?=$grupo->getId()?> "><?=$grupo->getNombre()?> </a></legend>
                        <p><span>Dirección: </span>  <?=$grupo->getDireccion()?></p>
                        <span>Ciudad: </span> <?=$grupo->getCiudad()?>
                        <div id="creador">
                            <span>Creado por: </span><?=$grupo->getCreador()?>
                        </div>
                        </fieldset>

                    <?php 
                } ?>
            </div>
            </div>
            <div id="derecha">
                <div id="titulo">
                     ¿ Quieres crear un grupo nuevo ?
                </div>
    			
    			 <?php

                    $opciones = array();

                    $formulario = new FormularioGrupo("formGrupo", $opciones);
                    $formulario->gestiona();

                ?>
            </div>
    		</div>

		<?php require('includes/comun/footer.php'); ?>

	</div>