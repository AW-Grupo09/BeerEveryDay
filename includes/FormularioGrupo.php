<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/grupos.php';
require_once __DIR__.'/Controller/controllerCervezas.php';
require_once __DIR__.'/Controller/controllerPedidos.php';


 class FormularioGrupo extends Form{


    public function generaCamposFormulario($datosIniciales)
    {
        $select = "";
        $cervezas = controllerCervezas::getCervezas("", "");


        foreach ($cervezas as $cerveza) {
            $select .= "<option value='". $cerveza->getIdCerveza() ."'>" . $cerveza->getNombre() . "</option>";
        }


    	return '	<fieldset>
					<legend> Formulario nuevo grupo: </legend>

          			<label>Nombre de grupo: </label>
          			<input type="text" name="nombreGrupo" required/>

		            <label>Dirección: </label>
		            <input type="text" name="direccion" required/>

		            <label>Ciudad de envío: </label>
		            <input type="text" name="ciudad" required/>

		            <label>Cerveza: </label>
		            <select name="cerveza" required/>
                    ' . $select . '
                    </select><br>
                    
                    <label>Unidades: </label>
		            <input type="number" name="unidades" min="50" required/>

                    <label>Tus unidades: </label>
                    <input type="number" name="tusUnidades" min="10" required/>

		            <label> <button class="crearbtn" type="submit">Crear</button></label>
		            ';
	}

   public function procesaFormulario($datos){
    	$erroresFormulario = array();

		$nombreGrupo = isset($_POST['nombreGrupo']) ? $_POST['nombreGrupo'] : null;
		$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
		$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
        $idCerveza = isset($_POST['cerveza']) ? $_POST['cerveza'] : null;
        $unidades = isset($_POST['unidades']) ? $_POST['unidades'] : null;
        $tusUnidades = isset($_POST['tusUnidades']) ? $_POST['tusUnidades'] : null;

		if ( empty($nombreGrupo) || mb_strlen($nombreGrupo) < 5 ) {
        	$erroresFormulario[] = "El nombre de grupo tiene que tener una longitud de al menos 5 caracteres.";
		}

        if($tusUnidades > $unidades){
            $erroresFormulario[] = "No puedes seleccionar un numero mayores de cervezas que las unidades del pedido.";
        }

		//comprobar errores
		if (count($erroresFormulario) === 0) {
			$grupo = Grupos::creaGrupo($nombreGrupo, $direccion, $ciudad);

			if (!$grupo ) {
		    	$erroresFormulario[] = "El grupo ya existe";
			} else {

                Grupos::insertaGrupoUsuarios($_SESSION['nombreUsuario'], $grupo->getId(),$tusUnidades);

                Grupos::insertaGrupoPedidos();
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
            array_push($datos, $idCerveza);
            array_push($datos, $unidades);
            array_push($datos, $tusUnidades);
            return "index.php";
        }
    }
 }