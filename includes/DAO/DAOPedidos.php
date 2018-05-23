<?php

include_once('DAO.php');

class DAOPedidos {

    private $dao;

    public function __construct(){
        $this->dao = new DAO();
    }

    public function loadPedido($idPedido){
        $pedido = new TOPedidos($idPedido);

        $sql = "SELECT * FROM pedidos WHERE idPedido LIKE '$idPedido'";
        $consulta = $this->dao->ejecutarConsulta($sql);
        
        if (count($consulta) > 0) {
            $pedido->setDir($consulta[0]["Direccion"]);
            $pedido->setEstado($consulta[0]["estado"]);
            $pedido->setFechaPedido($consulta[0]["fechaPedido"]);
            $pedido->setFechaLimite($consulta[0]["fechaLimite"]);
            $pedido->setFechaEntrega($consulta[0]["fechaEntrega"]);
        } else{
            return null;
        }
        
        $sql = "SELECT idUsuario FROM `usuarios-pedidos` WHERE idPedido = $idPedido";
        $consulta = $this->dao->ejecutarConsulta($sql);
        $pedido->setUser($consulta[0]["idUsuario"]);

        $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
        $consulta = $this->dao->ejecutarConsulta($sql);
        $cervezas = array();
        $unidades = array();
        $i = 0;
        while($i < count($consulta)){
            $cervezas[$i] = $consulta[$i]["idcerveza"];
            $unidades[$i] = $consulta[$i]["unidades"];
            $i++;
        }
        $pedido->setCervezas($cervezas);
        $pedido->setUnidades($unidades);

        if($pedido->getEstado() == "grupo"){
            $sql = "SELECT idGrupo FROM `grupos-pedidos`";
            $consulta = $this->dao->ejecutarConsulta($sql);
            $pedido->grupo = $consulta[0]["idgrupo"];
        }

        return $pedido;
    }

    public function loadPedidos($user){
        $sql = "SELECT * FROM `usuarios-pedidos` WHERE idusuario = '$user' GROUP BY idPedido ";
        $consulta = $this->dao->ejecutarConsulta($sql);
        $array = array();
        if (count($consulta) != 0){
            for($i = 0; $i < count($consulta); $i++ ){
                array_push( $array, $consulta[$i]['idPedido']);
            }
            return $array;
        }     
        else {
            return NULL;
        }
    }

    public function eliminarCesta($cesta){
        $sql = "DELETE FROM  Pedidos WHERE idPedido = '$cesta'";
        $consulta = $this->dao->ejecutarModificacion($sql);
    }

    public function eliminarElementoCesta($cerveza, $idPedido){
        $sql = "DELETE FROM  `pedidos-cervezas` WHERE idcerveza = '" . $cerveza . "'  and idpedido = '" . $idPedido . "'";
        $consulta = $this->dao->ejecutarModificacion($sql);
    }

    public function iniciarCesta($user){

        $sql = "INSERT INTO pedidos(estado) VALUES ('cesta')";
        $consulta = $this->dao->ejecutarModificacion($sql);

        $sql = "SELECT max(idPedido) as idpedido FROM pedidos";
        $consulta = $this->dao->ejecutarConsulta($sql);
        return  $consulta[0]['idpedido'];
    }
    
    public function insertarPedidosUsuarios($idUser, $idPedido){
        $sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $idUser . "'," . $idPedido . ")";
        $consulta = $this->dao->ejecutarModificacion($sql);
    }
    
    public function insertarPedidosGrupos($idGrupo){
        $sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $this->grupo . "'," . $nuevoID . ")";
        $consulta = $this->dao->ejecutarModificacion($sql);
    }

    public function cantidadCervezas($cerveza, $idpedido){
        $sql = "SELECT unidades from `pedidos-cervezas` WHERE idCerveza = " . $cerveza . " and idPedido = " . $idpedido;
        $consulta = $this->dao->ejecutarConsulta($sql);
        if(count($consulta) == null){
            return null;
        } else{
            return $consulta[0]['unidades'];
        }
    }

    public function modificarCantidadCervezas($cerveza, $uni, $idpedido){
        $sql = "UPDATE `pedidos-cervezas` SET unidades = " . $uni . " WHERE idCerveza = " . $cerveza . " and idPedido = " .$idpedido;
        $consulta = $this->dao->ejecutarModificacion($sql);
    }

    public function insertarCervezas($cerveza, $unidades, $idpedido){
        $sql = "INSERT INTO `pedidos-cervezas`(`idCerveza`, `idPedido`, `unidades`) VALUES (" .  $cerveza . "," . $idpedido . "," .  $unidades . ")";
        $consulta = $this->dao->ejecutarModificacion($sql);
    }

    public function loadCesta($user){
        $sql = "SELECT pedidos.idPedido FROM pedidos, `usuarios-pedidos` WHERE pedidos.idPedido = `usuarios-pedidos`.`idPedido` and estado = 'cesta' and idusuario = '$user'";
        $consulta = $this->dao->ejecutarConsulta($sql);
        if(count($consulta) > 0 and isset($consulta[0]["idPedido"])){
            return $consulta[0]["idPedido"];
        }
        else {
            return NULL;
        }
    }

    public function loadInfoPedido($idPedido){
        $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
        $consulta = $this->dao->ejecutarConsulta($sql);
 
        $array = array();
        if (count($consulta) != 0){
            for($i = 0; $i < count($consulta); $i++ ){
                array_push($array, $consulta[$i]['idcerveza']);
                array_push($array, $consulta[$i]['unidades']);
            }
            return $array;
        }     
        else {
            return NULL;
        }
    }

    public function procesarCesta($Dir, $idCesta, $Date){
        $sql = "UPDATE pedidos SET estado = 'confirmado' , Direccion = '" .$Dir. "', fechaPedido = '" .$Date. "'WHERE idPedido = ". $idCesta;
        $consulta = $this->dao->ejecutarModificacion($sql);
    }
}

?>