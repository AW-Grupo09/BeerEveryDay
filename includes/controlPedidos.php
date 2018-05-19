<?php

//require_once __DIR__ . '/../includes/Aplicacion.php';
include('pedidos.php');
include('DAO.php');

class controlPedidos {

    public static function loadPedido($idPedido){
        $pedido = new pedidos($idPedido);

        $dao = new DAO();
        $sql = "SELECT * FROM pedidos WHERE idPedido LIKE '$idPedido'";
        $consulta = $dao->ejecutarConsulta($sql);
        
        if (count($consulta) > 0) {
            $pedido->setDir($consulta[0]["Direccion"]);
            $pedido->setEstado($consulta[0]["estado"]);
            $pedido->setTarjeta($consulta[0]["tarjeta"]);
            $pedido->setFechaPedido($consulta[0]["fechaPedido"]);
            $pedido->setFechaLimite($consulta[0]["fechaLimite"]);
            $pedido->setFechaEntrega($consulta[0]["fechaEntrega"]);
        } else{
            return null;
        }
        
        $sql = "SELECT idUsuario FROM `usuarios-pedidos` WHERE idPedido = $idPedido";
        $consulta = $dao->ejecutarConsulta($sql);
        $pedido->setUser($consulta[0]["idUsuario"]);

        $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
        $consulta = $dao->ejecutarConsulta($sql);
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
            $consulta = $dao->ejecutarConsulta($sql);
            $pedido->grupo = $consulta[0]["idgrupo"];
        }

        return $pedido;
    }

    public static function eliminarCesta($cesta){
        //Elimina cesta
        //$app = Aplicacion::getSingleton();
        //$mysqli = $app->conexionBd();
        $dao = new DAO();
        $sql = "DELETE FROM  Pedidos WHERE idPedido = '$cesta'";
        $consulta = $dao->ejecutarModificacion($sql);
        //$correcto = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
    }

    public static function eliminarElementoCesta($cerveza, $idPedido){
        //Esta funcion se encarga de eliminar un elemento de la cesta
        $dao = new DAO();
        $sql = "DELETE FROM  `pedidos-cervezas` WHERE idcerveza = '" . $cerveza . "'  and idpedido = '" . $idPedido . "'";
        $consulta = $dao->ejecutarModificacion($sql);
    }

    public static function iniciarCesta($cerveza, $unidades, $user){
        //Se inicia el pedido
        $dao = new DAO();
        $sql = "INSERT INTO pedidos(estado) VALUES ('cesta')";
        $consulta = $dao->ejecutarModificacion($sql);

        $sql = "SELECT max(idPedido) as idpedido FROM pedidos";
        $consulta = $dao->ejecutarConsulta($sql);
        
        controlPedidos::addBeers($cerveza, $unidades, $consulta[0]['idpedido']);
        controlPedidos::insertarPedidosUsuarios($user, $consulta[0]['idpedido']);
    }
    
    public static function insertarPedidosUsuarios($idUser, $idPedido){
        $dao = new DAO();
        $sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $idUser . "'," . $idPedido . ")";
        $consulta = $dao->ejecutarModificacion($sql);
    }
    
    public static function insertarPedidosGrupos($idGrupo){
        $dao = new DAO();
        $sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $this->grupo . "'," . $nuevoID . ")";
        $consulta = $dao->ejecutarModificacion($sql);
    }

    public static function addBeers($cerveza, $unidades, $idpedido){
        $dao = new DAO();
        if($unidades == NULL){
            $unidades = 1;
        }
        $sql = "SELECT idCerveza, idPedido, unidades from `pedidos-cervezas` WHERE idCerveza = " . $cerveza . " and idPedido = " . $idpedido;
        $consulta = $dao->ejecutarConsulta($sql);
        if(count($consulta) == 0){
            $sql = "INSERT INTO `pedidos-cervezas`(`idCerveza`, `idPedido`, `unidades`) VALUES (" .  $cerveza . "," . $idpedido . "," .  $unidades . ")";
           $consulta = $dao->ejecutarModificacion($sql);
        }else{
            $uni = $consulta[0]['unidades'];
            $uni = $uni + $unidades;
            $sql = "UPDATE `pedidos-cervezas` SET unidades = " . $uni . " WHERE idCerveza = " . $cerveza . " and idPedido = " .$idpedido;
            $consulta = $dao->ejecutarModificacion($sql);
        }
    }

    public static function loadCesta($user){
        //Devuelve el idpedido de la cesta que corresponda al usuario
        //$app = Aplicacion::getSingleton();
        //$mysqli = $app->conexionBd();
        $dao = new DAO();
        $sql = "SELECT pedidos.idPedido FROM pedidos, `usuarios-pedidos` WHERE pedidos.idPedido = `usuarios-pedidos`.`idPedido` and estado = 'cesta' and idusuario = '$user'";
        $consulta = $dao->ejecutarConsulta($sql);
        //$consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        //$fila = mysqli_fetch_assoc($consulta);
        //if($consulta->num_rows > 0 and isset($fila["idPedido"])){
        if(count($consulta) > 0 and isset($consulta[0]["idPedido"])){
            //$fila = mysqli_fetch_assoc($consulta);
            return $consulta[0]["idPedido"];
        }
        else {
            return NULL;
        }
    }

    public static function loadPedidos($user){
        $dao = new DAO();
        $sql = "SELECT * FROM `usuarios-pedidos` WHERE idusuario = '$user' GROUP BY idPedido ";
        $consulta = $dao->ejecutarConsulta($sql);
 
        $array = array();
        if (count($consulta) != 0){
            for($i = 0; $i < count($consulta); $i++ ){
                $pedido = controlPedidos::loadPedido($consulta[$i]['idPedido']);
                array_push( $array, $pedido);
            }
            return $array;
        }     
        else {
            return NULL;
        }
    }

     public static function loadInfoPedido($idPedido){
        $dao = new DAO();
        $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
        $consulta = $dao->ejecutarConsulta($sql);
 
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

    public static function procesarCesta($Dir, $Tarjeta, $user){
        $dao = new DAO();
        $idCesta = controlPedidos::loadCesta($user);
        if($idCesta != NULL){
            $Date = date("Y/m/d");
            $sql = "UPDATE pedidos SET estado = 'confirmado' , Direccion = '" .$Dir. "', tarjeta = '" .$Tarjeta. "', fechaPedido = '" .$Date. "'WHERE idPedido = ". $idCesta;
            $consulta = $dao->ejecutarModificacion($sql);
            return NULL;
        }
        else{
            return "<p>Error al cargar la cesta</p>";
        }
    }
}

?>