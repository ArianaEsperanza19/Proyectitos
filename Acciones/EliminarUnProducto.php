<?php
require_once("../conexion/conexion.php");
require_once("../Clases/decodificarArregloProductoCliente.php");
//echo "Aqui se elimina un producto del pedido";

if($_GET){
    $cliente = isset($_GET['Cliente']) ? $_GET['Cliente'] : false;
    $producto = isset($_GET['Producto']) ? $_GET['Producto'] : false;

    $conexion = new Conexion();
    $sql = "SELECT pedido FROM CLIENTES WHERE id=$cliente";
    $datos = $conexion->consultar($sql);
    $datos = $datos[0]['pedido'];
    decodificarArregloProductoCliente::set_conexion($conexion);
    decodificarArregloProductoCliente::set_json($datos);
    $productos = decodificarArregloProductoCliente::decodificar();
    if(count($productos) > 1){
    $i = 0;
    foreach($productos as $dato)
    {   $p = $dato['id'];
        //echo "<pre>";print_r($dato['id']);echo "</pre>";
        if($p == $producto)
        {   
            unset($productos[$i]);
            
        }
        $i++;
    }
    $arregloFinal = [];
    foreach($productos as $producto)
    {
        $index = [
            'producto' => $producto['id'],
            'cantidad' => $producto['cantidad']
        ];
        array_push($arregloFinal, $index);
    }
    $arregloFinal = json_encode($arregloFinal);
    $sql = "UPDATE CLIENTES SET pedido='$arregloFinal' WHERE id=$cliente;";
    $conexion->ejecutar($sql);
    $sql = "SELECT existencias FROM PRODUCTOS WHERE id=$cliente;";
    $existencias = $conexion->consultar($sql);
    $existencias = $existencias[0][0] + 1;
    $sql = "UPDATE PRODUCTOS SET existencias='$existencias' WHERE id=$cliente;";
    $conexion->ejecutar($sql);
    $conexion->cerrar();
}
    $redireccion = "<script>window.location.href = '../Vistas/infoPedidos.php?id=$cliente'</script>;";
    echo $redireccion;
}


?>