<?php 
/**
 * Business Oject
 * */
include("logica/DAOUsuario.php");
/**
 * Se crea la instancia del Objeto.
 * */
$dao = new DAOUsuario();
/**
 * Traer todos lo registros de la tabla TUsuario. Por ejemplo vamsos a extrear el primer TUsuaroio
 * que será datos[0]. Al amacenar un TUsuario, podremos usar las funciones get de TUsuario para extraer
 * los campos de nombre ,apellido, id , etc...
 * */

$datos = $dao->selectUsuarios();

echo "los datos son "."<br>";
foreach ($datos as $i => $value){
	echo $datos[$i]->getIdUsuario()." ". $datos[$i]->getNombre()." ". $datos[$i]->getApellido()." <br>";
}

?>