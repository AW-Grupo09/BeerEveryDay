<?php

include_once('DAO.php');

class DAOUsuario extends DAO{

    public function __construct() {
       parent::__construct();
    }

    public function buscaUsuario($nombreUsuario) {
        $query = "SELECT * FROM usuarios U WHERE U.nombreUsuario = '$nombreUsuario'";
        $rs = $this->ejecutarConsulta($query);
        $result = false;
        if ($rs) {
            if (count($rs) == 1) {
                $user = new TOUsuario($rs[0]['nombreUsuario'], $rs[0]['nombre'], $rs[0]['password'], $rs[0]['rol'], $rs[0]['ciudad'], $rs[0]['fechaNac'], $rs[0]['email'], $rs[0]['apellidos'], $rs[0]['avatar']);
                $result = $user;
            }else {
                $result = NULL;
            }
        } else {
            //echo "Error al consultar en la BD";
        }
        return $result;
    }
   
    public function inserta($usuario) {
        $query=sprintf("INSERT INTO usuarios(nombreUsuario, nombre, password, rol, ciudad, fechaNac, email, apellidos, avatar) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
            , $usuario->getNombreUsuario()
            , $usuario->getNombre()
            , $usuario->getPassword()
            , $usuario->getRol()
            , $usuario->getCiudad()
            , $usuario->getFechaNac()
            , $usuario->getEmail()
            , $usuario->getApellidos()
            , $usuario->getAvatar()
            );

        $this->ejecutarModificacion($query);
    }
    
   
    public function actualizaUser($nombreUsuario, $usuario, $nombre, $apellidos, $ciudad, $email, $fechaNac) {
        $query = "UPDATE usuarios U SET nombre='$nombre', apellidos='$apellidos', ciudad='$ciudad', email='$email', fechaNac='$fechaNac' WHERE U.nombreUsuario='$nombreUsuario'";
        $this->ejecutarModificacion($query);
    }

    public function actualizaUserPassword($nombreUsuario, $usuario, $pass) {
        $query = "UPDATE usuarios U SET password='$pass' WHERE U.nombreUsuario='$nombreUsuario'";
        $this->ejecutarModificacion($query);
    }

    public function actualizaUserAvatar($nombreUsuario, $usuario, $avatar) {
        $query = "UPDATE usuarios U SET avatar='$avatar' WHERE U.nombreUsuario='$nombreUsuario'";
        $this->ejecutarModificacion($query);
    }

   
    public function esAdmin($usuario) {
        $query = "SELECT * FROM usuarios U WHERE U.nombreUsuario = '$usuario'";
        $rs = $this->ejecutarConsulta($query);
        $isAdmin = false;
        if ($rs) {
            if ( count($rs) == 1) {
                if($rs[0]["rol"] == "admin"){
                    $isAdmin = true;
                }
            }
        } else {
            //echo "Error al consultar en la BD";
        }
        return $isAdmin; // true si es admin, false en coc
    }

    public function correoExiste($nombreUsuario, $email) {
        $query = "SELECT * FROM usuarios U WHERE U.nombreUsuario != '$nombreUsuario' and U.email = '$email'";
        $rs = $this->ejecutarConsulta($query);
        $repiteEmail = false;
        if ($rs) {
            if (count($rs) > 0) {
                $repiteEmail = true;   
            }
        }
        else{
            //echo "Error al consultar en la BD";
        }     
        return $repiteEmail;
    }
}

?>