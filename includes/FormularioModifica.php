<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';

class FormularioModifica extends Form {

 	public function generaCamposFormulario($datosIniciales){
 		$usuario = Usuario::buscaUsuario($_SESSION['nombreUsuario']);
       return 
       '
       <div class="modificaView">
       <fieldset>
       <legend> Modifica los datos de usuario </legend>
	       <p> <label>Nombre: </label> </p>
	       <input type="text" name="nombre" maxlength="50" size="30" value="'. $usuario->nombre() .'" />
	       <label>Apellidos: </label>
	       <input type="text" name="apellidos" maxlength="50" size="30" value="' . $usuario->apellidos() . '" />
	       <label>Email: </label>
	       <input type="email" name="email" maxlength="50" size="30" value="' . $usuario->email() . '" />
	       <label>Ciudad: </label>
	       <input type="text" name="ciudad" maxlength="50" size="30" value="' . $usuario->ciudad() . '" />
	       <label>Fecha de nacimiento: </label>
	       <input type="date" name="fechaNac" maxlength="50" size="30" value="' . $usuario->fechaNac() . '" />
	       <label> <button id="guardaCambios" class="submit" type="submit">Guardar cambios</button></label>
       </fieldset>
       </div>';
 	}

   public function procesaFormulario($datos)
    {
    	$erroresFormulario = array();

    	$nombreUsuario = $_SESSION['nombreUsuario'];

    	$usuario = usuario::buscaUsuario($nombreUsuario);

		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : $usuario->nombre();
		$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
		$fechaNac= isset($_POST['fechaNac']) ? $_POST['fechaNac'] : null;
		$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
		$email = isset($_POST['email']) ? $_POST['email'] : null; 
		//$dirAvatar = isset($_POST['archivo']) ? $_POST['archivo'] : null;
		/*$avatar = $_FILES['archivo']['name'];

		//Imagen
		$ruta = "img/users/";//ruta carpeta donde queremos copiar las imágenes 
	    $imageFileType = $ruta . basename($avatar);
		
		// comprueba que HAYA IMAGEN y que es válida
		if($avatar != NULL && !funcionImagen::esImagen($avatar)){
			$erroresFormulario[] = "Debe ser un archivo válido";
		}*/

		//comprobar errores
		if (count($erroresFormulario) === 0) {

			$usuario = usuario::buscaUsuario($nombreUsuario);

			if ($usuario != NULL) { // si encuentra el usuario, le actualiza
		    	$usuario = Usuario::actualizaUser($nombreUsuario, $usuario, $nombre, $apellidos, $ciudad, $email, $fechaNac);
		    	//$usuario = Usuario::guarda($usuario, $nombreUsuario);
				//move_uploaded_file($_FILES['archivo']['tmp_name'], $imageFileType);
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
            return 'perfil.php';
         }

      
    }
 

}

?>