<?php
	//Este script se utiliza desde AJAX para salir de un grupo en tiempo real
	require_once __DIR__.'/../includes/Controller/controllerGrupos.php';
	controllerGrupos::salirGrupo($_REQUEST['q'], $_REQUEST['w']);
	return "Comentario borrado"; 


 ?>