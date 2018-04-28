<?php 

require_once __DIR__.'/Aplicacion.php';

session_start();

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'localhost');
define('BD_NAME', 'beereveryday');
define('BD_USER', 'root');
define('BD_PASS', '');

/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

// Inicializa la aplicación
$app = Aplicacion::getSingleton();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

register_shutdown_function(array($app, 'shutdown'));


?>