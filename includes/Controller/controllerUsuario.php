<?php

require_once __DIR__.'/../DAO/DAOUsuario.php';

class controllerUsuario
{
    private static $daoUsuario;

    public static function login($nombreUsuario, $password) {
        $daoUsuario = new DAOUsuario();
        $user = $daoUsuario->buscaUsuario($nombreUsuario);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return NULL;
    }

    public static function buscaUsuario($nombreUsuario) {
        $daoUsuario = new DAOUsuario();
        return $daoUsuario->buscaUsuario($nombreUsuario);
    }
    
    
    public static function crea($nombreUsuario, $nombre, $password, $rol, $ciudad, $fechaNac, $email, $apellidos, $avatar){
        $daoUsuario = new DAOUsuario();
        $user = $daoUsuario->buscaUsuario($nombreUsuario);
        if ($user) {
            return NULL;
        }
        $user = new TOUsuario($nombreUsuario, $nombre, self::hashPassword($password), $rol, $ciudad, $fechaNac, $email, $apellidos, $avatar);
        $daoUsuario->inserta($user);
        return $user;
    }
    
    private static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
   
    public static function actualizaUser($nombreUsuario, $usuario, $nombre, $apellidos, $ciudad, $email, $fechaNac) {
        $daoUsuario = new DAOUsuario();
        $daoUsuario->actualizaUser($nombreUsuario, $usuario, $nombre, $apellidos, $ciudad, $email, $fechaNac);
    }

    public static function actualizaUserPassword($nombreUsuario, $usuario, $password){
        $daoUsuario = new DAOUsuario();
        $daoUsuario->actualizaUserPassword($nombreUsuario, $usuario, self::hashPassword($password));
    }

    public static function actualizaUserAvatar($nombreUsuario, $usuario, $avatar){
        $daoUsuario = new DAOUsuario();
        $daoUsuario->actualizaUserAvatar($nombreUsuario, $usuario, $avatar);
    }

   
    public static function esAdmin($usuario){
        $daoUsuario = new DAOUsuario();
        return $daoUsuario->esAdmin($usuario);
    }

    public static function correoExiste($nombreUsuario, $email) {
        $daoUsuario = new DAOUsuario();
        return $daoUsuario->correoExiste($nombreUsuario, $email);
    }
}

?>