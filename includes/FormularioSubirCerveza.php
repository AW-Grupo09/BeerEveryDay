<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/funcionImagen.php';
require_once __DIR__.'/Controller/controllerCervezas.php';

 class FormularioSubirCerveza extends Form{

 	public function generaCamposFormulario($datosIniciales){
       return '	
            <fieldset>
				<legend> Formulario de subir cerveza: </legend>

    				<label for="nombreCerveza">Nombre de cerveza: </label>
    			    <input type="text" placeholder="Introduzca aquí el nombre de la cerveza" name="nombreCerveza" required>

                    <label for="Artesana">Es artesana: 
                    <input type="checkbox" name="Artesana" checked></label>

    				<label for="capacidad">Capacidad en centilitros: </label>
    			    <input type="text" placeholder="Introduzca aquí la capacidad de la cerveza" name="capacidad" required>

                    <label for="color">Color: </label>

                    <div id="radios">
                        <input type="radio" name="Color" value="rubia" checked> Rubia
                        <input type="radio" name="Color" value="negra"> Negra
                        <input type="radio" name="Color" value="tostada"> Tostada  
                        <input type="radio" name="Color" value="blanca"> Blanca 
                        <input type="radio" name="Color" value="ambar"> Ambar 
                    </div>

                    <label for="fabricante">Fabricante: </label>
                    <input type="text" placeholder="Introduzca aquí el fabricante de la cerveza" name="Fabricante" required>

                    <label for="grado">Grado: </label>
                    <input type="text" placeholder="Introduzca aquí el grado de la cerveza" name="Grado" required>

                    <label for="grano">Grano: </label>
                        <div id="radios">
                        <input type="radio" name="Grano" value="cebada" checked> Cebada 
                        <input type="radio" name="Grano" value="trigo"> Trigo 
                        <input type="radio" name="Grano" value="avena"> Avena 
                    </div>

                    <label for="precio">Precio: </label>
                    <input type="text" placeholder="Introduzca aquí el precio de la cerveza" name="precio" required>

                    <label for="pais">País: </label>
                    <input type="text" placeholder="Introduzca aquí el país de la cerveza" name="pais" required>

                    <label for="Tipo">Tipo: </label>
                    <div id="radios">
                        <input type="radio" name="Tipo" value="lager" checked> Lager 
                        <input type="radio" name="Tipo" value="ale"> Ale 
                        <input type="radio" name="Tipo" value="pilsner"> Pilsner 
                    </div>

                    <label class="foto_per_label">Foto: </label>
                    <label> <p> <input type="file" name="archivo" /> </p></label>       

    				<p><button type="submit">Subir cerveza</button></p>

		    </fieldset>';
 	} 

 	public function procesaFormulario($datos){ 

        $erroresFormulario = array();

        //Preparacion de la imagen
        $imgCerveza = $_FILES['archivo']['name'];
        $ruta = "img/imagenCervezas/"; //ruta carpeta donde queremos copiar las imágenes 
        $imageFileType = $ruta . strtolower(basename($imgCerveza));

        $Artesana = isset($_POST['Artesana']) ? 1 : 0;
        
        $nombreCerveza = isset($_POST['nombreCerveza']) ? $_POST['nombreCerveza'] : null;
        if ( empty($nombreCerveza) ) {
            $erroresFormulario[] = "El nombre de la cerveza no puede estar vacío";
        }

        $capacidad = isset($_POST['capacidad']) ? $_POST['capacidad'] : null;
        if ( empty($capacidad) ) {
            $erroresFormulario[] = "La capacidad no puede estar vacío";
        }
        $Color = isset($_POST['Color']) ? $_POST['Color'] : null;
        if ( empty($Color) ) {
            $erroresFormulario[] = "El color no puede estar vacío";
        }
        else if($Color != "rubia" && $Color != "negra" && $Color != "roja" && $Color != "tostada" && $Color != "blanca" && $Color != "ambar")
            $erroresFormulario[] = "El color no es válido";
        
        $Fabricante = isset($_POST['Fabricante']) ? $_POST['Fabricante'] : null;
        if ( empty($Fabricante) ) {
            $erroresFormulario[] = "El fabricante no puede estar vacío";
        }

        $Grado = isset($_POST['Grado']) ? $_POST['Grado'] : null;
        if ( empty($Grado) ) {
            $erroresFormulario[] = "El grado no puede estar vacío";
        }

        $grano = isset($_POST['Grano']) ? $_POST['Grano'] : null;
        if ( empty($grano) ) {
            $erroresFormulario[] = "El grano no puede estar vacío";
        }
        else if($grano != "trigo" && $grano != "cebada" && $grano != "avena")
            $erroresFormulario[] = "El grano no tiene un valor válido";

        $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
        if ( empty($precio) ) {
            $erroresFormulario[] = "El precio no puede estar vacío";
        }

        $pais = isset($_POST['pais']) ? $_POST['pais'] : null;
        if ( empty($pais) ) {
            $erroresFormulario[] = "El pais no puede estar vacío";
        }

        $Tipo = isset($_POST['Tipo']) ? $_POST['Tipo'] : null;
        if ( empty($Tipo) ) {
            $erroresFormulario[] = "El tipo no puede estar vacío";
        }
        else if($Tipo != "lager" && $Tipo != "ale" && $Tipo != "pilsner")
            $erroresFormulario[] = "El tipo no tiene un valor valido";

        // comprueba que la imagen es válida
        if($imgCerveza != NULL && !funcionImagen::esImagen($imgCerveza)){
            $erroresFormulario[] = "Debe ser un archivo válido";
        }

        if (count($erroresFormulario) === 0) {
            $Existe = controllerCervezas::existeCerveza($nombreCerveza);

            if ($Existe) {
                $erroresFormulario[] = "Esa cerveza ya existe";
            } else {                         
                controllerCervezas::addBeer($imageFileType,  $Artesana, $nombreCerveza, $capacidad, $Color, $Fabricante, $Grado, $grano, $precio, $pais, $Tipo);
                move_uploaded_file($_FILES['archivo']['tmp_name'], $imageFileType);
                header('Location: index.php');
                exit();
            }
        }


         if (count($erroresFormulario) > 0) { //Si hay errores devuelvo un array de errores 
            return $erroresFormulario;
         }
         else{
            /*
             //Si hay exito
            array_push($datos, $nombreUsuario);
            array_push($datos, $password);
            */
            return "index.php";
         }
        
    }

}
                    //<input type="text" placeholder="Introduzca aquí el tipo de la cerveza" name="Tipo" required>
                  //  <input type="text" placeholder="Introduzca aquí el grano de la cerveza" name="Grano" required>
                  //  <input type="text" placeholder="Introduzca aquí el color de la cerveza" name="Color" required>
?>