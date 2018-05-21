<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';
require_once __DIR__.'/grupos.php';
require_once __DIR__.'/comentarios.php';

 class FormularioNuevoComentarioGrupo extends Form{

 	  public function generaCamposFormulario($datosIniciales){
       return ' 
            <fieldset>
                <legend> Formulario para añadir comentarios: </legend>

                    <label for="comentario">Nombre de cerveza: </label>
                    <input type="text" placeholder="Introduce aqui el comentario" name="comentario" required>

                    <input type="hidden" name="idGrupo" value="'.$opciones['idGrupo'].'">

                    <p><button type="submit">Añadir comentario</button></p>

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
         
            comentarios::addCommentGroup($idGrupo, $comentario, $idUsuario);
            header('Location: mostrarGrupo.php?id='.$idGrupo);
            exit();

            }
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
            return 'mostrarGrupo.php?id='.$idGrupo;
         }
        
    
    }

}

?>