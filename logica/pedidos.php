<?php
require_once __DIR__.'/conexion.php';
//include('conexion.php');

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
        $mysqli = conexion::getConection();
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
        $mysqli = conexion::getConection();
		$query = "DELETE FROM  Pedidos WHERE idPedido = '$cesta'";
		$correcto = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

	public static function eliminarElementoCesta($cerveza, $idPedido){
		//Esta funcion se encarga de eliminar un elemento de la cesta
        $mysqli = conexion::getConection();
        $query = "DELETE FROM  `pedidos-cervezas` WHERE idcerveza = '" . $cerveza . "'  and idpedido = '" . $idPedido . "'";
        $consulta = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

	public static function iniciarCesta($cerveza, $unidades){
        //Se inicia el pedido
        $mysqli = conexion::getConection();
		$nuevoID = uniqid();
        $sql = "INSERT INTO pedidos(idPedido, estado) VALUES (" . $nuevoID . ",'cesta')";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
        addCerveza($cerveza, $unidades, $nuevoID);
        //Añadir en la tabla pedidos-usuarios
		$this->insertarPedidosUsuarios($nuevoID, $mysqli);
    }
	
	public static function insertarPedidosUsuarios($idUser, $mysqli){
		$sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $this->user . "'," . $idUser . ")";
		$consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}
	
	public static function insertarPedidosGrupos($idGrupo){
		$sql = "INSERT INTO `usuarios-pedidos`(`idUsuario`, `idPedido`) VALUES ('" . $this->grupo . "'," . $nuevoID . ")";
		$consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

    public static function addBeers($cerveza, $unidades, $idpedido){
        $mysqli = conexion::getConection();
        $sql = "INSERT INTO `pedidos-cervezas`(`idCerveza`, `idPedido`, `unidades`) VALUES (" .  $cerveza . "," . $idpedido . "," .  $unidades . ")";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
    }

    private function loadUser($idPedido){
        //Carga el usuario al que le corresponda el pedido
        $mysqli = conexion::getConection();
        $sql = "SELECT idUsuario FROM `usuarios-pedidos` WHERE idPedido = $idPedido";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        $this->user = $fila["idUsuario"];
	}

	private function loadBeers($idPedido, $mysqli){
		//Carga las cervezas y las unidades de un pedid
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
        $mysqli = conexion::getConection();
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
