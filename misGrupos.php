<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/FormularioGrupo.php';


	/*include('includes/usuario.php');
	include('includes/pedidos.php');
	include('includes/cervezas.php');*/

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
            <div id="izquierda">
    			<div class="titulo">
                    <h2> ¡Mis grupos! </h2>
                </div>

                <table>
                    <thead>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Ciudad</th>
                        <th>Creador</th>
                    </thead>
                    <?php
                    
                    $grupos = Grupos::getGruposByUser($_SESSION['nombreUsuario']);
                    foreach ($grupos as $grupo) { ?>
                    <tr>
                        <td><?=$grupo->getNombre()?></td>
                        <td><?=$grupo->getDireccion()?></td>
                        <td><?=$grupo->getCreador()?></td>
                        <td><?=$grupo->getCiudad()?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="derecha">
                <div class="titulo">
                    <p><h2> ¿ Desea crear un nuevo grupo ?</h2></p>
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