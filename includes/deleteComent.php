<?php
	//Este script se utiliza desde AJAX para eliminar comentarios en tiempo real
	require_once __DIR__.'/../includes/Controller/controllerComentarios.php';
	controllerComentarios::eliminarValoracion($_REQUEST['q']);
	controllerComentarios::updateValoracionMedia($_REQUEST['w']);
	return "Comentario borrado";
?>