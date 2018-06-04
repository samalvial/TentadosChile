<?php
	include_once("usuario.php");
	include_once("../registrar.php");

	$correo = $_POST["correoelectrónico"];
	$contrasena = $_POST["Contraseña"];
	$nombredeusuario = $_POST["Nombredeusuario"];
	$nombre = $_POST["Nombrecompleto"];
	$perfil = false;
	$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

	$usuario = new Usuario();
	$usuario->setCorreo($correo);
	$usuario->setContrasena($contrasena);
	$usuario->setNombredeusuario($nombredeusuario);
	$usuario->setNombre($nombre);
	$usuario->setPerfil($perfil);
	$usuario->setImagen($imagen);
	$usuario->creaUsuario(); 

	session_start();
	$_SESSION["user"] = $usuario;

	header("Location: ../registrar.php");
?>