<?php
require_once("../conexion/conexion.php");
require_once("../Clases/decodificarArregloProductoCliente.php");
require_once("../Clases/ganancia.php");
//echo "Aqui se muestran datos de los clientes";

$conexion = new Conexion();
$sql = "SELECT * FROM registro_ventas";
$Clientes = $conexion->consultar($sql);
$sql = "SELECT costo_pack FROM PRODUCTOS;";
$consulta = $conexion->consultar($sql);
$costoPacks = 0;
foreach ($consulta as $pack) {
  $pack = json_decode($pack['costo_pack']);
  $packPrecio = $pack->pack;
  $packCantidad = $pack->cantidad;
  $precio = $packCantidad * $packPrecio;
  $costoPacks += $precio;
}
//echo "<pre>";print_r($costoPacks); echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel='stylesheet' href='css/Panel-ingresos.css' />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Datos</title>
</head>

<body>
  <div class="barra">
    <span id='botones-barra'>
      <a href="../ventas.php" style='margin-right: 10px;' id='flecha'><img src='../Assets/atras.png' width='30px'></a>
      <a href="../Acciones/Recopilar-Registro.php" style='margin-left: 60px; margin-top: 20px;' class='button' id='registro'>Registro</a>
    </span>
  </div>
  <div id="total">
    <div class='panelGridLayout'>
      <label class='caja'>Id</label>
      <label class='caja'>Nombre</label>
      <label class='caja'>Total</label>
      <?php
      $total = 0;
      foreach ($Clientes as $Client) {
        $id = $Client['id_cliente'];
        $nombre = $Client['nombre'];
        $producto = $Client['pedido'];
        decodificarArregloProductoCliente::set_conexion($conexion);
        decodificarArregloProductoCliente::set_json($producto);
        $producto = decodificarArregloProductoCliente::decodificar();
        //$producto = decodificarArregloProductoCliente($producto, $conexion);
        //echo "<pre>";print_r($producto); echo "</pre>";
        $cantidad = 0;
        $total_cliente = 0;
        foreach ($producto as $p) {
          $cantidad = $p['cantidad'] * $p['precio_venta'];
          $total_cliente += $cantidad;
        }
        //echo "<pre>";print_r($total_cliente); echo "</pre>";
        $total += $total_cliente;
        echo "
            <span class = 'caja'>#$id</span>
            <span class = 'caja'>$nombre</span>
            <span class = 'caja'>$total_cliente$</span>
            ";
      }
      $gananciaNeta = $total - $costoPacks;
      echo "
        <label class = 'caja'></label>
        <label class = 'caja'>Ganancia bruta</label>
        <span class = 'caja'>$total$</span>
        <label class = 'caja'></label>
        <label class = 'caja'>Ganancia neta</label>
        <span class = 'caja'>$gananciaNeta$</span>";


      ?>
    </div>


    <div class='panelGridLayout2'>
      <?php
      $sql = "SELECT id FROM CLIENTES;";
      $consulta = $conexion->consultar($sql);
      $id_clientes = [];
      foreach ($consulta as $cliente) {
        array_push($id_clientes, $cliente['id']);
      }
      $sql = "SELECT id, nombre, costo_pack FROM PRODUCTOS;";
      $consulta = $conexion->consultar($sql);
      $info_productos = [];
      foreach ($consulta as $producto) {
        $arreglo = [
          "nombre" => $producto['nombre'],
          "id" => $producto['id'],
          "costoPack" => $producto['costo_pack'],
        ];
        array_push($info_productos, $arreglo);
      }
      //echo "<pre>";print_r($info_productos);echo "</pre>";

      echo "
              <span class='caja'>Id</span>
              <span class='caja'>Nombre</span>
              <span class='caja'>Ganancia Bruta</span>
              <span class='caja'>Ganancia Neta</span>";

      foreach ($info_productos as $producto) {
        $gananciaBruta = 0;
        $gananciaNeta = 0;
        $nombre = $producto['nombre'];
        $idP = $producto['id'];
        $costoPack = $producto['costoPack'];
        $costoPack = json_decode($costoPack);
        $costoPack = $costoPack->pack * $costoPack->cantidad;



        foreach ($id_clientes as $cliente) {
          ganancia::set_conexion($conexion);
          ganancia::setIdCliente($cliente);
          ganancia::set_id_producto($idP);
          $gananciaBruta += ganancia::Calcular_ganancia();
        }
        $gananciaNeta = $gananciaBruta - $costoPack;
        echo "
          <span class='caja'>#$idP</span>
          <span class='caja'>$nombre</span>
          <span class='caja'>$gananciaBruta$</span>
          <span class='caja'>$gananciaNeta$</span>
          ";
      }
      ?>

    </div>
  </div>
</body>
<script src="js/Panel-Ingresos.js"></script>

</html>