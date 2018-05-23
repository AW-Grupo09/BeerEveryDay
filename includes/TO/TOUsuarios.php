<?php  

class TOUsuario
{

    private $nombreUsuario;
    private $nombre;
    private $password;
    private $rol;
    private $ciudad;
    private $fechaNac;
    private $email;
    private $apellidos;
    private $avatar;
    private $id;

    public function __construct($nombreUsuario, $nombre, $password, $rol, $ciudad, $fechaNac, $email, $apellidos, $avatar)
    {
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->ciudad = $ciudad;
        $this->fechaNac = $fechaNac;
        $this->email = $email;
        $this->apellidos = $apellidos;
        $this->avatar = $avatar;
    }

    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario){
        $this->nombreUsuario = $nombreUsuario;
        return $this;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
        return $this;
    }

    public function getFechaNac(){
        return $this->fechaNac;
    }

    public function setFechaNac($fechaNac){
        $this->fechaNac = $fechaNac;
        return $this;
    }

    public function getCiudad(){
        return $this->ciudad;
    }

    public function setCiudad($ciudad){
        $this->ciudad = $ciudad;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getAvatar(){
        return $this->avatar;
    }

    public function setAvatar($avatar){
        $this->avatar = $avatar;
        return $this;
    }

    public function compruebaPassword($password){
        return password_verify($password, $this->password);
    }

    // inutil
    /*public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }*/
}

?>