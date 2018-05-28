<?php

include_once('DAO.php');

class DAOGrupos extends DAO {
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS-PEDIDOS -------------------------------------------------------*/

    public function insertaGrupoPedidos($idGrupo,$idPedido){

        $query = sprintf(
            "INSERT INTO `grupo-pedidos` VALUES('%s', '%s')",
            $this->mysqli->real_escape_string($idGrupo),
            $this->mysqli->real_escape_string($idPedido)
        );

        $grupoPedido = $this->ejecutarModificacion($query);
        if ($grupoPedido != 0) {
            return $grupoPedido;
        } else {
            //echo "error en la funcion Grupo-Pedidos da error";
            echo "Error al insertar en la BD: (" . $this->mysqli->errno . ") " . utf8_encode($this->mysqli->error);
            exit();
        }
        return NULL;

    } 

   
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS-USUARIOS -------------------------------------------------------*/

    /*Funcion que me devuelve todos los grupos a los que pertece un usuario, ya sea porque lo ha creado o porque se ha unido a el */
    public function getGruposByUser($usuario){
        $grupos = array();
        $query = sprintf("SELECT idGrupo FROM `grupos-usuarios` WHERE idUsuario = '%s'", $this->mysqli->real_escape_string($usuario));
        $table = $this->ejecutarConsulta($query);

        if ($table) {
            foreach ($table as $fila) {
                $idGrupo = $fila['idGrupo'];
                array_push($grupos, $idGrupo);
            }
        } /*else {
            echo "Error al consultar en la BD: (" . $this->mysqli->errno . ") " . utf8_encode($this->mysqli->error);
            exit();
        }*/
        return $grupos;
    }

    /*Funcion que comprueba si un usuario existe en la tabla GRUPOS-USUARIO , false en caso contrario*/
    public function buscaUsuarioenGrupos($idUsuario, $idGrupo){
        $query = sprintf(
            "SELECT * FROM `grupos-usuarios` WHERE idGrupo = '%s' and idUsuario = '%s'",
            $this->mysqli->real_escape_string($idGrupo),
            $this->mysqli->real_escape_string($idUsuario)
        );
        $rs = $this->ejecutarConsulta($query);
        $existe = false;
        if ($rs) {
            if (count($rs) == 1) {
                $existe = true;
            } else {
                $existe = false;
            }
        }
        return $existe;
    }

    /*Funcion que inserta un usuario y idGrupo en la tabla GRUPOS-USUARIOS*/
    public function insertaGrupoUsuarios($idUsuario, $idGrupo,$unidades){
        $query = sprintf(
            "INSERT INTO `grupos-usuarios` VALUES('%s', '%s', %s )",
            $this->mysqli->real_escape_string($idGrupo),
            $this->mysqli->real_escape_string($idUsuario),
            $this->mysqli->real_escape_string($unidades)
        );

        $grupoPedido = $this->ejecutarModificacion($query);
        if ($grupoPedido) {
            return $grupoPedido;
        } else {
            echo "Error al insertar en la BD: (" . $this->mysqli->errno . ") " . utf8_encode($this->mysqli->error);
            exit();
        }
        return NULL;
    }
    /*----------------------------------------------FUNCIONES PARA LA TABLA DE GRUPOS -------------------------------------------------------*/

    /*Funcion de devuelve todos los grupos de la tabla grupos*/
    public function getGrupos(){
        $grupos = array();
        $query = sprintf("SELECT * FROM grupos");
        $rs = $this->ejecutarConsulta($query);
        if ($rs) {
            foreach ($rs as $fila) {
                array_push($grupos, $fila['idGrupo']);
            }
        } 
        else if(count($rs)==0){
        }
        else {
            echo "Error al consultar en la BD: (" . $this->mysqli->errno . ") " . utf8_encode($this->mysqli->error);
            exit();
        }
        return $grupos;
    }

    public function getGrupoById($idGrupo){
        $query = sprintf("SELECT * FROM grupos WHERE idGrupo = %s", $this->mysqli->real_escape_string($idGrupo));
        $rs = $this->ejecutarConsulta($query);
        $grupo = NULL;
        if ($rs) {
            if (count($rs) == 1) {
                $fila = $rs[0];
                $grupo = new TOGrupos($fila['nombre'], $fila['direccion'], $fila['creador'], $fila['ciudad']);
                $grupo->setId($fila['idGrupo']);
            }
        } else {
            echo "Error al consultar en la BD: (" . $this->mysqli->errno . ") " . utf8_encode($this->mysqli->error);
            exit();
        }
        return $grupo;
    }

    /*Busca un grupo por el nombre en la TABLA GRUPOS*/
    public function buscaGrupo($nombreGrupo)
    {
        $query = sprintf("SELECT * FROM grupos WHERE nombre = '%s'", $this->mysqli->real_escape_string($nombreGrupo));
        $rs = $this->ejecutarConsulta($query);
        $grupo = NULL;
        if ($rs) {
            if (count($rs) == 1) {
                $fila = $rs[0];
                $grupo = new TOGrupos($fila['nombre'], $fila['direccion'], $fila['creador'], $fila['ciudad']);
                $grupo->setId($fila['idGrupo']);
            }
        }
        return $grupo;
    }

    public function inserta($grupo){
        $query = sprintf(
            "INSERT INTO grupos(nombre, direccion, creador, ciudad) VALUES('%s', '%s', '%s', '%s')",
            $this->mysqli->real_escape_string($grupo->getNombre()),
            $this->mysqli->real_escape_string($grupo->getDireccion()),
            $this->mysqli->real_escape_string($grupo->getCreador()),
            $this->mysqli->real_escape_string($grupo->getCiudad())
        );

        $grupo = $this->ejecutarInsert_Id($query);
        if ($grupo) {
            return $grupo;
        } else {
            echo "Error al insertar en la BD: (" .$this->mysqli->errno . ") " . utf8_encode($this->mysqli->error);
            exit();
        }
        return NULL;
    }

    public function actualiza($grupo){
        $query=sprintf(
            "UPDATE grupo G SET nombre = '%s', direccion='%s', ciudad='%s' WHERE G.idGrupo=%i",
            $this->mysqli->real_escape_string($grupo->getNombre()),
            $this->mysqli->real_escape_string($grupo->getDireccion()),
            $this->mysqli->real_escape_string($grupo->getCiudad())
        );
        $affect = $this->ejecutarModificacion($query);
        if ($affect) {
            if ($affect != 1) {
                echo "No se ha podido actualizar el grupo: " . $grupo->getId();
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $this->mysqli->errno . ") " . utf8_encode($this->mysqli->error);
            exit();
        }

        return $grupo;
    }

    public function salirGrupo($idGrupo,$idUsuario){

        $query = "DELETE FROM `grupos-usuarios` WHERE idUsuario = '$idUsuario' AND idGrupo = $idGrupo";
        $resultado = $this->ejecutarModificacion($query);
        if($resultado == 0){
            return "Error al salir del grupo";
        }
    }
    public function eliminarGrupo($idGrupo,$idUsuario){

        $query = "DELETE FROM grupos WHERE idUsuario = '$idUsuario' AND idGrupo = $idGrupo";
        $resultado = $this->ejecutarModificacion($query);
        if($resultado == 0){
            return "Error al eliminar el grupo";
        }
    }
    public function eliminarPedio($idPedido){
        $query = "DELETE FROM pedidos WHERE idPedido = $idPedido";
        $resultado = $this->ejecutarModificacion($query);
        if($resultado == 0){
            return "Error al eliminar el pedido";
        }
    }
    public function getIdPedidoByGrupo($idGrupo){
        $query = " SELECT idPedido FROM `grupo-pedidos` WHERE idGrupo = $idGrupo";
        $resultado = $this->ejecutarConsulta($query);
        return $resultado[0]['idCerveza'];
    }

    public function eliminarGrupoPedidos($idGrupo){
        $query = "DELETE FROM `grupo-pedidos`  WHERE idGrupo = $idGrupo";
        $resultado = $this->ejecutarModificacion($query);
        if($resultado == 0){
            return "Error al eliminar el grupo-pedido";
        }
    }
}

?>