<?php
require_once __DIR__ . '/Aplicacion.php';

class Grupos
{

    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS-PEDIDOS -------------------------------------------------------*/

    public static function insertaGrupoPedidos($idGrupo,$idPedido){

        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf(
            "INSERT INTO `grupo-pedidos` VALUES('%s', '%s')",
            $conn->real_escape_string($idGrupo),
            $conn->real_escape_string($idPedido)
        );

        if ($conn->query($query)) {
            $grupoPedido= $conn->insert_id;
        } else {
            echo "error en la funcion Grupo-Pedidos da error";
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupoPedido;

    } 

   
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS-USUARIOS -------------------------------------------------------*/

    /*Funcion que me devuelve todos los grupos a los que pertece un usuario, ya sea porque lo ha creado o porque se ha unido a el */
    public static function getGruposByUser($usuario){
        $grupos = array();
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("SELECT idGrupo FROM `grupos-usuarios` WHERE idUsuario = '%s'", $conn->real_escape_string($usuario));
        $table =  $conn->query($query);

        if ($table) {
            while ($fila = $table->fetch_assoc()) {
                $idGrupo = $fila['idGrupo'];
                $query = sprintf("SELECT * FROM grupos WHERE idGrupo = %s", $conn->real_escape_string($idGrupo));
                $rs = $conn->query($query);

                if ($rs) {
                    while ($fila = $rs->fetch_assoc()) {
                        $grupo = new Grupos($fila['nombre'], $fila['direccion'], $fila['creador'], $fila['ciudad']);
                        $grupo->setId($fila['idGrupo']);
                        array_push($grupos, $grupo);
                    }
                    $rs->free();
                } else {
                    echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                    exit();
                }
            }
            $table->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupos;
    }

    /*Funcion que comprueba si un usuario existe en la tabla GRUPOS-USUARIO , false en caso contrario*/
    public static function buscaUsuarioenGrupos($idUsuario, $idGrupo){
        $grupos = array();
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf(
            "SELECT * FROM `grupos-usuarios` WHERE idGrupo = '%s' and idUsuario = '%s'",
            $conn->real_escape_string($idGrupo),
            $conn->real_escape_string($idUsuario)
        );
        $rs = $conn->query($query);
        if ($rs) {
            if ($rs->num_rows == 1) {
                /*tranfes object usuario-grupo*/
                $existe = true;
            } else {
                $existe = false;
            }
            $rs->free();
        }

        return $existe;
    }

    /*Funcion que inserta un usuario y idGrupo en la tabla GRUPOS-USUARIOS*/
    public static function insertaGrupoUsuarios($idUsuario, $idGrupo,$unidades){

        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf(
            "INSERT INTO `grupos-usuarios` VALUES('%s', '%s', %s )",
            $conn->real_escape_string($idGrupo),
            $conn->real_escape_string($idUsuario),
            $conn->real_escape_string($unidades)
        );

        if ($conn->query($query)) {
            $grupoUsuario = $conn->insert_id;
        } else {
            echo "aui da error";
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupoUsuario;

    }
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS -------------------------------------------------------*/

    /*Funcion de devuelve todos los grupos de la tabla grupos*/
    public static function getGrupos(){
        $grupos = array();
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM grupos");
        $rs = $conn->query($query);
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                $grupo = new Grupos($fila['nombre'], $fila['direccion'], $fila['creador'], $fila['ciudad']);
                $grupo->setId($fila['idGrupo']);
                array_push($grupos, $grupo);
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupos;
    }

    public static function getGrupoById($idGrupo){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM grupos WHERE idGrupo = %s", $conn->real_escape_string($idGrupo));
        $rs = $conn->query($query);
        $grupo = false;
        if ($rs) {
            if ($rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $grupo = new Grupos($fila['nombre'], $fila['direccion'], $fila['creador'], $fila['ciudad']);
                $grupo->setId($fila['idGrupo']);
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupo;
    }




    /*Crea un grupo en la TABLA GRUPOS si este no existe. Si existe devuelve FALSE*/
    public static function creaGrupo($nombre, $direccion, $ciudad)
    {
        $grupo = self::buscaGrupo($nombre);
        if ($grupo) {
            return false;
        }
        $grupo = new Grupos($nombre, $direccion, $_SESSION['nombreUsuario'], $ciudad);
        return self::inserta($grupo);
    }

    /*Busca un grupo por el nombre en la TABLA GRUPOS*/
     public static function buscaGrupo($nombreGrupo)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM grupos WHERE nombre = '%s'", $conn->real_escape_string($nombreGrupo));
        $rs = $conn->query($query);
        $grupo = false;
        if ($rs) {
            if ($rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $grupo = new Grupos($fila['nombre'], $fila['direccion'], $fila['creador'], $fila['ciudad']);
                $grupo->setId($fila['idGrupo']);
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupo;
    }




    public static function actualizaGrupo($nombre, $direccion, $ciudad){
        $grupo = self::buscaGrupo($nombre);
        if (!$grupo) {
            return false;
        }
        $grupo = new Grupos($nombre, $direccion, $ciudad);
        return self::actualiza($grupo);
    }

    private static function inserta($grupo){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf(
            "INSERT INTO grupos(nombre, direccion, creador, ciudad) VALUES('%s', '%s', '%s', '%s')",
            $conn->real_escape_string($grupo->nombre),
            $conn->real_escape_string($grupo->direccion),
            $conn->real_escape_string($grupo->creador),
            $conn->real_escape_string($grupo->ciudad)
        );
        if ($conn->query($query)) {
            $grupo->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupo;
    }

    private static function actualiza($grupo){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf(
            "UPDATE grupo G SET nombre = '%s', direccion='%s', ciudad='%s' WHERE G.idGrupo=%i",
            $conn->real_escape_string($grupo->nombre),
            $conn->real_escape_string($grupo->direccion),
            $conn->real_escape_string($grupo->ciudad),
            $grupo->id
        );
        if ($conn->query($query)) {
            if ($conn->affected_rows != 1) {
                echo "No se ha podido actualizar el grupo: " . $grupo->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }

        return $grupo;
    }

    private function __construct($nombre, $direccion, $creador, $ciudad)
    {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->creador = $creador;
        $this->ciudad = $ciudad;
    }

    private $nombre;

    private $direccion;

    private $creador;

    private $ciudad;

    private $id;

    private $idCerveza;

    private $cantidad;


    public function getNombre()
    {
        return $this->nombre;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getCreador()
    {
        return $this->creador;
    }
    public function getCiudad()
    {
        return $this->ciudad;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCerveza()
    {
        return $this->cerveza;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }
}
