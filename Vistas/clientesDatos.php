<!DOCTYPE html>
<html>
<head>
<title>Información</title>
  
<link rel="stylesheet" type="text/css" href="Vistas\css\clientesDatos.css">
 
</head>
<body>
  <div class="barra">
    <span id='botones-barra'>
    <a href="index.php" style='margin-right: 10px;' id='flecha'><img src='./Assets/atras.png' width='30px'></a>
    <span id='botones'>
    <a href="./Vistas/Panel-Productos.php" class='button' style='margin-right: 5px;'>Productos</a>
    <a href="./Vistas/Panel-ingresos.php" class='button' style='margin-right: 5px'>Finanzas</a>
    <a href="./Acciones/LimpiarPedidosTodos.php" class="button" style='margin-right: 5px;'>Limpiar</a>
    </span>
    </span>
    <form action="./Acciones/Buscar.php" id="buscador" method="post">
    <input type="submit" name="buscador" value="Enviar" class='button' style='margin-right: 5px'>
    <input type="text" name="busqueda" required>
    </form>
  </div>


  <div class="containerClientes">
  <div>ID</div>
  <div>Nombre</div>
  <div>Fecha de pedido</div>
  <div>Fecha de pago</div>
  <div></div>
    <?php 
    if(isset($clientes)){
    foreach($clientes as $cliente){ 
    //echo "<pre>";print_r($info);echo "</pre>";
    //die();
    $id = $cliente['id'];$nombre = $cliente['nombre'];
    $fecha = $cliente['fecha'];$quincena = $cliente['quincena'];
    
    echo "
    <div>#$id</div>
    <div>$nombre</div>
    <div>$fecha</div>
    <div>$quincena</div>
    <div><a href='Vistas/infoPedidos.php?id=$id' class='button'>Info</a></div>
    ";?>
    
    
    <?php }}else{echo "<p style='color:red'>Sin datos<p>";} ?>
    </div>

</body>
</html>