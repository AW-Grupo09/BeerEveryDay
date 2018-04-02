<?php
	class Database{
		private $conexion;
		private $cadenaConexion;
		

		/*private static $dbInstance;*/

		/*Introducir un singelton para instanciar la base de datos
		de manera que la base de datos se instacia a si misma*/
		/*public static function getDb() {
	        if ( self::$dbInstance === null ) {
	            self::$dbInstance = new database();
	        }
       		return self::$dbInstance;
    	}*/

		/**
		*Metodo contructor para iniciar la conexion a la base de datos.
		*Los campos de PDO son servidor y nombreBD, usuario, contraseña.
		**/
		public function __construct(){
			try{
				$this->cadenaConexion = "mysql:host=localhost;dbname=beereveryday";
				$this->conexion = new PDO($this->cadenaConexion,"root",'');
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		
		/**
		*Metodo que permite extraer una fila de nuestra base de datos.
		*Usamos PDO en PHP.
		* @param $sql variable que contiene la consulta sql.
		* @param $values array de bindValues(Vincula un valor a un parámetro) de PDO para la consulta sql.
		* @return $tabla_datos variable con los registros de la base de datos.
		**/
		public function ejecutarConsulta($sql = ""){
			echo $sql;

			if($sql != ""){
				$values= array();/*Podemos enciar parametros a la sencia execute a  través de un array, en este caso va vacio por lo que no lleva paremtros.*/
				$consulta = $this->conexion->prepare($sql); /*prepare , prepara la consulta sql para ser ejecutada*/
				$consulta->execute($values); /*Ejecuta una sentencia preparada*/
				$tabla_datos = $consulta->fetchAll(PDO::FETCH_ASSOC); /*Devuele una array que contiene todas la filas de la tabla consultada*/
				/*Con PDO::FETCH_ASSOC controlamos que el contenido del array tendra la siguiente forma */
				/* id = 3
				   nombre = Dario
				   Apellido = Gallegos
				   Direccion = ....*/
				return $tabla_datos;
			}
			else{
				return 0; 
			}
		}

		/**
		* Metodo que nos permite obtener el número de tablas afectadas,0 indica que no pasa nada.
		* Usamos PDO, que es una interfaz de PHP que nos facilita la conexión e intercambio de info con la BBDD.
		* @param $sql varible con la consulta sql.
		* @param $values array bindValues de PDO para la consulta sql.
		* @return $numero_tablas_afectadas número de tablas afectadas.
		**/
		public function ejecutarActualizacion($sql="",$values=array()){
			echo $sql;
			print_r($values);

			if($sql != ""){
				$consulta = $this->conexion->prepare($sql);
				$consulta->execute($values);
				$numero_tablas_afectadas = $consulta->rowCount();
				return $numero_tablas_afectadas;
			}else{
				return 0;
			}
		}

		/**
		*Metodo para destruir la conexion con la base de datos. 
		**/
		public function __destruct(){
			if(isset($this->conexion)){
				$this->conexion = null;
			}
		}
	}

?>