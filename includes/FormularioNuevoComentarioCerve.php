<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Controller/controllerComentarios.php';
require_once __DIR__.'/TO/TOComentarios.php';

 class FormularioNuevoComentarioCerve extends Form{

 	public function generaCamposFormulario($datosIniciales){
        $this->action = htmlentities($_SERVER['PHP_SELF']). "?id=". $this->opciones['idCerveza'];
       return '	
            <fieldset>
				<legend> Formulario para añadir comentarios: </legend>

    				<label for="comentario">Nombre de cerveza: </label>
    			    <input type="text" placeholder="Introduce aqui el comentario" name="comentario" required>

                    <label for="val">Valoración: </label>
                    <input type="radio" name="val" value="1" checked> 1
                    <input type="radio" name="val" value="2"> 2
                    <input type="radio" name="val" value="3"> 3  
                    <input type="radio" name="val" value="4"> 4 
                    <input type="radio" name="val" value="5"> 5 

                    <input type="hidden" name="idCerveza" value="'.$this->opciones['idCerveza'].'">

    				<p><button type="submit">Añadir valoración</button></p>

		    </fieldset>';
 	} 

 	public function procesaFormulario($datos){ 

        $erroresFormulario = array();

        $idUsuario = isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario'] : null;
        if ( empty($idUsuario) ) {
            $erroresFormulario[] = "No se ha podido acceder al id del usuario";
        }
        
        $idCerveza = isset($_POST['idCerveza']) ? $_POST['idCerveza'] : null;
        if ( empty($idCerveza) ) {
            $erroresFormulario[] = "No se ha podido acceder al id de la cerveza";
        }

        $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;
        if ( empty($comentario) ) {
            $erroresFormulario[] = "Tienes que escribir un comentario";
        }

        $val = isset($_POST['val']) ? $_POST['val'] : null;
        if ( empty($val) ) {
            $erroresFormulario[] = "Tiene que haber alguna valoración";
        }

        if (count($erroresFormulario) === 0) {
            $Existe = controllerComentarios::existeVal($idCerveza, $idUsuario);

            if ($Existe) {
                $erroresFormulario[] = "Ya has valorado esa cerveza";
            } else {               
                
                controllerComentarios::insertarValoracion($val, $comentario, $idCerveza, $idUsuario);
                controllerComentarios::updateValoracionMedia($idCerveza);

                //header('Location: mostrarCerveza.php?id='.$idCerveza);
                exit();

            }
        }


         if (count($erroresFormulario) > 0) { //Si hay errores devuelvo un array de errores 
            return $erroresFormulario;
         }
         else{

            // return "mostrarCerveza.php?id=".$idCerveza;
         }
        
    }

}
?>