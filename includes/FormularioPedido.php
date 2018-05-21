<?php

require_once __DIR__.'/Form.php';

 class FormularioPedido extends Form{

 	public function generaCamposFormulario($datosIniciales){
       return '	
        <fieldset>
				<legend> Formulario de procesar pedido: </legend>

    				<label for="Dir">Dirección de entrega: </label>
    			    <input type="text" size="30" placeholder="Introduzca aquí la dirección dónde quiera que se produzca la entrega" name="Dir" required>

    				<label for="Tarjeta">Tarjeta: </label>
    			    <input type="number_format" placeholder="Introduzca aquí su tarjeta para pagar la compra" name="Tarjeta" required>

    				<p><button class="submit" type="submit">Comprar</button></p>

		    </fieldset>';
 	}

 	public function procesaFormulario($datos){

        $erroresFormulario = array();

        $Dir = isset($_POST['Dir']) ? $_POST['Dir'] : null;

        if ( empty($Dir) ) {
            $erroresFormulario[] = "<p>Ha de introducirse una dirección</p>";
        }

        $Tarjeta = isset($_POST['Tarjeta']) ? $_POST['Tarjeta'] : null;
        if (empty($Tarjeta) ) {
            $erroresFormulario[] = "<p>No se ha introducido un método de pago</p>";
        }

        if (count($erroresFormulario) === 0) {
            $ret = controllerPedidos::procesarCesta($Dir, $Tarjeta, $_SESSION["nombreUsuario"]);
            if($ret !== NULL)
              $erroresFormulario[] = $ret;
        }


         if (count($erroresFormulario) > 0) { //Si hay errores devuelvo un array de errores 
            return $erroresFormulario;
         }
         else{
             //Si hay exito
            array_push($datos, $Dir);
            array_push($datos, $Tarjeta);
            return "index.php";
         }
        
    }

}




  ?>