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
 * Traer todos lo registros de la tabla Usuario.
 * */
$datos = $dao->selectUsuarios();
echo "los datos son "."<br>";
print_r($datos);

?>