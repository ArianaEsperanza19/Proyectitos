<?php
require_once("../conexion/conexion.php");
$conexion = new Conexion();

#REVISAR PORQUE SOLO APARECE UN PRODUCTO EN EL SELECCIONADOR

function ProductosQueNoEstanEnElPedido($id_cliente, $conexion){
    $sql= "SELECT id FROM PRODUCTOS;";
    $registro_productos = $conexion->consultar($sql);
    $OtrosProductos = [];
    foreach($registro_productos as $registros)
    {   array_push($OtrosProductos ,$registros['id']);  }
    $sql = "SELECT pedido FROM CLIENTES WHERE id=$id_cliente;";
    $registro_productos = $conexion->consultar($sql);
    $registro_productos = $registro_productos[0]['pedido'];
    $registro_productos = json_decode($registro_productos);
    $productos_cliente = [];
    foreach($registro_productos as $cliente)
    {   $cliente = get_object_vars($cliente);
        array_push($productos_cliente, $cliente['producto']);
    }
    /////////////
    $arreglo_id_Producto_Cliente = [];
    //echo "<pre>";print_r($productos_cliente);echo "</pre>";
    foreach ($productos_cliente as $producto) {
        array_push($arreglo_id_Producto_Cliente, $producto);
    }
    /////////////
    //echo "<pre>";print_r($arreglo_id_Producto_Cliente);echo "</pre>";
    $productos_mostrar = [];
    foreach($OtrosProductos as $producto){


            if(!in_array($producto, $arreglo_id_Producto_Cliente))
        {
            array_push($productos_mostrar, $producto);
        } 

        }
        //echo "<pre>";print_r($arreglo_id_Producto_Cliente);echo "</pre>";


    return $productos_mostrar;
    
    
}



if($_GET){
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $redireccion = "../Acciones/AgregarProducto.php?id=$id";
    $productos_nombres = [];
    $productos = ProductosQueNoEstanEnElPedido($id, $conexion);
    //echo "<pre>";print_r($productos);echo "</pre>";
foreach($productos as $producto){
    $sql = "SELECT nombre, id FROM PRODUCTOS WHERE id=$producto";
    $resultado = $conexion->consultar($sql);
    array_push($productos_nombres, $resultado);
}
}

//echo "<pre>"; print_r($productos_nombres); echo "</pre>";

?>

<!DOCTYPE html>
<html>
<head>
<link
      rel="stylesheet"
      type="text/css"
      href="css\FormularioNuevoProducto.css"/>
    <title>Formulario</title>
</head>
<body>
<div id="total">
<h1>Formulario</h1>
    <form action="<?php echo $redireccion ?>" method="POST">
    <div>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required>
    </div>
    <div>
         <label for="opciones">Opciones:</label>
        
        <select id="productos" name="productos">
            <?php
                foreach($productos_nombres as $n){
                    $id = $n[0]['id'];
                    $nombre = $n[0]['nombre'];
                    $sql = "SELECT existencias FROM productos WHERE id='$id'";
                    $consulta = $conexion->consultar($sql);
                    $existencias = $consulta[0]['existencias'];
                    if($existencias > 0){
                        echo "<option value='$id'>$nombre</option>";
                    }
                }
            #OJO
            $href = "../Vistas/infoPedidos.php?id=$id_cliente";
            $conexion->cerrar();
            ?>
        </select>
    </div>
         <input type="submit" value="Enviar" class="button" style="margin-top: 10px;">
    </form>
    </div>
</body>
</html>