<?php
require_once "../conexion/conexion.php";
require_once "../Clases/Limpiar-Datos-Todos-Pedidos.php";


$conexion = new Conexion();
$sql = "SELECT id FROM CLIENTES;";
$datos = $conexion->consultar($sql);
//echo "<pre>";print_r($datos);echo "</pre>";
LimpiarDatosTodosPedidos::set_conexion($conexion);
LimpiarDatosTodosPedidos::setIdCliente($datos);
LimpiarDatosTodosPedidos::LimpiarDatosTodosPedidos();
$conexion->cerrar();
$redireccion = "<script>window.location.href = '../ventas.php'</script>;";
echo $redireccion;
?> 