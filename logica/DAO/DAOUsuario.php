<?php
require_once("logica/IUsuario.php");/*require_once($_SERVER['DOCUMENT_ROOT']."logica/IUsuario.php")*/
require_once("logica/TUsuario.php");
require_once("logica/database.php");



class DAOUsuario implements IUsuario{


	public function selectUsuarios(){
		$database = new Database();
		$dataTable = $database->ejecutarConsulta("SELECT * FROM usuarios");
		$usuario = null;
		$usuarios = array();

		foreach ($dataTable as $clave => $valor) {
			$usuario = new TUsuario();
			$usuario->setIdUsuario($dataTable[$clave]["id"]);
			$usuario->setNombre($dataTable[$clave]["nombre"]);
			$usuario->setApellido($dataTable[$clave]["apellidos"]);
			$usuario->setCuidad($dataTable[$clave]["ciudad"]);
			$usuario->setEmail($dataTable[$clave]["email"]);
			$usuario->setFechaNac($dataTable[$clave]["fechaNac"]);
			$usuario->setRol($dataTable[$clave]["rol"]);
			$usuario->setTarjeta($dataTable[$clave]["tarjeta"]);
			$usuario->setAvatar($dataTable[$clave]["avatar"]);
			$usuario->setPassword($dataTable[$clave]["password"]);

			array_push($usuarios, $usuario); /*Funcion que insetar un elemento en un array. Inserta un usuario en un Array de usuarios*/
		}
		return $usuarios;
	}

	public function selectUsuariosByid($id){
		$database = new Database();
		$dataTable = $database->ejecutarConsulta("SELECT * FROM usuarios WHERE id ='$id'");
		$usuario = null;
		
		if(count($dataTable) == 1){
			foreach ($dataTable as $clave => $valor) {
				$usuario = new TUsuario();
				$usuario->setIdUsuario($dataTable[$clave]["id"]);
				$usuario->setNombre($dataTable[$clave]["nombre"]);
				$usuario->setApellido($dataTable[$clave]["apellidos"]);
				$usuario->setCuidad($dataTable[$clave]["ciudad"]);
				$usuario->setEmail($dataTable[$clave]["email"]);
				$usuario->setFechaNac($dataTable[$clave]["fechaNac"]);
				$usuario->setTarjeta($dataTable[$clave]["tarjeta"]);
				$usuario->setAvatar($dataTable[$clave]["avatar"]);
				$usuario->setPassword($dataTable[$clave]["password"]);
				$usuario->setRol($dataTable[$clave]["rol"]);
				return $usuario;
			}
		}
		else {
			return null;
		}
	}

	/*public function insertUsuario(TUsuario $usuario){
		$database = new Database();
		echo "estoy antes de ejecutar la consulta <br>";
		$sql = 'INSERT INTO usuarios(id, nombre ,apellidos, email, password, fechaNac, tarjeta, ciudad, avatar, rol)'.
				'VALUES (:id, :nombre, :apellidos, :email, :password, :fechaNac, :tarjeta, :ciudad, :avatar, :rol)';

		$resultado = $database->ejecutarActualizacion($sql,array(
				':id'=>$usuario->getIdUsuario(),
				':nombre'=>$usuario->getNombre(),
				':apellidos'=>$usuario->getApellido(),
				':email'=>$usuario->getEmail(),
				':password'=>$usuario->getPassword(),
				':fechaNac'=>$usuario->getFechaNac(),
				':tarjeta'=>$usuario->getTarjeta(),
				':ciudad'=>$usuario->getCuidad(),
				':avatar'=>$usuario->getAvatar(),
				':rol'=>$usuario->getRol()
			));
		return $resultado;
	}*/


	public function insertUsuario(TUsuario $usuario){
		$database = new Database();

		$id=$usuario->getIdUsuario();
		$nombre=$usuario->getNombre();
		$apellidos=$usuario->getApellido();
		$email=$usuario->getEmail();
		$rol=$usuario->getRol();
		$fechaNac=$usuario->getFechaNac();
		$tarjeta=$usuario->getTarjeta();
		$ciudad=$usuario->getCuidad();
		$avatar=$usuario->getAvatar();
		$password=$usuario->getPassword();

		$sql = "INSERT INTO usuarios(id, nombre ,apellidos, email, password, fechaNac, tarjeta, ciudad, avatar, rol) 
				VALUES ('$id','$nombre','$apellidos','$email','$password','$fechaNac','$tarjeta','$ciudad','$avatar','$rol')";

		$resultado = $database->ejecutarActualizacion($sql);
		return $resultado;
	}


	public function updateUsuario(TUsuario $usuario){

	}
	public function deleteUsuario($id){

	}
	
}

?>