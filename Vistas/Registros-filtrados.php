<?php
require_once "../Acciones/Filtrar-Registros.php";
?>

<!DOCTYPE html>
<html>

<head>
  <title>Información</title>

  <link rel="stylesheet" type="text/css" href="..\Vistas\css\Recopilacion-de-Registros.css">

</head>

<body>
  <div class="barra">
    <span id='botones-barra'>
      <a href="../Vistas/Panel-ingresos.php" style='margin-right: 10px;' id='flecha'><img src='../Assets/atras.png' width='30px'></a>
    </span>
    <form action="Filtrar-Registros.php" id="buscador" method="post">
      <span id='intervalo_fecha_1'>
        <label for="fecha" class="letra">Fecha inicial:</label>
        <input type="date" id="fecha1" name="fecha_inicial" required>
      </span>
      <span id='intervalo_fecha_2'>
        <label for="fecha" class="letra">Fecha final:</label>
        <input type="date" id="fecha2" name="fecha_final" required>
      </span>
      <input type="submit" name="buscador" value="Filtrar" class='button' style='margin-right: 5px'>
    </form>
  </div>


  <div class="containerClientes">
    <div>ID</div>
    <div>Nombre</div>
    <div>Fecha de pago</div>
    <div></div>
    <div></div>
    <div>Beneficio</div>
    <?php
    $GananciaNeta = 0;
    if (isset($registros)) {
      foreach ($registros as $cliente) {
        $idCl = $cliente['id_cliente'];
        $nombre = $cliente['nombre'];
        $quincena = $cliente['fecha'];
        $productoPedido = $cliente['pedido'];
        $productoPedido = json_decode($productoPedido);
        $pedidos = [];
        foreach ($productoPedido as $p) {
          $cantidad = $p->cantidad;
          $idP = $p->producto;
          $indice =
            [
              'producto' => $idP,
              'cantidad' => $cantidad
            ];
          array_push($pedidos, $indice);
        }

        $costo_cliente = 0;
        $beneficioBruto = 0;
        $beneficio_cliente;
        foreach ($pedidos as $pedido) {
          $producto_id = $pedido['producto'];
          $cantidad_pedido = $pedido['cantidad'];
          $sql = "SELECT * FROM PRODUCTOS WHERE id='$producto_id';";
          $infoProducto = $conexion->consultar($sql);
          $precio = $infoProducto[0]['precio'];
          $infoProducto = $infoProducto[0]['costo_pack'];
          $infoProducto = "[" . "$infoProducto" . "]";
          decodificarJsonLimpio::set_json($infoProducto);
          $infoProducto = decodificarJsonLimpio::decodificar();
          $infoProducto = $infoProducto[0];
          $costo_cliente += $cantidad_pedido * $infoProducto->costoUnidad;
          $beneficioBruto += $cantidad_pedido * $precio;
        }
        $beneficio_cliente = $beneficioBruto - $costo_cliente;
        $GananciaNeta += $beneficio_cliente;


        echo "
    <div>#$idCl</div>
    <div>$nombre</div>
    <div>$quincena</div>
    <div><a href='#' class='button'>Info</a></div>
    <div><a href='#' class='button'>Borrar</a></div>
    <div>$beneficioBruto$ - $costo_cliente$ => $beneficio_cliente$</div>
    ";
        //<div><a href='Vistas/infoPedidos.php?id=$id' class='button'>borrar</a></div>
    ?>


    <?php }
      echo "
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div>TOTAL</div>
    <div><b>$GananciaNeta$</b></div></div>";
    } else {
      echo "<p style='color:red'>Sin datos<p>";
    }
    $conexion->cerrar();
    ?>


</body>

</html>