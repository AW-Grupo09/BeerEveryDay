<?php
	/*Es el tranfserObject de Usuario, sirve para tranportar datos entre las capas*/
	class TUsuario{
		private $idUsuario;
		private $nombre;
		private $apellido;
		private $cuidad;
		private $email;
		private $fechaNac;
		private $rol;
		private $tarjeta;
		private $avatar;
		private $password;

		public function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}
		public function getIdUsuario(){
			return $this->idUsuario;
		}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getNombre(){
			return $this->nombre;
		}

		public function setApellido($apellido){
			$this->apellido = $apellido;
		}
		public function getApellido(){
			return $this->apellido;
		}

		public function setCuidad($cuidad){
			$this->cuidad = $cuidad;
		}
		public function getCuidad(){
			return $this->cuidad;
		}

		public function setEmail($email){
			$this->email = $email;
		}
		public function getEmail(){
			return $this->email;
		}

		public function setFechaNac($fechaNac){
			$this->fechaNac = $fechaNac;
		}
		public function getFechaNac(){
			return $this->fechaNac;
		}

		public function setRol($rol){
			$this->rol = $rol;
		}
		public function getRol(){
			return $this->rol;
		}

		public function setTarjeta($tarjeta){
			$this->tarjeta = $tarjeta;
		}
		public function getTarjeta(){
			return $this->tarjeta;
		}

		public function setAvatar($avatar){
			$this->avatar = $avatar;
		}
		public function getAvatar(){
			return $this->avatar;
		}
		
		public function setPassword($password){
			$this->password = $password;
		}
		public function getPassword(){
			return $this->password;
		}
	}
?>