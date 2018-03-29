<?php

	session_start();

	//Conexión con la base de datos
	define('hostname','localhost');
	define('usuario', 'root');
	define('password', '');
	define('baseDatos', 'beereveryday');

	$conexion = new Conexion( hostname, usuario, password, baseDatos );

	class Conexion {

	private static $mysqli;
	
	public function __construct( $hostname, $usuario, $password, $baseDatos ) {
	  
		if ( !self::$mysqli )
	   {
			self::$mysqli = new mysqli($hostname, $usuario, $password, $baseDatos);
			
			if ( self::$mysqli->connect_errno) {
				echo "Fallo al conectar a MySQL: (" . self::$mysqli->connect_errno . ") " . self::$mysqli->connect_error ;
			}
			
			if(!self::$mysqli->set_charset("utf8"))
			{
				printf("<hr>Error loading character set utf8 (Err. nº %d): %s\n<hr/>",	self::$mysqli->errno, self::$mysqli->error);
				exit();
			}
			
			ini_set('default_charset', 'UTF-8');
				  
		}else
		{

		}
		
		 if ( !self::$mysqli )
	  {
		  
		  
		  echo "fail";
	  }
		  
  
  
	}
  
  public static function getConection()
  {
	  
	  if ( !self::$mysqli )
	  {
		    
		  echo "fail tremendo";
	  }
	  return self::$mysqli;
  }
  
}
?>
