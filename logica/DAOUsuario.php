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
	/*public function selectUsuariosByid($id);
	public function insertUsuario(TUsuario $usuario);
	public function updateUsuario(TUsuario $usuario);
	public function deleteUsuario($id);*/
	
}

?>