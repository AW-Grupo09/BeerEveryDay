<?php
require_once __DIR__ . '/Aplicacion.php';

Class Grupos{



    public static function buscaGrupo($nombreGrupo){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM grupos WHERE nombre = '$nombreGrupo'", $conn->real_escape_string($nombreGrupo));
        $rs = $conn->query($query);   
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $grupo = new Grupos($fila['id'],$fila['nombre'], $fila['direccion'], $fila['cuidad']);
                $result = $grupo;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }
    
    public static function creaGrupo($nombre, $direccion,$ciudad){
        $grupo = self::buscaGrupo($nombre);
        if ($grupo) {
            return false;
        }
        $grupo = new Grupos($nombre,$direccion,$ciudad);
        return self::inserta($grupo);
    }

    public static function insetaGrupoUsuarios($idUsuario,$idGrupo,$admin){
    	$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO 'grupos-usuarios' VALUES('%s', '%s', '%s')"
            , $conn->real_escape_string($idGrupo)
            , $conn->real_escape_string($idUsuario)
            , $conn->real_escape_string($admin)
            );

        if ( $conn->query($query) ) {
            $grupoUsuario = $conn->insert_id;
        } else {

            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $grupoUsuario;

    }

    public static function actualizaGrupo($nombre,$direccion,$cuidad){
        $grupo = self::buscaGrupo($nombre);
        if (!$grupo) {
            return false;
        }
        $grupo = new Grupos($nombre,$direccion,$ciudad);
        return self::actualiza($grupo);
    }

    private static function inserta($grupo){

        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO grupos(nombre, direccion, ciudad) VALUES('%s', '%s', '%s')"
            , $conn->real_escape_string($grupo->nombre)
            , $conn->real_escape_string($grupo->direccion)
            , $conn->real_escape_string($grupo->ciudad)
            );
        if ( $conn->query($query) ) {
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
        $query=sprintf("UPDATE grupo G SET nombre = '%s', direccion='%s', ciudad='%s' WHERE G.id=%i"
            , $conn->real_escape_string($grupo->nombre)
            , $conn->real_escape_string($grupo->direccion)
            , $conn->real_escape_string($grupo->ciudad)
            , $grupo->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el grupo: " . $grupo->id;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $grupo;
    }


	private function __construct($nombre, $direccion, $cuidad){

        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->ciudad = $ciudad;
    }

    private $nombre;

    private $direccion;

    private $cuidad;

    private $id;


    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getCuidad(){
        return $this->cuidad;
    }
    public function getId(){
        return $this->id;
    }

}
?>