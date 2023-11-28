<?php
//echo "resultados";echo "<pre>";print_r($salida);echo "</pre>";
?>
<html>
<body>
<link rel="stylesheet" type="text/css" href="../Vistas/css/Resultados-Busqueda.css">
  <div class="barra">
    <span id='botones-barra'>
    <a href="../ventas.php" style='margin-right: 10px;' id='flecha'><img src='../Assets/atras.png' width='30px'></a>
    <span id='botones'>
    <a href="./Vistas/Panel-Productos.php" class='button' style='margin-right: 5px;'>Productos</a>
    <a href="./Vistas/Panel-ingresos.php" class='button' style='margin-right: 5px'>Finanzas</a>
    <a href="./LimpiarPedidosTodos.php" class="button" style='margin-right: 5px;'>Limpiar</a>
    </span>
    </span>
    <form action="./Buscar.php" id="buscador" method="post">
    <input type="submit" name="buscador" value="Enviar" class='button' style='margin-right: 5px'>
    <input type="text" name="busqueda" required>
    </form>
  </div>
  <div id="C">
    <?php foreach($salida as $cliente){ 
    //echo "<pre>";print_r($info);echo "</pre>";
    //die();?>
    <div class="info-container" style="padding-top: 20px;">
        <label for="id" class="letra">Identificador:</label>
    <?php
    $id = $cliente['id'];
      echo  "<span id='id' class='letra'>#$id</span>";
    ?>
    </div>

    <div class="info-container">
    <label for="nombre" class="letra">Nombre:</label>
    <?php
    $nombre = $cliente['nombre'];
    echo "<span id='nombre' class='letra'>$nombre</span>";
    ?>
    </div>


    <div class="info-container">
    <label for="fecha" class="letra">Fecha:</label>
    <?php
    $fecha = $cliente['fecha'];
    echo "<span id='fecha' class='letra'>$fecha</span>";
    ?>
    </div>

    <div class="info-container">
    <label for="quincena" class="letra">Quincena:</label>
    <?php
    $quincena = $cliente['quincena'];
    echo "<span id='quincena' class='letra'>$quincena</span>";
    ?>
    </div>

    <div class="info-container">
    <?php
    echo "<a href='../Vistas/infoPedidos.php?id=$id' class='button'>Info</a>";
    ?>
    </div>
    <br>
    
    <?php } ?>
    </div>
</body>
</html>