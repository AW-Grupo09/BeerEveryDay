<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';

class FormularioModifica extends Form {

 	public function generaCamposFormulario($datosIniciales){
 		$usuario = Usuario::buscaUsuario($_SESSION['nombreUsuario']);
       return 
       '
       <div class="userData">
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
	       	<label>Contraseña: </label>
	       <input type="password" name="password" maxlength="50" size="30" placeholder="Escribe tu nueva contraseña" />
	       <label>Repite la contraseña nueva: </label>
	       <input type="password" name="repass" maxlength="50" size="30" placeholder="Escribe otra vez tu nueva contraseña" />
	       <label>Fecha de nacimiento: </label>
	       <input type="date" name="fechaNac" maxlength="50" size="30" value="' . $usuario->fechaNac() . '" />
	       <label class="foto_per_label">Foto de perfil: </label>
		   <label> <p> <input type="file" name="archivo" value=" ' . $usuario->avatar() . '"/> </p></label>	   
	       <label> <button class="submit" type="submit" onclick="guard()">Guardar cambios</button></label>
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
		$avatar = $_FILES['archivo']['name'];

		//Imagen
		$ruta = "img/users/";//ruta carpeta donde queremos copiar las imágenes 
	    $imageFileType = $ruta . basename($avatar);

  		$password = isset($_POST['password']) ? $_POST['password'] : null;
		if(!empty($password) && mb_strlen($password) < 5 ) {
			$erroresFormulario[] = "El password tiene que tener una longitud de al menos 5 caracteres.";
		}
		$password2 = isset($_POST['repass']) ? $_POST['repass'] : null;
		if ((!empty($password2) || !empty($password)) && (strcmp($password, $password2) !== 0) ) {
			$erroresFormulario[] = "Los passwords deben coincidir";
		}
		
		// comprueba que HAYA IMAGEN y que es válida
		if($avatar != NULL && !funcionImagen::esImagen($avatar)){
			$erroresFormulario[] = "Debe ser un archivo válido";
		}

		//comprobar errores
		if (count($erroresFormulario) === 0) {

			$usuario = usuario::buscaUsuario($nombreUsuario);
			if ($usuario != NULL) { // si encuentra el usuario, le actualiza
		    	$usuario = Usuario::actualizaUser($nombreUsuario, $usuario, $nombre, $password, $apellidos, $ciudad, $email, $imageFileType, $fechaNac);
		    	//$usuario = Usuario::guarda($usuario, $nombreUsuario);
				move_uploaded_file($_FILES['archivo']['tmp_name'], $imageFileType);
				header('Location: perfil.php');
				exit();
			} else {
				
			}
		}


		 if (count($erroresFormulario) > 0) {//Si hay errores devuelvo un array de errores 
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