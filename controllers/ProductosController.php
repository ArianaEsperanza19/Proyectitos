<?php
class ProductosController
{

	public function index()
	{	$productos = new ModeloDB();
		$productosRandom = $productos->conseguirRandom("productos",3);
		require_once 'views/productos/NuestrosProductos.phtml';
	}

	public function info()
	{
		if($_GET){
			$producto = isset($_GET['producto']) ? $_GET['producto'] : false;
			$db = new ModeloDB();
			$info = $db->conseguir('productos', '*', "id=$producto");
			require_once "views/productos/info.phtml";
		}
	}

	public function registrar()
	{	//El presente metodo envia a la pagina para registrar nuevos productos.
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {
			require_once 'views/productos/registrar.phtml';
			//echo"<pre>";print_r($listado);echo"</pre>";
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function editar(){
		//El presente metodo envia a la vista del formulario para editar un producto.
		//Nivel de acceso = 1
		require_once "models/utiles/verificarAdmin.php";
		require_once "models/ModeloDB.php";
		if (verificarAdmin::verificar()) {
			if(isset($_GET)){
				$id = isset($_GET["id"]) ? $_GET["id"] : false;
				if($id){
					$db = new ModeloDB();
					$datos = $db->conseguir('productos','*',"id = $id");
					require_once 'views/productos/editar.phtml';
					//echo"<pre>";print_r($listado);echo"</pre>";
				} 
			}
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function guardarNuevo()
	{
		//El presente metodo guarda un nuevo registro de producto.
		//Nivel de acceso = 1
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {
			if (isset($_POST)) {
				require_once 'models/producto.php';
				$n = isset($_POST['nombre']) ? $_POST['nombre'] : false;
				$p = isset($_POST['precio']) ? $_POST['precio'] : false;
				$c = isset($_POST['categorias']) ? $_POST['categorias'] : false;
				$d = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
				$i = isset($_FILES['imagen']) ? $_FILES['imagen'] : false;
				$s = isset($_POST['stock']) ? $_POST['stock'] : false;
				$fecha = new DateTime();
				if ($i['name'] != NULL || $i == false) {
					$i = $fecha->getTimestamp() . '_' . $_FILES['imagen']['name']; //Recepciona el nombre del archivo que viene en el arreglo que se recibe
					$imagenTemporal = $_FILES['imagen']['tmp_name']; //Imagen temporal
					move_uploaded_file($imagenTemporal, "assets/img/" . $i);
				} else {
					$i = NULL;
				}

				$producto = new Producto();
				$producto->setNombre($n);
				$producto->setPrecio($p);
				$producto->setCategorias($c);
				$producto->setDescripcion($d);
				$producto->setImagen($i);
				$producto->setStock($s);

				$nombre = $producto->getNombre(); 
				$precio = $producto->getPrecio(); 
				$categoria = $producto->getCategorias();
				$descripcion = $producto->getDescripcion();
				$imagen = $producto->getImagen();
				$stock = $producto->getStock();


				if ($nombre && $precio && $categoria && $descripcion && $imagen && $stock) :
					$resultado = $producto->guardar();
					if ($resultado) {
						$_SESSION['register'] = "completed";
						header("Location: index.php?controller=Productos&action=registrar");
					} else {
						$_SESSION['register'] = "failed";
						header("Location: index.php?controller=Productos&action=registrar");
					}
				else :
					$_SESSION['register'] = "failed";
					header("Location: index.php?controller=Productos&action=registrar");
				endif;
			}
			else{
				echo "error";
			}
		} else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function borrar(){
		//El presente metodo borra un registro de producto.
		//Nivel de acceso = 1
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {
			if(isset($_GET)){
				$id = isset($_GET["id"]) ? $_GET['id'] : false;
				if($id){
					require_once "models/producto.php";
					$producto = new Producto();
					$resultado = $producto->borrar($id);
					if ($resultado) {
						$_SESSION["borrado"] = true;
						header("Location: index.php?controller=Productos&action=gestionar");
					}else {
						//Si hay error al borrar de la base de datos.
						$_SESSION["borrado"] = false;
						header("Location: index.php?controller=Productos&action=gestionar");
					}
				} else {
					//Si no se recibe el dato esperado por la url.
					$_SESSION["borrado"] = false;
					header("Location: index.php?controller=Productos&action=gestionar");
				}
				
			}
		}else {
			header("Location: index.php?controller=Productos&action=index");
		}
		
	}

	public function advertenciaBorrado(){
		//Este metodo redirecciona a una vista de advertencia antes de realizar el borrado de un registro.
		//Nivel de acceso = 1
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {

		}else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function sobreescribir(){
		//Reescribe la informacion del producto dado.
		//Nivel de acceso = 1
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {
			
			if(isset($_POST) && isset($_GET)){
				
				$id = isset($_GET["id"]) ? $_GET["id"] : false;
				$n = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
				$p = isset($_POST["precio"]) ? $_POST["precio"] : false;
				$d = isset($_POST["descripcion"]) ? $_POST["descripcion"] : false;
				$s = isset($_POST["stock"]) ? $_POST["stock"] : false;
				$c = isset($_POST["categorias"]) ? $_POST["categorias"] : false;
				$i = isset($_FILES["imagen"]) ? $_FILES["imagen"] : false;
				require_once 'models/producto.php';
				$producto = new Producto();
				if($i){
					$i_nombre = $i["name"];
					$producto->setImagen($i_nombre);
				}

				//var_dump("id= ".$id." nombre= ".$n." precio= ".$p." stock= ".$s." imagen= ".$i." categoria= ".$c);
				if($n && $p && $s && $c && $id){
					$producto->setNombre($n);
					$producto->setPrecio($p);
					$producto->setCategorias($c);
					$producto->setDescripcion($d);
					$producto->setStock($s);
					$resultado = $producto->actualizarRegistro($id, $i);
					if ($resultado) {
						$_SESSION["edicion"] = true;
						header("Location: index.php?controller=Productos&action=gestionar");
					}else {
						//Si hay error al borrar de la base de datos.
						$_SESSION["edicion"] = false;
						header("Location: index.php?controller=Productos&action=gestionar");
					}	
				}
			}
		}else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}

	public function gestionar(){
		//El presente metodo envia a la pagina para gestionar los productos en la DB.
		//Nivel de acceso = 1
		require_once "models/utiles/verificarAdmin.php";
		if (verificarAdmin::verificar()) {

			require_once 'models/producto.php';
			$producto = new producto();
			$datos = $producto->listarTodos();
			require_once 'views/productos/gestionar.phtml';

		} 
		else {
			header("Location: index.php?controller=Productos&action=index");
		}
	}
}
