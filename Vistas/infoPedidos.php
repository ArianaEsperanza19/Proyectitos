<?php
require_once("../conexion/conexion.php");
require_once("../Clases/decodificarArregloProductoCliente.php");
require_once("../Clases/procesarDatosBrutosClientes.php");

if ($_GET) {
  $id = isset($_GET['id']) ? $_GET['id'] : false;
}
$sql = "SELECT * FROM CLIENTES WHERE id=$id;";
$conexion = new Conexion();
$datos_clientes = $conexion->consultar($sql);
procesarDatosBrutosClientes::set_datos_Clientes($datos_clientes);
$cliente = procesarDatosBrutosClientes::procesarDatos();
//echo "<pre>";print_r($cliente);echo "</pre>";

$id = $cliente[0]['id'];
$nombre = $cliente[0]['nombre'];
$pedido = $cliente[0]['pedido'];
$fecha = $cliente[0]['fecha'];
$quincena = $cliente[0]['quincena'];

decodificarArregloProductoCliente::set_conexion($conexion);
decodificarArregloProductoCliente::set_json($pedido);
$pedido = decodificarArregloProductoCliente::decodificar();

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
      <a href="../ventas.php" style='margin-right: 10px;' id='flecha'><img src='../Assets/atras.png' width='30px'></a>
      <a href="../Acciones/LimpiarPedidoUsuario.php?id=<?php echo $id ?>" id='Boton' class="button2" style='margin-right: 5px;'>Limpiar</a>
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
      <p>Quincena</p>
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
      <p><?php echo "$quincena" ?></p>
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
      if (count($pedido) > 1) {
        echo "<a href='../Vistas/PantallaAdvertencia.php?id=$id&producto=$id_producto' class='button'><p>Borrar</p></a>";
      }
      echo "</div>";

      $total_del_pedido += $total;
    }
    $redirecion_IncluirNuevoProducto = "IncluirNuevoProducto.php?id=$id";
    $redirecion_EliminarPedido = "PantallaAdvertencia.php?id=$id";
    ?>


  </div>


  <div class="pie_panel" id="Panel_Base">
    <div class="caja">
      <p style="text-align: left; position: relative;
            left: 80px;"><a href="<?php echo $redirecion_IncluirNuevoProducto; ?>" id="AgregarProducto" class="Push">Agregar un producto</a></p>
    </div>
    <div class="caja">
      <p></p>
    </div>
    <div class="caja">
      <p>Total</p>
    </div>
    <div class="caja" style='background-color: black'>
      <p style="text-align: left; position: relative;left: 80px;"><a href="<?php echo $redirecion_EliminarPedido; ?>" id="TerminarPedido" class="Push">Terminar pedido</a></p>
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