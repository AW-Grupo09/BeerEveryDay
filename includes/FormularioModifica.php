<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';
require_once __DIR__.'/Usuario.php';

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
	       <input id="campoEmail" type="email"  name="email" maxlength="50" size="30" value="' . $usuario->email() . '" />
	       <img id="correoNo" src="img/icons/no.png" style="display: none" alt="No"/> 
		   <img id="correoOk" src="img/icons/ok.png" alt="Ok"/>
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

		if(empty($nombre) || empty($apellidos) || empty($fechaNac) || empty($ciudad) || empty($email)){
			$erroresFormulario[] = "No puede quedarse ningun campo vacío";
		}

		if(Usuario::correoExiste($nombreUsuario, $email)){
			$erroresFormulario[] = "Ese correo ya está en uso";
		}

		//comprobar errores
		if (count($erroresFormulario) === 0) {

			$usuario = usuario::buscaUsuario($nombreUsuario);

			if ($usuario != NULL) { // si encuentra el usuario, le actualiza
		    	$usuario = Usuario::actualizaUser($nombreUsuario, $usuario, $nombre, $apellidos, $ciudad, $email, $fechaNac);
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