<?php
class CarritoController {
	
	public function mostrarTodos(){
		//Modelo
		//require_once 'models/usuario.php';
		echo "Controlador de pedidos, metodo para mostrarTodos";
		//Vista
		//require_once 'views/usuarios/mostrar-todos.php';
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

    }

    public function borrar(){
        require_once "models/utiles/borrarSession.php";
        borrarSession::borrar('carrito');
        header("Location: index.php?controller=Productos&action=index");
    }

    public function ver(){
        echo "<pre>";print_r($_SESSION['carrito']);echo "</pre>";
    }
}