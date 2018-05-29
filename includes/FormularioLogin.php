<?php
require_once __DIR__.'/Form.php';

 class FormularioLogin extends Form{

 	public function generaCamposFormulario($datosIniciales){
       return '	
            <fieldset>
				<legend> Formulario de inicio de sesión: </legend>

    				<div class="imgcontainer">
    			   		<img src="img/users/default.png" alt="Avatar" class="avatar">
    			    </div>
    				
    				<label for="nombreUsuario">Nombre de usuario: </label>
    			    <input type="text" placeholder="Introduzca aquí el nombre de usuario" name="nombreUsuario" required>

    				<label for="password">Contraseña: </label>
    			    <input type="password" placeholder="Introduzca aquí la contraseña" name="password" required>

    				<p><button type="submit">Entrar</button></p>
                    <p id="reg"> ¿Cómo? ¿Que aún no eres miembro? Regístrate <a href="registrate.php"> aquí </a></p>

		    </fieldset>';
 	}

 	public function procesaFormulario($datos){

        $erroresFormulario = array();

        $nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;

        if ( empty($nombreUsuario) ) {
            $erroresFormulario[] = "El nombre de usuario no puede estar vacío";
        }

        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if (empty($password) ) {
            $erroresFormulario[] = "La contraseña no puede estar vacía.";
        }

        if (count($erroresFormulario) === 0) {
            $usuario = controllerUsuario::buscaUsuario($nombreUsuario);

            if (!$usuario) {
                $erroresFormulario[] = "El usuario o la contraseña no coinciden";
            } else {               
                if($usuario->compruebaPassword($password)) {
                    $_SESSION['login'] = true;
                    $_SESSION['nombreUsuario'] = $nombreUsuario;
                    $_SESSION['esAdmin'] = controllerUsuario::esAdmin($nombreUsuario) == 1 ? true : false;
                    header('Location: index.php');
                    exit();
                } else {
                    $erroresFormulario[] = "El usuario o la contraseña no coinciden";
                }
            }
        }


         if (count($erroresFormulario) > 0) { //Si hay errores devuelvo un array de errores 
            return $erroresFormulario;
         }
         else{
             //Si hay exito
            array_push($datos, $nombreUsuario);
            array_push($datos, $password);
            return "index.php";
         }
        
    }

}

?>