<?php
require_once __DIR__ . '/../includes/Aplicacion.php';

class pedidos {

    private $idPedido;
    private $user;
    private $grupo;
    private $cervezas = array();
    private $unidades = array();
    private $dir;
    private $tarjeta;
    private $estado;
    private $fechapedido;
    private $fechaLimite;
    private $fechaEntrega;

    public function __construct($idPedido){
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query="SELECT * FROM pedidos WHERE idPedido LIKE '$idPedido'";
        $resultado=$mysqli->query($query) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        if (mysqli_num_rows($resultado) > 0) {
            // output data of each row
            $fila = $resultado->fetch_assoc();
            $this->idPedido = $idPedido;
            $this->dir = $fila["Direccion"];
            $this->estado = $fila["estado"];
            $this->tarjeta = $fila["tarjeta"];
            $this->fechapedido = $fila["fechaPedido"];
            $this->fechaLimite = $fila["fechaLimite"];
            $this->fechaEntrega = $fila["fechaEntrega"];
        }
        
        $this->loadUser($idPedido);
        $this->loadBeers($idPedido, $mysqli);
        if($this->estado == "grupo")
            $this->grupo = LoadGrupo($idPedido);
    }

    public static function eliminarCesta($cesta){
        //Elimina cesta
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "DELETE FROM  Pedidos WHERE idPedido = '$cesta'";
        $correcto = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
    }

    public static function eliminarElementoCesta($cerveza, $idPedido){
        //Esta funcion se encarga de eliminar un elemento de la cesta
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $query = "DELETE FROM  `pedidos-cervezas` WHERE idcerveza = '" . $cerveza . "'  and idpedido = '" . $idPedido . "'";
        $consulta = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
    }

    public static function iniciarCesta($cerveza, $unidades, $user){
        //Se inicia el pedido
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        //$nuevoID = uniqid();
        $sql = "INSERT INTO pedidos(estado) VALUES ('cesta')";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));

        $sql = "SELECT max(idPedido) as idpedido FROM pedidos";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        
        pedidos::addBeers($cerveza, $unidades, $fila['idpedido']);

        pedidos::insertarPedidosUsuarios($user, $fila['idpedido'], $mysqli);
    }
    
    public static function insertarPedidosUsuarios($idUser, $idPedido, $mysqli){
        $sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $idUser . "'," . $idPedido . ")";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
    }
    
    public static function insertarPedidosGrupos($idGrupo){
        $sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $this->grupo . "'," . $nuevoID . ")";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
    }

    public static function addBeers($cerveza, $unidades, $idpedido){
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        if($unidades == NULL)
            $unidades = 1;
        $sql = "INSERT INTO `pedidos-cervezas`(`idCerveza`, `idPedido`, `unidades`) VALUES (" .  $cerveza . "," . $idpedido . "," .  $unidades . ")";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
    }

    private function loadUser($idPedido){
        //Carga el usuario al que le corresponda el pedido
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $sql = "SELECT idUsuario FROM `usuarios-pedidos` WHERE idPedido = $idPedido";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        $this->user = $fila["idUsuario"];
    }

    private function loadBeers($idPedido, $mysqli){
        //Carga las cervezas y las unidades de un pedido
            $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
            $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1)); 

            $i = 0;
            while($fila= mysqli_fetch_assoc($consulta)){
                $this->cervezas[$i] = $fila["idcerveza"];
                $this->unidades[$i] = $fila["unidades"];
                $i++;
            }   
    }

    private function loadGroup($idPedido, $mysqli){
        //Carga el id del grupo al que pertenece el pedido
        $sql = "SELECT idGrupo FROM `grupos-pedidos`";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        return $fila["idgrupo"];
    }

    public static function loadCesta($user){
        //Devuelve el idpedido de la cesta que corresponda al usuario
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $sql = "SELECT pedidos.idPedido FROM pedidos, `usuarios-pedidos` WHERE pedidos.idPedido = `usuarios-pedidos`.`idPedido` and estado = 'cesta' and idusuario = '$user'";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        if($consulta->num_rows > 0 and isset($fila["idPedido"])){
            //$fila = mysqli_fetch_assoc($consulta);
            return $fila["idPedido"];
        }
        else {
            return NULL;
        }
    }

    public static function loadPedidos($user){
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $sql = "SELECT * FROM `usuarios-pedidos` WHERE idusuario = '$user' GROUP BY idPedido ";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
 
        $array = array();

        if (mysqli_num_rows($consulta)!=0){

            while($fila = mysqli_fetch_assoc($consulta) ){

                array_push( $array, $fila['idPedido']);
                
            }
            return $array;
        }     
        else {
            return NULL;
        }
    }

     public static function loadInfoPedido($idPedido){
        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        //$sql = "SELECT * FROM `usuarios-pedidos` WHERE idusuario = '$user' GROUP BY idPedido ";

        $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
 
        $array2 = array();

        if (mysqli_num_rows($consulta)!=0){

            while($fila = mysqli_fetch_assoc($consulta) ){

                array_push( $array2, $fila['idcerveza']);
                array_push( $array2, $fila['unidades']);
               
  
            }
            return $array2;
        }     
        else {
            return NULL;
        }
    }

    public static function procesarCesta($Dir, $Tarjeta, $user){

        $app = Aplicacion::getSingleton();
        $mysqli = $app->conexionBd();
        $idCesta = pedidos::loadCesta($user);
        if($idCesta != NULL){
            $Date = date("Y/m/d");
            $sql = "UPDATE pedidos SET estado = 'confirmado' , Direccion = '" .$Dir. "', tarjeta = '" .$Tarjeta. "', fechaPedido = '" .$Date. "'WHERE idPedido = ". $idCesta;
            $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
            return NULL;
        }
        else{
            return "<p>Error al cargar la cesta</p>";
        }
    }



    public function getIdPedido(){
        return $this->idPedido;
    }


    public function setIdPedido($idPedido){
        $this->idPedido = $idPedido;
        return $this;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    public function getGrupo(){
        return $this->grupo;
    }

    public function setGrupo($grupo){
        $this->grupo = $grupo;
        return $this;
    }

    public function getCervezas(){
        return $this->cervezas;
    }

    public function setCervezas($cervezas){
        $this->cervezas = $cervezas;
        return $this;
    }

    public function getUnidades(){
        return $this->unidades;
    }

    public function setUnidades($unidades){
        $this->unidades = $unidades;
        return $this;
    }

    public function getDir(){
        return $this->dir;
    }

    public function setDir($dir){
        $this->dir = $dir;
        return $this;
    }

    public function getTarjeta(){
        return $this->tarjeta;
    }

    public function setTarjeta($tarjeta){
        $this->tarjeta = $tarjeta;
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }
}

?>
