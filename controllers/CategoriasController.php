<?php

class CategoriasController
{

	public function registrar()
	{
		//El presente metodo envia a la pagina para registrar nuevas categorias.
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {
			require_once 'views/categorias/registrar.phtml';
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function editar()
	{
		//El presente metodo envia a la pagina para editar categorias.
		require_once "models/utiles/verificarAdmin.php";
		require_once "models/ModeloDB.php";
		if (verificarAdmin::verificar()) {
			if (isset($_GET)) {
				$id = isset($_GET["id"]) ? $_GET["id"] : false;
				if ($id) {
					$db = new ModeloDB();
					$datos = $db->conseguir('categorias', '*', "id = $id");
					require_once 'views/categorias/editar.phtml';
				}
			}
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function guardarNuevo()
	{

		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {


			require_once 'models/categoria.php';
			if (isset($_POST)) {
				$n = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
				if ($n) {
					$categoria = new categoria();
					$categoria->setNombre($n);
					$resultado = $categoria->guardar();

					if ($resultado) {
						$_SESSION['register'] = "completed";
						header("Location: index.php?controller=Categorias&action=registrar");
					} else {
						$_SESSION['register'] = "failed";
						header("Location: index.php?controller=Categorias&action=registrar");
					}
				} else {
					$_SESSION['register'] = "failed";
					header("Location: index.php?controller=Categorias&action=registrar");
				}
			}
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
		// Modelo

	}

	public function borrar()
	{

		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {


			require_once "models/categoria.php";
			if (isset($_GET)) {
				$id = isset($_GET["id"]) ? $_GET["id"] : false;
				if ($id) {
					//NOTA: FALTA UNA ADVERTENCIA
					$categoria = new categoria();
					$resultado = $categoria->borrar($id);
					if ($resultado) {
						$_SESSION["borrado"] = true;
						header("Location: index.php?controller=Categorias&action=gestionar");
					} else {
						//Si hay error al borrar de la base de datos.
						$_SESSION["borrado"] = false;
						header("Location: index.php?controller=Categorias&action=gestionar");
					}
				}
			} else {
				//SINO
				//Si no se recibe el dato esperado por la url.
				$_SESSION["borrado"] = false;
				header("Location: index.php?controller=Categorias&action=gestionar");
			}
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function advertenciaBorrado()
	{
		//Este metodo redirecciona a una vista de advertencia antes de realizar el borrado de un registro.
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function sobreescribir()
	{
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {

			if (isset($_POST) && isset($_GET)) {
				$id = isset($_GET["id"]) ? $_GET["id"] : false;
				$n = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
				require_once 'models/categoria.php';
				$categoria = new Categoria();
				if ($id && $n) {
					$categoria->setNombre($n);
					$resultado = $categoria->actualizarRegistro($id);
					if ($resultado) {
						$_SESSION["edicion"] = true;
						header("Location: index.php?controller=Categorias&action=gestionar");
					} else {
						//Si hay error al borrar de la base de datos.
						$_SESSION["edicion"] = false;
						header("Location: index.php?controller=Categorias&action=gestionar");
					}
				}//Verificando que los datos no sean nulos
			}//Verificacion de datos recibidos
		}//Verificacion de admin
		else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function gestionar()
	{

		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {

			require_once 'models/categoria.php';
			$categorias = new categoria();
			$datos = $categorias->listarTodos();
			require_once 'views/categorias/gestionar.phtml';
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function filtrar(){
		if($_GET){
			$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : false;
			if($categoria){
				require_once "models/categoria.php";
				require_once "models/ModeloDB.php";
				$filtro = new Categoria;
				$datos = $filtro->listarFiltrados($categoria);
				$db = new ModeloDB();
				$nombre =  $db->conseguir('categorias', 'nombre', "id=$categoria");
				$db->cerrar();
				$nombre = $nombre->fetchColumn();
				require_once "views/categorias/filtrados.phtml";
			}
		}
	}
}
