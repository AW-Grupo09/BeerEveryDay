<?php

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
        
        $sql = "SELECT idUsuario FROM `usuarios-pedidos` WHERE idPedido = $idPedido";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        $this->user = $fila["idUsuario"];

        $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1)); 

        $i = 0;
        while($fila= mysqli_fetch_assoc($consulta)){
            $this->cervezas[$i] = $fila["idcerveza"];
            $this->unidades[$i] = $fila["unidades"];
            $i++;
        }  

        if($this->estado == "grupo"){
            $sql = "SELECT idGrupo FROM `grupos-pedidos`";
            $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
            $fila = mysqli_fetch_assoc($consulta);
            $this->grupo = $fila["idgrupo"];
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
