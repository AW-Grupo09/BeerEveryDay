<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/grupos.php';


 class FormularioGrupo extends Form{


    public function generaCamposFormulario($datosIniciales)
    {
    	return '	<fieldset>
					<legend> Formulario de registro: </legend>

          			<label>Nombre de grupo: </label>
          			<input type="text" name="nombreGrupo" required/>
	          			
		            <label>Dirreccion: </label>
		            <input type="text" name="direccion" required/>
		            
		            <label>Cuidad: </label>
		            <input type="text" name="cuidad" value="" required/>

		            <label> <button class="submit" type="submit">guardar</button></label>
		            <div>
					   		<input type="button" value="Atrás" class="atrasbtn" onclick = "location="./index.php""/>
					</div>
			           </fieldset>';


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
            array_push($datos, $cuidad);
            return "index.php";
         }

       

    }
 }