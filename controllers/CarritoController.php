<?php
class CarritoController {
	
	public function ver(){
		
		require_once("models/carrito.php");
        $carrito = new Carrito();
        $datos = $carrito->ver();
        require_once("views/carrito/ver.phtml");
	}
	
	public function agregar(){
        if($_GET['producto']){
            $id_producto = isset($_GET['producto']) ? $_GET['producto'] : false;
            if($id_producto){
                require_once "models/producto.php";
                require_once "models/carrito.php";
                $producto = new Producto();
                $datos = $producto->conseguirUno($id_producto);
                $precio = $datos->fetchColumn(3);
                $carrito = new Carrito();
                $carrito->setId_producto($id_producto);
                $carrito->set_datos($datos);
                $carrito->set_precio($precio);
                
                if(isset($_SESSION['carrito'])){
                    $nuevo_carrito = $carrito->agregar();
                }else{
                    $nuevo_carrito = $carrito->agregar_primero();
                }
                


                } else{
                    header("Location: index.php?controller=Productos&action=index");
                }
                
                }
                
            }

    
            public function quitar(){
        if($_GET['producto']){
            $id_producto = isset($_GET['producto']) ? $_GET['producto'] : false;
            if($id_producto){
                require_once "models/producto.php";
                require_once "models/carrito.php";
                $producto = new Producto();
                $datos = $producto->conseguirUno($id_producto);
                $carrito = new Carrito();
                $carrito->setId_producto($id_producto);

                if(isset($_SESSION['carrito'])){
                    $actualizacion = $carrito->remover($id_producto);
                    require_once("models/utiles/JsonManager.php");
                    JsonManager::set_json($actualizacion);
                    echo "<pre>";print_r($actualizacion);echo "</pre>";
                    $actualizacion = JsonManager::codificar();
                    $_SESSION['carrito'] = $actualizacion;
                    header("Location: index.php?controller=Carrito&action=ver");
                }
                


                }else{
                    header("Location: index.php?controller=Productos&action=index");
                }
                
                }
    }

    public function poner(){
        if($_GET['producto']){
            $id_producto = isset($_GET['producto']) ? $_GET['producto'] : false;
            if($id_producto){
                require_once "models/producto.php";
                require_once "models/carrito.php";
                $producto = new Producto();
                $datos = $producto->conseguirUno($id_producto);
                $carrito = new Carrito();
                $carrito->setId_producto($id_producto);
                if(isset($_SESSION['carrito'])){
                    $actualizacion = $carrito->sumar($id_producto);
                    require_once("models/utiles/JsonManager.php");
                    JsonManager::set_json($actualizacion);
                    echo "<pre>";print_r($actualizacion);echo "</pre>";
                    $actualizacion = JsonManager::codificar();
                    $_SESSION['carrito'] = $actualizacion;
                    header("Location: index.php?controller=Carrito&action=ver");
                }
                


                }else{
                    header("Location: index.php?controller=Productos&action=index");
                }
                
                }
    }

    public function borrarTodo(){
        require_once "models/utiles/borrarSession.php";
        borrarSession::borrar('carrito');
        header("Location: index.php?controller=Productos&action=index");
    }

    public function borrarUno(){
        if($_GET['producto']){
            $id_producto = isset($_GET['producto']) ? $_GET['producto'] : false;
            if($id_producto){
                require_once "models/carrito.php";
                $carrito = new Carrito();
                $carrito->setId_producto($id_producto);
                $datos = $carrito->eliminar();
                JsonManager::set_json($datos);
                $datos = JsonManager::decodificar();
                if (is_array($datos) && count($datos) == 1){
                    $correcion = $datos;
                    $datos = $correcion[0];
                    JsonManager::set_json($datos);
                    $datos = JsonManager::codificar();
                }
                echo "<pre>";
                print_r($datos);
                echo "<pre>";
                $_SESSION['carrito'] = $datos;
                header("Location: index.php?controller=Carrito&action=ver");
            }
        }
    }

    public function session(){
        echo "<pre>";print_r($_SESSION['carrito']);echo "</pre>";
        $actualizacion = $_SESSION['carrito'];
        require_once("models/utiles/JsonManager.php");
                    JsonManager::set_json($actualizacion);
                    $actualizacion = JsonManager::decodificar();
                    echo "<pre>";print_r($actualizacion[0]);echo "</pre>";
    }
}