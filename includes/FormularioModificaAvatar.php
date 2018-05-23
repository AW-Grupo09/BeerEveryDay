<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';

class FormularioModificaAvatar extends Form {

 	public function generaCamposFormulario($datosIniciales){
 		$usuario = controllerUsuario::buscaUsuario($_SESSION['nombreUsuario']);
       return 
       '
       <div class="modificaView">
       <fieldset>
       <legend> Modifica tu foto de perfil </legend>
		   <label> <p> <input type="file" name="archivo" value=" ' . $usuario->getAvatar() . '"/> </p></label>	   
	       <label> <button id="guardaCambios" class="submit" type="submit">Guardar cambios</button></label>
       </fieldset>
       </div>';
 	}

   public function procesaFormulario($datos)
    {
    	$erroresFormulario = array();

    	$nombreUsuario = $_SESSION['nombreUsuario'];

		$avatar = $_FILES['archivo']['name'];

		//Imagen
		$ruta = "img/users/";//ruta carpeta donde queremos copiar las imágenes 
	    $imageFileType = $ruta . basename($avatar);
		
		// comprueba que HAYA IMAGEN y que es válida
		if($avatar != NULL && !funcionImagen::esImagen($avatar)){
			$erroresFormulario[] = "Debe ser un archivo válido";
		}
		//comprobar errores
		if (count($erroresFormulario) === 0) {

			$usuario = controllerUsuario::buscaUsuario($nombreUsuario);

			if ($usuario != NULL) { // si encuentra el usuario, le actualiza
		    	controllerUsuario::actualizaUserAvatar($nombreUsuario, $usuario, $imageFileType);
		    	move_uploaded_file($_FILES['archivo']['tmp_name'], $imageFileType);
				header('Location: perfil.php');
				exit();
			} else {
				
			}
		}


		 if (count($erroresFormulario) > 0) { //Si hay errores devuelvo un array de errores 
            return $erroresFormulario;
         }
         else{
             //Si hay exito
            array_push($datos, $nombreUsuario);
            array_push($datos, $password);
            return 'perfil.php';
         }

      
    }
 

}

?>