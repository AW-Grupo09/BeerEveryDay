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

		$cesta = loadCesta($_SESSION["user"]);
		$query = "DELETE FROM  Pedidos WHERE idPedido = '$cesta'";
		$correcto = $mysqli->query($query) or die ($mysqli->error . " en la línea " . (__LINE__-1));
	}

	public static eliminarElementoCesta($cerveza){
		//Esta funcion se encarga de eliminar un elemento de la cesta


	}

	public static iniciarCesta($cerveza, $unidades){
		//Esto inicializa un pedido, tan pronto como se añada un elemento a una cesta vacia
		//php generate unic id.
	}

	private loadUser($idPedido){
		//En funcion de un idPedido carga el usuario al que le corresponda el pedido


	}

	private loadBeers($idPedido){
		//Carga las cervezas y las unidades de un pedido


	}

	private loadGroup($idPedido){
		//Carga el nombre del grupo al que pertenece el pedido

	}
	private loadCesta($user){
		//Devuelve el id de la cesta que corresponda al usuario


	}

    public function getIdPedido()
    {
        return $this->idPedido;
    }


    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getGrupo()
    {
        return $this->grupo;
    }

    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    public function getCervezas()
    {
        return $this->cervezas;
    }

    public function setCervezas($cervezas)
    {
        $this->cervezas = $cervezas;

        return $this;
    }

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    public function getDir()
    {
        return $this->dir;
    }

    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    public function getTarjeta()
    {
        return $this->tarjeta;
    }

    public function setTarjeta($tarjeta)
    {
        $this->tarjeta = $tarjeta;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}



?>