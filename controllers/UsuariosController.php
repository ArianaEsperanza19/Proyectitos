<?php
class UsuariosController
{

	public function registrar()
	{
		//El presente metodo envia a la pagina para registrar nuevos usuarios.
		require_once 'views/usuarios/registrar.phtml';
	}

	public function guardarNuevo()
	{
		//El presente metodo realiza la logica para recibir, limpiar y guardar 
		//los datos de los nuevos usuarios registrados. 

		if (isset($_POST)) {
			require_once 'models/usuario.php';

			//PENDIENTE LA VALIDACION
			$n = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$a = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$r = isset($_POST['rol']) ? $_POST['rol'] : false;
			$e = isset($_POST['email']) ? $_POST['email'] : false;
			$p = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
			$usuario = new Usuario();
			$usuario->setNombre($n);
			$usuario->setApellidos($a);
			$usuario->setRol($r);
			$usuario->setEmail($e);
			$usuario->setPassword($p);

			$nombre = $usuario->getNombre();
			$apellidos = $usuario->getApellidos();
			$rol = $usuario->getRol();
			$email = $usuario->getEmail();
			$password = $usuario->getPassword();
			if ($nombre && $apellidos && $rol && $email && $password) :
				$resultado = $usuario->guardar();
				if ($resultado) {
					$_SESSION['register'] = "completed";
					header("Location: index.php?controller=Usuarios&action=registrar");
				} else {
					$_SESSION['register'] = "failed";
				}

			else :
				$_SESSION['register'] = "failed";
				header("Location: index.php?controller=Usuarios&action=registrar");
			endif;
			//PENDIENTE DE CREAR UN MENSAJE PARA INDICAR EXITO AL GUARDAR EL NUEVO USUARIO
		} else {
			$_SESSION['register'] = "failed";
		}
	}
	public function listarUsuarios()
	{
		//El presente metodo se encagara de conseguir todos los Usuarios y enviarlos para ser
		//mostrados en la vista.
		require_once 'models/usuario.php';
		$usuarios = new Usuario();
		$usuarios->listarTodos();
	}

	public function login()
	{
		if (isset($_POST)) {
			require_once 'models/usuario.php';
			//Identificar Usuario
			$e = isset($_POST['email']) ? $_POST['email'] : false;
			$p = isset($_POST['password']) ? $_POST['password'] : false;

			if ($e && $p) {
				$usuario = new Usuario();
				$usuario->setEmail($e);
				$usuario->setPassword($p);
				$estatus = $usuario->loguear();
				if ($estatus == true) {
					$identidad = $usuario->verificarIdentidad();
					if ($identidad) {
						$_SESSION['login'] = true;
						$_SESSION['identidad'] = $identidad;
						$verificacion = $usuario->verificarAdmin();
						//echo "Logueado, con el numero de identificacion $identidad.<br>";
						if ($verificacion == true) {
							$_SESSION['admin'] = true;
							//echo "Es administrador";
						} else {
							$_SESSION['admin'] = false;
							//echo "NO es administrador";
						}
					}
				}
			} else {
				echo "error al loguear";
				$_SESSION['login'] = false;
			}
		}
		header('Location: ?controller=Productos&action=index');
	}

	public function logout(){
		session_destroy();
		header('Location: ?controller=Productos&action=index');
	}
}
