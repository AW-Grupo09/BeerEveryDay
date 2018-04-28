<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';

 class FormularioRegistro extends Form{


    public function generaCamposFormulario($datosIniciales)
    {
    	return '	    <fieldset>
						<legend> Formulario de registro: </legend>

						<div class="imgcontainer">
					   		<img src="img/users/default.png" alt="Avatar" class="avatar">
					    </div>
     			
          				<label>Nombre de usuario: </label>
          				<input type="text" name="nombreUsuario" required/>
	          			
		              <label>Nombre: </label>
		              <input type="text" name="nombre" required autofocus/>
		            
		              <label>Apellidos: </label>
		              <input type="text" name="apellidos" value="" required/>
		            
		              <label>Fecha de nacimiento: </label>
		              <input type="date" name="fechaNac" placeholder="aaaa/mm/dd" required/>
		           
		              <label>Ciudad: </label>
		              <input type="text" name="ciudad" value=""/>
            		
		              <label>E-mail:</label>
		              <input type="email" name="email" placeholder="example123@example.com" required/>
		            
		              <label>Repita email:</label>
		              <input type="email" name="remail" placeholder="Ambos emails deben coindicir" required/>
		            
		              <label>Contraseña: </label>
		              <input type="password" name="password" value="" required/>
		            
		              <label>Repita contraseña: </label>
		              <input type="password" name="repass" placeholder="Ambas contraseñas deben coindicir" value="" required/>
		            
		      		  <label class="foto_per_label">Foto de perfil: </label>
		              <label> <p> <input type="file" name="archivo" id="archivo" class="foto_per"/> </p></label>	      
		            
		              <label> <button class="submit" type="submit">Regístrate</button></label>
		           
		            
		              <label> <p> <button type="reset">Reestablecer</button> </p></label>
		            
		                         
		            	<p>Al hacer clic en "Registrarte", aceptas los
		            	<a href="terminos.php"> términos y condiciones del servicio </a> y confirmas que has leído nuestra
		            	<a href="politicadeprivacidad.php"> Política de privacidad. </a> </p>

		            	<div>
					   		<input type="button" value="Atrás" class="atrasbtn" onclick = "location="./index.php""/>
					    </div>
			           </fieldset>';


	}

   public function procesaFormulario($datos)
    {
    	$erroresFormulario = array();

		$nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
		$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
		$fechaNac= isset($_POST['fechaNac']) ? $_POST['fechaNac'] : null;
		$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
		$email = isset($_POST['email']) ? $_POST['email'] : null; 
		$remail = isset($_POST['remail']) ? $_POST['remail'] : null; 
		//$avatar = isset($datos['archivo']['name']) ? $datos['archivo']['name'] : null;
		//$size = isset($datos['archivo']['size']) ? $datos['archivo']['size'] : null;
		//$avatar = $_FILES['archivo']['name'];
		//$size = $_FILES['archivo']['size'];
		//$directorio = '../img/users/';

		if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 ) {
			$erroresFormulario[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
		}

		$password = isset($_POST['password']) ? $_POST['password'] : null;
		if ( empty($password) || mb_strlen($password) < 5 ) {
			$erroresFormulario[] = "El password tiene que tener una longitud de al menos 5 caracteres.";
		}
		$password2 = isset($_POST['repass']) ? $_POST['repass'] : null;
		if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
			$erroresFormulario[] = "Los passwords deben coincidir";
		}

		if ( empty($remail) || strcmp($email, $remail) !== 0 ) {
			$erroresFormulario[] = "Los emails deben coincidir";
		}

		/*if(!esImagen($avatar)) {
			$erroresFormulario[] = "Esa extensión de imagen no es aceptada";
		}

		if(!imgValida($avatar, $size)){
			$erroresFormulario[] = "Inserta una imagen válida";
		}*/

		if (count($erroresFormulario) === 0) {
			$usuario = Usuario::crea($nombreUsuario, $nombre, $password, 'user', $ciudad, $fechaNac, $email, $apellidos, $avatar);
			
			if (! $usuario ) {
		    	$erroresFormulario[] = "El usuario ya existe";
			} else {
				$_SESSION['login'] = true;
				$_SESSION['nombreUsuario'] = $nombreUsuario;
				//move_uploaded_file($datos['archivo']['tmp_name'], $directorio.$avatar);
				header('Location: index.php');
				exit();

			}
		}


		 if (count($erroresFormulario) > 0) {//Si hay errores devuelvo un array de errores 
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