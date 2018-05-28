<?php


//require_once __DIR__ . '/../includes/Aplicacion.php';
require_once __DIR__.'/../DAO/DAOPedidos.php';

class controllerPedidos {

    private static $daoPedido;

    public static function loadPedido($idPedido){
        $daoPedido = new DAOPedidos();
        return $daoPedido->loadPedido($idPedido);
    }

    public static function loadPedidos($user){
        $daoPedido = new DAOPedidos();
        $resultado = $daoPedido->loadPedidos($user);
        $pedidos = array();
        if($resultado != NULL){
            for($i = 0; $i < count($resultado); $i++ ){
                array_push($pedidos, $daoPedido->loadPedido($resultado[$i]));
            }
        }
        return $pedidos;
    }

    public static function eliminarCesta($cesta){
        $daoPedido = new DAOPedidos();
        $daoPedido->eliminarCesta($cesta);
    }

    public static function eliminarElementoCesta($cerveza, $idPedido){
        $daoPedido = new DAOPedidos();
        $daoPedido->eliminarElementoCesta($cerveza, $idPedido);
    }

    public static function iniciarCesta($cerveza, $unidades, $user){
        $daoPedido = new DAOPedidos();
        $id = $daoPedido->iniciarCesta($user);
        if($unidades == null){
            $unidades = 1;
        }
        $daoPedido->insertarCervezas($cerveza, $unidades, $id);
        $daoPedido->insertarPedidosUsuarios($user, $id);
    }
    
    public static function insertarPedidosUsuarios($idUser, $idPedido){
        $daoPedido = new DAOPedidos();
        $daoPedido->insertarPedidosUsuarios($idUser, $idPedido);
    }
    
    public static function insertarPedidosGrupos($idGrupo){
        $daoPedido = new DAOPedidos();
        $daoPedido->insertarPedidosGrupos($idGrupo);
    }

    public static function addBeers($cerveza, $unidades, $idpedido){
        $daoPedido = new DAOPedidos();
        if($unidades == NULL){
            $unidades = 1;
        }
        $consulta = $daoPedido->cantidadCervezas($cerveza, $idpedido);
        if($consulta == NULL){
            $daoPedido->insertarCervezas($cerveza, $unidades, $idpedido);
        }else{
            $uni = $consulta[0];
            $uni = $uni + $unidades;
            $daoPedido->modificarCantidadCervezas($cerveza, $uni, $idpedido);
        }
    }

    public static function loadCesta($user){
        //cargar pedido y pasar el pedido
        $daoPedido = new DAOPedidos();
        $id = $daoPedido->loadCesta($user);
        if($id != null){
            return $daoPedido->loadPedido($id);
        }else{
            return null;
        }
        
    }

    public static function loadInfoPedido($idPedido){
        $daoPedido = new DAOPedidos();
        return $DAOPedidos->loadInfoPedido($idPedido);
    }

    public static function procesarCesta($Dir, $user){
        $daoPedido = new DAOPedidos();
        $idCesta = $daoPedido->loadCesta($user);
        $Date = date("Y/m/d");
        $daoPedido->procesarCesta($Dir, $idCesta, $Date);
    }

    public static function procesarPedido($idCerveza,$dirreccion,$unidades){
        $daoPedido = new DAOPedidos();
        
        $date = date("Y/m/d");
        $dateLimite = strtotime ('+14 day' , strtotime ( $date ));
        $dateLimite = date("Y/m/d",$dateLimite);

        $daoPedido->insertarPedido($dirreccion,$date,$dateLimite);
        $idPedido = $daoPedido->getIdPedido();
        $daoPedido->insertarCervezas($idCerveza,$unidades,$idPedido);
        
        return $idPedido;
    }

    public static function cantidadTotal($idGrupo){
        $daoPedido = new DAOPedidos();
        return $daoPedido->cantidadTotalCervezas($idGrupo);
    }

    public static function fechaLimite($idGrupo){
        $daoPedido = new DAOPedidos();
        return $daoPedido->fechaLimitePedido($idGrupo);
    }

    public static function cantidadActual($idGrupo){
        $daoPedido = new DAOPedidos();
        return $daoPedido->cantidadActualCervezas($idGrupo);
    }

    public static function cantidadUsuarioGrupo($idGrupo, $nombreUsuario){
        $daoPedido = new DAOPedidos();
        return $daoPedido->cantidadCervezasUsuario($idGrupo, $nombreUsuario);
    }
    
    public static function getCervezaByIdGrupo($idGrupo){
        $daoPedido = new DAOPedidos();
        $idPedido = $daoPedido->getIdPedidoByGroup($idGrupo);
        $idCerveza = $daoPedido->getIdCerveza($idPedido);
        return $daoPedido->getCervezaById($idCerveza);

    }
    public static function actualizarEstadoPedido($idGrupo){
        $daoPedido = new DAOPedidos();
        $idPedido = $daoPedido->getIdPedidoByGroup($idGrupo);
        $Date = date("Y/m/d");
        $daoPedido->actualizarEstado($idPedido, $Date);
    }

    public static function getIdPedidoByGroup($idGrupo){
        $daoPedido = new DAOPedidos();
        return $daoPedido->getIdPedidoByGroup($idGrupo);
    }

    public static function getEstado($idPedido){
        $daoPedido = new DAOPedidos();
        return $daoPedido->getEstado($idPedido);
    }
}

?>