<?php
require_once __DIR__.'/Form.php';

class FormModifica extends Form {

 	public function generaCamposFormulario($datosIniciales){
       return 
       '
       <label>Nombre de usuario: </label>
       <input type="text" name="valor" maxlength="50" size="30" required/>';
 	}

 	public function procesaFormulario($datos){

   }

}

?>