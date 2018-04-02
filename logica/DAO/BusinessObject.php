<?php 
/**
 * Business Oject
 * */
include("logica/UsuarioDAO.php");
/**
 * Se crea la instancia del Objeto.
 * */
$dao = new UsuarioDAO();
/**
 * Traer todos lo registros de la tabla Usuario.
 * */
$dao->selectUsuarios();
/**
 * Crear un Objeto de tipo Usuario.
 * */
$usuario = new Usuario();
$usuario->setIdusuario(1);
$usuario->setNombre("Daniel");
$usuario->setApellidoPaterno("Brena");
$usuario->setApellidoMaterno("Aquino");
$usuario->setNacionalidad("Mexicana");
$usuario->setSexo("Hombre");
$usuario->setCorreo("daniel_brena@outlook.com");
$usuario->setClave("daniel12345");
/**
 * Inserta usuario en la Base de Datos.
 * */
echo $dao->insertUsuario($usuario);
/**
 * Actualiza el usuario en la Base de Datos.
 * */
echo $dao->updateUsuario($usuario);
/**
 * Buscar un usuario dentro de la Base de Datos.
 * con el correo y la clave.
 * */
$dao->searchUsuario("daniel_brena@outlook.com","827ccb0eea8a706c4c34a16891f84e7b");
/**
 * Elimina el usuario por medio del id.
 * */
echo $dao->deleteUsuario(1);
?>