<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';
require_once __DIR__.'/TO/TOComentarios.php';
require_once __DIR__.'/Controller/controllerComentarios.php';

 class FormularioNuevoComentarioGrupo extends Form{

 	public function generaCamposFormulario($datosIniciales){
       return ' 
            <fieldset>
                <legend> Añade aquí tu comentario </legend>
                    <input id="comentario" type="text" placeholder = "Introduce aqui el comentario " name="comentario" required>
                    <input type="hidden" name="idGrupo" value="'.$this->opciones['idGrupo'].'">
                    <p><button id=addVal type="submit">Añadir comentario</button></p>

            </fieldset>';
    } 

    public function procesaFormulario($datos){ 

        $erroresFormulario = array();

        $idUsuario = isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario'] : null;
        if ( empty($idUsuario) ) {
            $erroresFormulario[] = "No se ha podido acceder al id del usuario";
        }
        
        $idGrupo = isset($_POST['idGrupo']) ? $_POST['idGrupo'] : null;
        if ( empty($idGrupo) ) {
            $erroresFormulario[] = "No se ha podido acceder al id del grupo";
        }

        $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;
        if ( empty($comentario) ) {
            $erroresFormulario[] = "Tienes que escribir un comentario";
        }

        if (count($erroresFormulario) === 0) {

            controllerComentarios::insertarComentarioGrupo($comentario, $idGrupo, $idUsuario);
            //echo "<script type='text/javascript'> window.location.replace(BeerEveryDay/vistaGrupo.php?idGrupo=.".$idGrupo."); </script>";
            header('Location: vistaGrupo.php?idGrupo='.$idGrupo);

            
        }


         if (count($erroresFormulario) > 0) { //Si hay errores devuelvo un array de errores 
            return $erroresFormulario;
         }
         else{
            /*
             //Si hay exito
            array_push($datos, $nombreUsuario);
            array_push($datos, $password);
            */
            return 'vistaGrupo.php?idGrupo='.$idGrupo;
         }
        
    
    }

}

?>