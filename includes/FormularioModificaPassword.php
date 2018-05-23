<?php

require_once __DIR__.'/Form.php';
require_once __DIR__.'/TO/TOUsuarios.php';
require_once __DIR__.'/Controller/controllerUsuario.php';

class FormularioModificaPassword extends Form {

 	public function generaCamposFormulario($datosIniciales){
       return 
       '
       <div class="modificaView">
       <fieldset>
       <legend> Modifica tu contraseña </legend>
	       <input type="password" name="password" maxlength="50" size="30" placeholder="Escribe tu nueva contraseña" required/>
	       <label>Repite la contraseña nueva: </label>
	       <input type="password" name="repass" maxlength="50" size="30" placeholder="Escribe otra vez tu nueva contraseña" required/>
	       <label> <button class="submit" type="submit">Guardar cambios</button></label>
       </fieldset>
       </div>';
 	}

   public function procesaFormulario($datos)
    {
    	$erroresFormulario = array();

    	$nombreUsuario = $_SESSION['nombreUsuario'];

  		$password = isset($_POST['password']) ? $_POST['password'] : null;
		if(!empty($password) && mb_strlen($password) < 5 ) {
			$erroresFormulario[] = "La contraseña tiene que tener una longitud de al menos 5 caracteres.";
		}
		$password2 = isset($_POST['repass']) ? $_POST['repass'] : null;
		if ((!empty($password2) || !empty($password)) && (strcmp($password, $password2) !== 0) ) {
			$erroresFormulario[] = "Las contraseñas deben coincidir";
		}
		
		//comprobar errores
		if (count($erroresFormulario) === 0) {

			$usuario = controllerUsuario::buscaUsuario($nombreUsuario);

			if ($usuario != NULL) { // si encuentra el usuario, le actualiza
		    	$usuario = controllerUsuario::actualizaUserPassword($nombreUsuario, $usuario, $password);
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