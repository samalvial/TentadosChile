<?php
	include_once('usuario.php');
	$correo = $_POST["correoelectrónico"];
	$contrasena = $_POST["Contraseña"];

	$usuario = new usuario();
	$usuario->setCorreo($correo);
	$usuario->setContrasena($contrasena);
	$user2 = $usuario->buscaUnUsuario();

	setcookie("SessionIniciada",base64_encode(serialize($user2)), time()+(60*60*24));
	
	if($user2 != null)
	{
		if ($user2->getCorreo()==($correo) && $user2->getContrasena()==($contrasena))
		{
			if($user2->getPerfil()==0){
				session_start();
				$_SESSION["logiado"] = $user2; 
				header("location: ../PerfilUsuarios.php");
			}
			if($user2->getPerfil()==1){
				session_start();
				$_SESSION["logiado"] = $user2; 
				header("location: ../paginaDeAdminsitrador.php");
			}
		}
		else
		{
			echo "El correo o la contraseña no coinciden";
		}
	}
	else
	{
		echo "Otro error";
	}
?>