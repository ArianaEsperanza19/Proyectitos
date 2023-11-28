<?php
require_once("conexion/conexion.php");
$conexion = new Conexion();
$sql = "SELECT * FROM PRODUCTOS;";
$data = $conexion->consultar($sql);
$productos = [];
foreach($data as $i)
{   
    $producto = 
    [
        'id' => $i['id'],
        'nombre' => $i['nombre']
    ];
    array_push($productos, $producto);
}
//echo "<pre>";print_r($productos);echo "</pre>";

require_once("Vistas/form.php");
?>