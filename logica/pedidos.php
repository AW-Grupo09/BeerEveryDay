<?php

class pedidos{
	private $idPedido;
	private $user;
	private $grupo;
	private $cervezas = array();
	private $unidades = array();
	private $dir;
	private $tarjeta;
	private $estado;
	private $fechapedido
	private $fechaLimite
	private $fechaEntrega

	public function __construct($idPedido, $mysqli){

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
		
		$this->user = findUser($idPedido);
		$this->cervezas = findBeers($idPedido);
	}

	public static eliminarCesta(){
        //Esto debe realizarse despues de eliminar todos los elementos de la cesta
		$cesta = loadCesta($_SESSION["user"]);
		$query = "DELETE FROM  Pedidos WHERE idPedido = '$cesta'";
		$correcto = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

	public static eliminarElementoCesta($cerveza){
		//Esta funcion se encarga de eliminar un elemento de la cesta
        $query = "DELETE FROM  `pedidos-cervezas` WHERE idcerveza = '" . $cerveza . "'  and idpedido = '" . $idPedido . "'";
        $consulta = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

	public static iniciarCesta($cerveza, $unidades){
        //Obtiene el id mas alto y le suma 1 para un nuevo id
        $sql = "SELECT MAX(idPedido) FROM pedidos";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        $id = $fila["id"];
        $id++;
        //Se inicializa el pedido
        $sql = "INSERT INTO pedidos(idPedido, estado) VALUES (" . $id . ",'cesta')";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
        $sql = "INSERT INTO `pedidos-cervezas`(`idCerveza`, `idPedido`, `unidades`) VALUES (" .  $cerveza . "," . $id . "," .  $unidades . ")";
        $consulta = $mysqli->query($sql) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

	private loadUser($idPedido){
		//Carga el usuario al que le corresponda el pedido
        $sql = "SELECT idUsuario FROM usuarios-pedidos";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        $user = $fila["idUsuario"];
	}

	private loadBeers($idPedido){
		//Carga las cervezas y las unidades de un pedid
        $sql = "SELECT idcerveza, unidades FROM `pedidos-cervezas` WHERE idpedido = ". $idPedido;
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1)); 

        $i = 0;
        while($fila= mysqli_fetch_assoc($consulta)){
            $cervezas[$i] = $fila["idCerveza"];
            $unidades[$i] = $fila["unidades"]
            $i++;
        }   
	}

	private loadGroup($idPedido){
		//Carga el id del grupo al que pertenece el pedido
        $sql = "SELECT idGrupo FROM `grupos-pedidos`";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        $idgrupo = $fila["idgrupo"];
	}
	private loadCesta($user){
		//Devuelve el idpedido de la cesta que corresponda al usuario
        $sql = "SELECT pedidos.idpedido FROM pedidos, `usuarios-pedidos` WHERE pedidos.idPedido = `usuarios-pedidos`.`idPedido` and estado = 'cesta' and idusuario = '" .  $user . "'";
        $consulta = $mysqli->query($sql) or die ($mysqli->error. " en la línea ".(__LINE__-1));
        $fila = mysqli_fetch_assoc($consulta);
        $idpedido = $fila["idpedido"];
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
