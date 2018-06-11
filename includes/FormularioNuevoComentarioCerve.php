<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Controller/controllerComentarios.php';
require_once __DIR__.'/TO/TOComentarios.php';

 class FormularioNuevoComentarioCerve extends Form{

 	public function generaCamposFormulario($datosIniciales){

       return '	
            <fieldset>
				<legend> Añadir valoración: </legend>

    			    <input id="comentario" type="text" placeholder="Introduce aqui el comentario" name="comentario" required>
                    
                    <p>Valoración de cerveza: </p>
                    <p class="clasificacion">
                        <input id="radio1" type="radio" name="val" value="5">
                        <label for="radio1" id="radio1">★</label>
                        <input id="radio2" type="radio" name="val" value="4">
                        <label for="radio2" id="radio2">★</label>
                        <input id="radio3" type="radio" name="val" value="3">
                        <label for="radio3" id="radio3">★</label>
                        <input id="radio4" type="radio" name="val" value="2">
                        <label for="radio4" id="radio4">★</label>
                        <input id="radio5" type="radio" name="val" value="1">
                        <label for="radio5" id="radio5">★</label>
                    </p>
                    <input type="hidden" name="idCerveza" value="'.$this->opciones['idCerveza'].'">

    				<p><button id=addVal type="submit">Añadir valoración</button></p>

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

                header('Location: mostrarCerveza.php?id='.$idCerveza);
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