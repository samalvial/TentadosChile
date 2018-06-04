<?php
	include_once('conexion.php');
	include_once('arraylist.php'); 
	class Usuario
	{
		private $correo;
		private $nombre;
		private $nombredeusuario;
		private $constraseña;
		private $perfil;
		private $imagen;

		public function __construct()
		{

		}

		public function setImagen($imagen)
		{
			$this->imagen = $imagen;
		}

		public function getImagen()
		{
			return $this->imagen;
		}





		public function setCorreo($correo)
		{
			$this->correo = $correo;
		}

		public function getCorreo()
		{
			return $this->correo;
		}

		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}

		public function getNombre()
		{
			return $this->nombre;
		}
		public function setPerfil($perfil)
		{
			$this->perfil = $perfil;
		}

		public function getPerfil()
		{
			return $this->perfil;
		}
		public function setNombredeusuario($nombredeusuario)
		{
			$this->nombredeusuario = $nombredeusuario;
		}

		public function getNombredeusuario()
		{
			return $this->nombredeusuario;
		}

		public function setContrasena($contrasena)
		{
			$this->contrasena = $contrasena;
		}

		public function getContrasena()
		{
			return $this->contrasena; 
		}

		public function creaUsuario()
		{
			$this->conexion = Conexion::getInstance();
			$this->conexion->openConnection();
			$var = $this->conexion->useConnection();
			$consulta = "INSERT INTO usuarios (correo, contrasena, nombredeusuario, nombre, perfil, imagen) VALUES".
			"('".$this->correo."','".$this->contrasena."','".$this->nombredeusuario."','".$this->nombre."','".$this->perfil."','".$this->imagen."')";
			if($var->query($consulta))
			{
				$this->conexion->closeConnection();
				return true;
			}
			else
			{
				$this->conexion->closeConnection();
				return false;
			}
		}

		public function modificaUsuario()
		{
			$this->conexion = Conexion::getInstance();
			$this->conexion->openConnection();
			$var = $this->conexion->useConnection();
			$consulta = "UPDATE usuarios SET contrasena='".$this->contrasena."', nombredeusuario='".
			$this->nombredeusuario."', nombre='".$this->nombre."'WHERE correo='".$this->correo."'";
			if($var->query($consulta))
			{
				$this->conexion->closeConnection();
				return true;
			}
			else
			{
				$this->conexion->closeConnection();
				return false;
			}
		}

		public function eliminaUsuario()
		{
			$this->conexion = Conexion::getInstance();
			$this->conexion->openConnection();
			$var = $this->conexion->useConnection();
			$consulta = "DELETE FROM usuarios WHERE correo='".$this->correo."'";
			if($var->query($consulta))
			{
				$this->conexion->closeConnection();
				return true;
			}
			else
			{
				$this->conexion->closeConnection();
				return false;
			}
		}

		public function buscaUnUsuario()
		{
			$this->conexion = Conexion::getInstance();
			$this->conexion->openConnection();
			$var = $this->conexion->useConnection();
			$consulta = "SELECT * FROM usuarios WHERE correo='".$this->correo."' AND contrasena='".$this->contrasena."'";
			$usuario = new Usuario();

			if($resultado = $var->query($consulta))
			{
				if(mysqli_num_rows($resultado)>0)
				{
					while ($fila = $resultado->fetch_array()) 
					{
						$usuario->setCorreo($fila["correo"]);
						$usuario->setContrasena($fila["contrasena"]);
						$usuario->setNombredeusuario($fila["nombredeusuario"]);
						$usuario->setNombre($fila["nombre"]);
						$usuario->setPerfil($fila["perfil"]);
					}
					$this->conexion->closeConnection();
					return $usuario;
				}
			}
		}

		public function buscaTodos()
		{
			$this->conexion = Conexion::getInstance();
			$this->conexion->openConnection();
			$var = $this->conexion->useConnection();
			$consulta = "SELECT * FROM usuarios";
			$lista  = new Arraylist();

			if($resultado = $var->query($consulta))
			{
				if(mysql_num_rows($resultado)>0)
				{
					while($fila = $resultado->fetch_array())
					{
						$usuario = new Usuario();
						$usuario->setCorreo($fila["correo"]);
						$usuario->setConstraseña($fila["contrasena"]);
						$usuario->setNombredeusuario($fila["nombredeusuario"]);
						$usario->setNombre($fila["nombre"]);
						$lista->add($usuario); 
					}
				}
			}
			$this->conexion->closeConnection(); 
			return $lista; 
		}
	}
?>