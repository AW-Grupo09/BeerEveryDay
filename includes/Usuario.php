<?php
require_once __DIR__ . '/Aplicacion.php';

class Usuario
{

    public static function login($nombreUsuario, $password)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario = '$nombreUsuario'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);   
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol'], $fila['ciudad'], $fila['fechaNac'], $fila['email'], $fila['apellidos'], $fila['avatar']);
                $result = $user;
            }
            else
                $result = NULL;
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function crea($nombreUsuario, $nombre, $password, $rol, $ciudad, $fechaNac, $email, $apellidos, $avatar)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        }
        $user = new Usuario($nombreUsuario, $nombre, self::hashPassword($password), $rol, $ciudad, $fechaNac, $email, $apellidos, $avatar);
        return self::guarda($user);
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public static function guarda($usuario)
    {
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }
    
    private static function inserta($usuario)
    {

        var_dump($usuario);
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password, rol, ciudad, fechaNac, email, apellidos, avatar) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
            , $conn->real_escape_string($usuario->ciudad)
            , $conn->real_escape_string($usuario->fechaNac)
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->apellidos)
            , $conn->real_escape_string($usuario->avatar)
            );
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
    
    // aun no se usa pero se usará
    private static function actualiza($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', rol='%s' WHERE U.id=%i"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->rol)
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }
    
    //Para saber si un usuario es admin o no
    public static function esAdmin($usuario){

        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.nombreUsuario = '$nombreUsuario'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);   
        $result = false;
        $isAdmin = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                if($fila["rol"] == "admin")
                    $admin = true;
            }
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }

        return $isAdmin;

    }

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

    private function __construct($nombreUsuario, $nombre, $password, $rol, $ciudad, $fechaNac, $email, $apellidos, $avatar)
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

 
    public function rol()
    {
        return $this->rol;
    }

    public function nombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function nombre()
    {
        return $this->nombre;
    }

    public function ciudad(){
        return $this->ciudad;
    }

    public function apellidos()
    {
        return $this->apellidos;
    }

    public function fechaNac()
    {
        return $this->fechaNac;
    }

    public function email()
    {
        return $this->email;
    }

    public function avatar()
    {
        return $this->avatar;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
}
