<?php
require_once("../conexion/conexion.php");
$conexion = new Conexion();


if($_POST){
    if($_POST['producto'] && $_POST['cantidad']){

        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $producto = isset($_POST['producto']) ? $_POST['producto'] : false;
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : false;
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
        $quincena = isset($_POST['quincena']) ? $_POST['quincena'] : false;
        
        $producto_json = [
            'producto' => $producto,
            'cantidad' => $cantidad
        ];
        $producto_json = json_encode($producto_json);
        $producto_json = "[".$producto_json."]";
        $sql = "INSERT INTO CLIENTES(id, nombre, pedido, fecha, quincena) VALUES (NULL, '$nombre','$producto_json','$fecha','$quincena');";
        $conexion->ejecutar($sql);

        $redireccion = "<script>window.location.href = '../index.php'</script>;";
        echo $redireccion;
    }
}

?>