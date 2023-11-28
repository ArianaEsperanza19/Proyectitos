<?php
require_once("../conexion/conexion.php");
require_once("../Clases/ingresarProducto.php");
require_once("../Clases/ObtenerProductosCliente.php");
require_once("../Clases/actualizarExistencias.php");
$conexion = new Conexion();
//SE RECIBEN LOS DATOS DESDE INDEX.PHP PARA REESCRIBIR LA INFORMACION DEL PEDIDO
$id = null;
if ($_GET) {
  $id = isset($_GET['id']) ? $_GET['id'] : false;
}

if($_POST){
  $producto = isset($_POST['productos']) ? $_POST['productos'] : false;
  $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : false;
  $Nuevo_pedido = [
      'producto' => "$producto",
      'cantidad' => "$cantidad"
    ];
  actualizarExistencias::set_cantidad($cantidad);
  actualizarExistencias::set_conexion($conexion);
  actualizarExistencias::set_idProducto($producto);
  actualizarExistencias::actualizar();
  ingresarProducto::set_conexion($conexion);
  ingresarProducto::set_nuevoPedido($Nuevo_pedido);
  ingresarProducto::setIdCliente($id);
  ingresarProducto::ingresarProducto();
}

$conexion->cerrar();
$redireccion = "<script>window.location.href = '../Vistas/infoPedidos.php?id=$id'</script>;";
echo $redireccion;

?>