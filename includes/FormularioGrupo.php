<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/grupos.php';


 class FormularioGrupo extends Form{


    public function generaCamposFormulario($datosIniciales)
    {
    	return '	<fieldset>
					<legend> Formulario nuevo grupo: </legend>

          			<p><label>Nombre de grupo: </label>
          			<input type="text" name="nombreGrupo" required/></p>

		            <p><label>Dirección: </label>
		            <input type="text" name="direccion" required/></p>

		            <p><label>Ciudad de envío: </label>
		            <input type="text" name="ciudad" required/></p>

		            <label> <button class="crearbtn" type="submit">Crear</button></label>
		            ';


	}

   public function procesaFormulario($datos)
    {
    	$erroresFormulario = array();

		$nombreGrupo = isset($_POST['nombreGrupo']) ? $_POST['nombreGrupo'] : null;
		$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
		$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;

		if ( empty($nombreGrupo) || mb_strlen($nombreGrupo) < 5 ) {
			$erroresFormulario[] = "El nombre de grupo tiene que tener una longitud de al menos 5 caracteres.";
		}


		//comprobar errores
		if (count($erroresFormulario) === 0) {
			$grupo = Grupos::creaGrupo($nombreGrupo, $direccion, $ciudad);

			if (! $grupo ) {
		    	$erroresFormulario[] = "El grupo ya existe";
			} else {
				$_SESSION['nombreGrupo'] = $nombreGrupo;
				header('Location: index.php');
				exit();

			}
		}


		 if (count($erroresFormulario) > 0) {//Si hay errores devuelvo un array de errores
            return $erroresFormulario;
         }
         else{
             //Si hay exito
            array_push($datos, $nombreGrupo);
            array_push($datos, $direccion);
            array_push($datos, $ciudad);
            return "index.php";
         }



    }
 }