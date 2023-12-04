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
                $producto = new Producto();
                $datos = $producto->conseguirUno($id_producto);
                $precio = $datos->fetchColumn(3);
                if(@isset($_SESSION['carrito'])){
                   echo 'hay session';
                   
                }else{
                    echo 'no hay session';
                    $_SESSION['carrito'] = array(
                        "id_producto" => $id_producto,
                        "precio" => $precio,
                        "unidades" => 1,
                        "objeto" => $datos
                    );

                    

                }
                var_dump($_SESSION['carrito']);
                
                        /*$nuevo = array(
                            "id_producto" => $id_producto,
                            "precio" => $precio,
                            "unidades" => 1,
                            "objeto" => $datos
                        );
                        */
               
                    //echo "<pre>";print_r($_SESSION['carrito']);echo "</pre>";
                    

                    //$nuevo = array_push($_SESSION['carrito'], $nuevo);
                    //$_SESSION['carrito'] = $nuevo;
                    
                
                    //echo "<pre>";print_r($_SESSION['carrito']);echo "</pre>";
                }
                //echo "<pre>";print_r($_SESSION['carrito']);echo "</pre>";
            }}
        //else{
            //header("Location: index.php?controller=Productos&action=index");
        //}

		
	

    public function quitar(){

    }

    public function borrar(){
        require_once "models/utiles/borrarSession.php";
        borrarSession::borrar('carrito');
        header("Location: index.php?controller=Productos&action=index");
    }
}