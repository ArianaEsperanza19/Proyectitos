<?php
require_once 'utiles/escaparDatos.php';
require_once 'ModeloDB.php';

class Carrito{

    private $id_producto;
    private $datos;
    private $precio;
	
	public function __construct() {
		$this->conexion = DB::Connect();
	}

    public function getId_producto()
    {
        return $this->id_producto;
    }

    public function get_datos()
    {
        return $this->datos;
    }

    public function get_precio()
    {
        return $this->precio;
    }

    public function setId_producto($id_producto)
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    public function set_datos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

    public function set_precio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

	#Agregar un producto al carrito
    public function agregar(){

        $id_producto = $this->id_producto;
        $datos =  $this->datos;
        $precio = $this->precio;
        $actualizacion = "";
        
            $datos_carrito = $_SESSION['carrito'];
            
            require_once("models/utiles/JsonManager.php");
            JsonManager::set_json($datos_carrito);
            $datos_carrito = JsonManager::decodificar();
            //print_r("SESSION");
          
            require_once "models/utiles/centinela.php";
            $centinela = centinela::verificar($datos_carrito);
            if($centinela == true){
                //print_r("actualizar producto. Centinela es: $centinela"."<br>");
                $actualizacion = $this->verificarProducto($datos_carrito);
                //print_r("ACTUALIZACION"); 
                //echo "<pre>";print_r($actualizacion);echo "</pre>";
            }else{
                //print_r("actualiza varios. Centinela es: $centinela"."<br>");
                $actualizacion = $this->verificarProductos($datos_carrito);
                //print_r("ACTUALIZACION");
                //echo "<pre>";print_r($actualizacion);echo "</pre>";
            }
            echo "<pre>";print_r($actualizacion);echo "</pre>";
            JsonManager::set_json($actualizacion);
            $actualizacion = JsonManager::codificar($actualizacion);

            
            $_SESSION['carrito'] = $actualizacion;

        
}

public function agregar_primero(){
    //echo 'no hay session';
    $id_producto = $this->id_producto;
    $datos =  $this->datos;
    $precio = $this->precio;
            $nuevo = [
                "id_producto" => $id_producto,
                "precio" => $precio,
                "unidades" => 1,
                "objeto" => $datos
            ];
            $nuevo = json_encode($nuevo);
            $_SESSION['carrito'] = $nuevo;
}

public function verificarProductos($datos_carrito){
        $id_producto = $this->id_producto;
        $datos =  $this->datos;
        $precio = $this->precio;
        //print("Datos del carrito de verificarProductoS");
        //echo "<pre>";print_r($datos_carrito);echo "</pre>";
        
        foreach ($datos_carrito as $producto) {
            //echo "<pre>";print_r($producto->id_producto . " comparado con " . $id_producto);echo "</pre>";
            if ($producto->id_producto == $id_producto) {
                //echo "producto en el carrito";
                $producto->unidades = $producto->unidades + 1;
                return $datos_carrito;
            }

                //echo "producto NO en el carrito";
                $producto = $_SESSION['carrito'];
                JsonManager::set_json($producto);
                $datos_session = JsonManager::decodificar();
                $nuevoProducto = [
                    "id_producto" => $id_producto,
                    "precio" => $precio,
                    "unidades" => 1,
                    "objeto" => $datos
                ];
                $carrito = $this->guardarTodo($datos_session, $nuevoProducto);
        }
        
        return $carrito;
        }

        
    


public function verificarProducto($datos_carrito){
        $id_producto = $this->id_producto;
        $datos =  $this->datos;
        $precio = $this->precio;
        
        //print("Datos del carrito de verificarProducto");
        //echo "<pre>";print_r($datos_carrito);echo "</pre>";
        
        if ($datos_carrito->id_producto == $id_producto){
            $datos_carrito->unidades = $datos_carrito->unidades + 1;
            
            //require_once("models/utiles/JsonManager.php");
            //JsonManager::set_json($datos_carrito);
            //$actualizacion = JsonManager::codificar();
            return $datos_carrito;
        }
            
            // Cuando el producto NO está en el carrito
            $producto = $_SESSION['carrito'];
            JsonManager::set_json($producto);
            $datos_carrito = JsonManager::decodificar();
            $nuevoProducto = [
                "id_producto" => $id_producto,
                "precio" => $precio,
                "unidades" => 1,
                "objeto" => $datos
            ];
            
            $carrito = $this->guardarTodo($datos_carrito, $nuevoProducto);
            //JsonManager::set_json($carrito);
            //$actualizacion = JsonManager::codificar();
            return $carrito;
}

public function guardarTodo($datos_session, $nuevo){
    //NOTA: EL ELEMENTO DE LA SESSION ENTRA COMO OBJETO Y EL NUEVO COMO ARREGLO;
    require_once "models/utiles/centinela.php";
    $centinela = centinela::verificar($datos_session);
    
    if($centinela){
        $carrito[] = $datos_session;
        $carrito[] = $nuevo;
        //echo "<pre>";print_r($carrito);echo "</pre>";
    }else{
        foreach($datos_session as $producto){
            $carrito[] = $producto;
        }
        $carrito[] = $nuevo;
    }
    return $carrito;
}

public function remover(){

}

public function ver(){
    if(isset($_SESSION['carrito'])){
        require_once("models/utiles/JsonManager.php");
        $datos = $_SESSION['carrito'];
        JsonManager::set_json($_SESSION['carrito']);
        //$datos = JsonManager::decodificar();
        echo "<pre>";print_r($datos);echo "</pre>";
    }
}

}

?>