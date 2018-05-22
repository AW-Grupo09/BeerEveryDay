<?php


//require_once __DIR__ . '/../includes/Aplicacion.php';
require_once __DIR__.'\..\DAO\DAOPedidos.php';

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
        for($i = 0; $i < count($resultado); $i++ ){
            array_push($pedidos, $daoPedido->loadPedido($resultado[$i]));
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

    public static function procesarCesta($Dir, $Tarjeta, $user){
        $daoPedido = new DAOPedidos();
        $idCesta = $daoPedido->loadCesta($user);
        $Date = date("Y/m/d");
        $daoPedido->procesarCesta($Dir, $Tarjeta, $idCesta, $Date);
    }
}

?>