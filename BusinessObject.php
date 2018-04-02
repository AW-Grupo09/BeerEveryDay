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

/*$datos = $dao->selectUsuarios();

echo "los datos son "."<br>";
foreach ($datos as $i => $value){
	echo $datos[$i]->getIdUsuario()." ". $datos[$i]->getNombre()." ". $datos[$i]->getApellido()." <br>";
}

$datos2 = $dao->selectUsuariosById('jeyS');
echo "los datos son "."<br>";
echo $datos2->getIdUsuario()."<br>";
echo $datos2->getNombre()." " .$datos2->getApellido()."<br>";*/

$usuario = new TUsuario();
$usuario->setIdUsuario("dars");
$usuario->setNombre("dario");
$usuario->setApellido("gallegos");
$usuario->setCuidad("Madrid");
$usuario->setPassword("ff");
$usuario->setEmail("dariogal@ucm.es");
$usuario->setFechaNac(1996-10-30);
$usuario->setTarjeta("111111");
$usuario->setAvatar("ff");
$usuario->setRol("registrado");
echo " Antes de la consulta <br>";
echo $dao->insertUsuario($usuario);

?>