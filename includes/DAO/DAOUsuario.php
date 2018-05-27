<?php

include_once('DAO.php');

class DAOUsuario extends DAO{

    public function __construct() {
       parent::__construct();
    }

    public function buscaUsuario($nombreUsuario) {
        $query = "SELECT * FROM usuarios U WHERE U.nombreUsuario = '" . mysqli_real_escape_string($this->mysqli, $nombreUsuario) . "'";
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
            , mysqli_real_escape_string($this->mysqli, $usuario->getNombreUsuario())
            , mysqli_real_escape_string($this->mysqli, $usuario->getNombre())
            , mysqli_real_escape_string($this->mysqli, $usuario->getPassword())
            , mysqli_real_escape_string($this->mysqli, $usuario->getRol())
            , mysqli_real_escape_string($this->mysqli, $usuario->getCiudad())
            , mysqli_real_escape_string($this->mysqli, $usuario->getFechaNac())
            , mysqli_real_escape_string($this->mysqli, $usuario->getEmail())
            , mysqli_real_escape_string($this->mysqli, $usuario->getApellidos())
            , mysqli_real_escape_string($this->mysqli, $usuario->getAvatar())
            );

        $this->ejecutarModificacion($query);
    }
    
   
    public function actualizaUser($nombreUsuario, $usuario, $nombre, $apellidos, $ciudad, $email, $fechaNac) {
        $query = "UPDATE usuarios U SET nombre='" . mysqli_real_escape_string($this->mysqli, $nombre) . 
            "', apellidos='" . mysqli_real_escape_string($this->mysqli, $apellidos) . 
            "', ciudad='" . mysqli_real_escape_string($this->mysqli, $ciudad) . 
            "', email='" . mysqli_real_escape_string($this->mysqli, $email) . 
            "', fechaNac='" . mysqli_real_escape_string($this->mysqli, $fechaNac) . 
            "' WHERE U.nombreUsuario='" . $this->mysqli->real_escape_string($nombreUsuario) . "'";
        $this->ejecutarModificacion($query);
    }

    public function actualizaUserPassword($nombreUsuario, $usuario, $pass) {
        $query = "UPDATE usuarios U SET password='" . $this->mysqli->real_escape_string($pass) . "' WHERE U.nombreUsuario='" . $this->mysqli->real_escape_string($nombreUsuario) . "'";
        $this->ejecutarModificacion($query);
    }

    public function actualizaUserAvatar($nombreUsuario, $usuario, $avatar) {
        $query = "UPDATE usuarios U SET avatar='" . $this->mysqli->real_escape_string($avatar) . "' WHERE U.nombreUsuario='$nombreUsuario'";
        $this->ejecutarModificacion($query);
    }

   
    public function esAdmin($usuario) {
        $query = "SELECT * FROM usuarios U WHERE U.nombreUsuario = '" . $this->mysqli->real_escape_string($usuario) . "'";
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
        $query = "SELECT * FROM usuarios U WHERE U.nombreUsuario != '" . $this->mysqli->real_escape_string($nombreUsuario) . "' and U.email = '" . mysqli_real_escape_string($this->mysqli, $email) . "'";
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