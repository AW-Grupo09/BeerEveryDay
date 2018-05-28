<?php

require_once __DIR__.'/../DAO/DAOGrupos.php';

class controllerGrupos
{
    private static $daoGrupos;
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS-PEDIDOS -------------------------------------------------------*/
    public static function insertaGrupoPedidos($idGrupo,$idPedido){
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->insertaGrupoPedidos($idGrupo,$idPedido);
    } 
   
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS-USUARIOS -------------------------------------------------------*/

    /*Funcion que me devuelve todos los grupos a los que pertece un usuario, ya sea porque lo ha creado o porque se ha unido a el */
    public static function getGruposByUser($usuario){
        $daoGrupos = new DAOGrupos();
        $resultado = $daoGrupos->getGruposByUser($usuario);
        $grupos = array();
        foreach ($resultado as $idGrupo) {
            $grupo = $daoGrupos->getGrupoById($idGrupo);
            array_push($grupos, $grupo);
        }
        return $grupos;
    }

    /*Funcion que comprueba si un usuario existe en la tabla GRUPOS-USUARIO , false en caso contrario*/
    public static function buscaUsuarioenGrupos($idUsuario, $idGrupo){
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->buscaUsuarioenGrupos($idUsuario, $idGrupo);
    }

    /*Funcion que inserta un usuario y idGrupo en la tabla GRUPOS-USUARIOS*/
    public static function insertaGrupoUsuarios($idUsuario, $idGrupo,$unidades){
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->insertaGrupoUsuarios($idUsuario, $idGrupo,$unidades);
    }
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS -------------------------------------------------------*/

    /*Funcion de devuelve todos los grupos de la tabla grupos*/
    public static function getGrupos(){
        $daoGrupos = new DAOGrupos();
        $resultado = $daoGrupos->getGrupos();
        $grupos = array();
        foreach ($resultado as $idGrupo) {
            $grupo = $daoGrupos->getGrupoById($idGrupo);
            array_push($grupos, $grupo);
        }
        return $grupos;
    }

    public static function getGrupoById($idGrupo){
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->getGrupoById($idGrupo);
    }

    /*Crea un grupo en la TABLA GRUPOS si este no existe. Si existe devuelve FALSE*/
    public static function creaGrupo($nombre, $direccion, $ciudad) {
        $daoGrupos = new DAOGrupos();
        $grupo = $daoGrupos->buscaGrupo($nombre);
        if ($grupo) {
            return false;
        }
        $grupo = new TOGrupos($nombre, $direccion, $_SESSION['nombreUsuario'], $ciudad);
        $grupo = $daoGrupos->getGrupoById($daoGrupos->inserta($grupo));
        return $grupo;
    }

    /*Busca un grupo por el nombre en la TABLA GRUPOS*/
     public static function buscaGrupo($nombreGrupo) {
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->buscaGrupo($nombreGrupo);
    }

    public static function actualizaGrupo($nombre, $direccion, $ciudad){
        $daoGrupos = new DAOGrupos();
        $grupo = $daoGrupos->buscaGrupo($nombre);
        if (!$grupo) {
            return false;
        }
        $grupo = new TOGrupos($nombre, $direccion, $ciudad);
        return $daoGrupos->actualiza($grupo);
    }

    private static function inserta($grupo){
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->inserta($grupo);
    }

    private static function actualiza($grupo){
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->actualiza($grupo);
    }

    public static function salirGrupo($idGrupo,$idUsuario){
        $daoGrupos = new DAOGrupos();
        return $daoGrupos->salirGrupo($idGrupo, $idUsuario);
    }

    public static function eliminarGrupo($idGrupo,$idUsuario){
        $daoGrupo = new DAOGrupos();
        $daoGrupos->salirGrupo($idGrupo,$idUsuario);
        $daoGrupos->eliminarGrupo($idGrupo,$idUsuario);
        $idPedido = $dao->getIdPedidoByGrupo($idGrupo);
        $daoGrupos->eliminarPedido($idPedido);
        $daoGrupos->eliminarGrupoPedidos($idGrupo);
    }

}

?>