<?php
require_once("../conexion/conexion.php");
require_once("../Clases/decodificarArregloProductoCliente.php");
if ($_GET) {
  $id = isset($_GET['id']) ? $_GET['id'] : false;
}
$sql = "SELECT * FROM registro_ventas WHERE id_cliente=$id;";
$conexion = new Conexion();
$datos_clientes = $conexion->consultar($sql);

//Esta funcion esta configurada para funcionar con la tabla registro_ventas, no es igual a la de infoPedidos
function procesarDatosBrutosClientes($clientes)
{
  //Funcion que procesa los datos de los clientes.

  $respuesta = [];
  foreach ($clientes as $cliente) {
    $arr =
      [
        'id' => $cliente['id_cliente'],
        'nombre' => $cliente['nombre'],
        'pedido' => $cliente['pedido'],
        'fecha' => $cliente['fecha'],
      ];

    array_push($respuesta, $arr);
  }

  return $respuesta;
}
$cliente = procesarDatosBrutosClientes($datos_clientes);
//echo "<pre>";print_r($cliente);echo "</pre>";

$id = $cliente[0]['id'];
$nombre = $cliente[0]['nombre'];
$pedido = $cliente[0]['pedido'];
$fecha = $cliente[0]['fecha'];

decodificarArregloProductoCliente::set_conexion($conexion);
decodificarArregloProductoCliente::set_json($pedido);
$pedido = decodificarArregloProductoCliente::decodificar();
//echo "<pre>";print_r($id);echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/infoPedidos.css" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <div class="barra">
    <span id='botones-barra'>
      <a href="../acciones/Recopilar-Registro.php" style='margin-right: 10px;' id='flecha'><img src='../Assets/atras.png' width='30px'></a>
    </span>
  </div>
  <div class="panelGridLayout">
    <div class="caja" style='background-color: black'>
      <p>ID</p>
    </div>
    <div class="caja" style='background-color: black'>
      <p>Nombre</p>
    </div>
    <div class="caja" style='background-color: black'>
      <p>Fecha</p>
    </div>
    <div class="caja" style='background-color: black'>
      <p></p>
    </div>
    <div class="caja" style='background-color: black'>
      <p></p>
    </div>

    <div class="caja">
      <p>#<?php echo "$id" ?></p>
    </div>
    <div class="caja">
      <p><?php echo "$nombre" ?></p>
    </div>
    <div class="caja">
      <p><?php echo "$fecha" ?></p>
    </div>
    <div class="caja">
      <p></p>
    </div>
    <div class="caja">
      <p></p>
    </div>

    <div class="caja" style='background-color: black'>
      <p></p>
    </div>
    <div class="caja" style='background-color: black'>
      <p></p>
    </div>
    <div class="caja" style='background-color: black'>
      <p>Productos</p>
    </div>
    <div class="caja" style='background-color: black'>
      <p></p>
    </div>
    <div class="caja" style='background-color: black'>
      <p></p>
    </div>
  </div>
  </div>



  <div class="subpanel" id="Panel_Productos">
    <?php
    $total_del_pedido = 0;
    foreach ($pedido as $p) {
      $id_producto = $p['id'];
      $nombre = $p['nombre'];
      $cantidad = $p['cantidad'];
      $precio = $p['precio_venta'];
      //VERIFICAR LA CANTIDAD DE PRODUCTO
      $total = $cantidad * $precio;
      //cajaProducto

      echo "<div class='caja' style='background-color: #1e1e1e'>
        <p>$nombre</p>
      </div>
      <div class='caja'>
        <p>$precio$</p>
      </div>
      <div class='caja' style='background-color: #1e1e1e'>
        <p>$cantidad</p>
      </div>
      <div class='caja'>
        <p>$total$</p>
      </div>
      <div class='caja' style='background-color: #1e1e1e'>";
      echo "</div>";

      $total_del_pedido += $total;
    }
    $redirecion_IncluirNuevoProducto = "IncluirNuevoProducto.php?id=$id";
    $redirecion_EliminarPedido = "PantallaAdvertencia.php?id=$id";
    ?>


  </div>


  <div class="pie_panel" id="Panel_Base">
    <div class="caja">
    </div>
    <div class="caja">
      <p></p>
    </div>
    <div class="caja">
      <p>Total</p>
    </div>
    <div class="caja" style='background-color: black'>
    </div>
    <div class="caja" style='background-color: black'>
      <p></p>
    </div>
    <div class="caja" style='background-color: black'>
      <p><?php echo $total_del_pedido . "$"; ?></p>
    </div>
  </div>

</body>
<script src="js/infoPedidos.js"></script>

</html>
<!--hacer un panel con html que ocupe 80% del ancho de la pantalla y despliegue horizontalmente: id, nombre, fecha, quincena. Debe tener los bordes redondeados-->