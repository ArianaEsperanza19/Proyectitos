<?php
require_once '../conexion/conexion.php';
require_once "../Clases/procesarDatosBrutosClientes.php";
require_once("../Clases/decodificarJsonLimpio.php");

if ($_GET) {
  $id = isset($_GET['id']) ? $_GET['id'] : false;
  $conexion = new Conexion();
  $sql = "SELECT * FROM CLIENTES WHERE id=$id";
  $pedido = $conexion->consultar($sql);
  procesarDatosBrutosClientes::set_datos_Clientes($pedido);
  $pedido = procesarDatosBrutosClientes::procesarDatos();
  $pedido = $pedido[0]['pedido'];
  decodificarJsonLimpio::set_json($pedido);
  $pedido = decodificarJsonLimpio::decodificar();
  //echo "<pre>";print_r($pedido);echo "<pre>";
  $Limpiar = [];
  foreach ($pedido as $arr) {
    $producto = $arr->producto;
    $sql = "SELECT id FROM PRODUCTOS WHERE id=$producto;";
    $datos = $conexion->consultar($sql);
    if ($datos == null) {
      array_push($Limpiar, $producto);
    }
  }

  foreach ($Limpiar as $elemento) {

    for ($i = count($pedido) - 1; $i >= 0; $i--) {
      $producto = $pedido[$i]['producto'];
      #echo "<pre>";
      #print_r("Elemento del pedido: " . $producto . " Elemento a eliminar:" . $elemento);
      #echo "<pre>";
      if (in_array($producto, $Limpiar)) {
        unset($pedido[$i]);
        //echo "Elemento eliminado del índice $i<br>";
      }
    }
    $pedido = array_values($pedido);
  }

  //echo "<pre>";print_r($pedido);echo "<pre>";
  $pedido = json_encode($pedido);
  $sql = "UPDATE CLIENTES SET pedido = '$pedido' WHERE id=$id;";
  $conexion->ejecutar($sql);
  $conexion->cerrar();
  $redireccion = "<script>window.location.href = '../Vistas/infoPedidos.php?id=$id'</script>;";
  echo $redireccion;

}
