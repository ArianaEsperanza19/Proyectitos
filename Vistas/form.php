<!DOCTYPE html>
<html>
<head>
  <title>SGC</title>
  <link rel="stylesheet" type="text/css" href="Vistas\css\form.css">
</head>
<body class="index_body">
  
   <form id="pedido" action="./Acciones/AgregarRegistro.php" id='form' method="POST">
    <h1 class="letra">Formulario</h1>
    <p id='mensaje_nombre' class='alert'></p>
    <label class="letra" for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label class="letra" for="producto">Producto:</label>
    <p id='mensaje_producto' class='alert'></p>
    <select  id="producto" name="producto" required>
      <?php
      $x = [];
      foreach ($productos as $producto) {
        $id = $producto['id'];
        $nombre = $producto['nombre'];
        $sql = "SELECT existencias FROM productos WHERE id='$id'";
        $consulta = $conexion->consultar($sql);
        $existencias = $consulta[0]['existencias'];
        if($existencias > 0)
        {
        echo "<option value='".$id."' value='".$nombre."'>$nombre</option>";
      }
      }
      $conexion->cerrar();
      ?>
    </select><br><br>
    <p id='mensaje_cantidad'></p>
    <label class="letra" for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" required><br><br>

    <p id='mensaje_fecha'></p>
    <label for="fecha" class="letra">Fecha:</label>
    <input type="date" id="fecha" name="fecha" required><br><br>

    <p id='mensaje_quincena'></p>
    <label for="quincena" class="letra">Quincena:</label>
    <input type="date" id="quincena" name="quincena" required><br><br>
    <p id='mensaje_fechas'></p>
    <input type="submit" class="button" id='submit'>
    <a href='ventas.php' class="button">Ver</a>

    <!--
      Ponerle el signo ? a php para reactivarlo
      <a <php if($centinela === false){ echo "href='ventas.php'";}else{
      //Aqui iria lo que se haria con los datos para la edicion del pedido
      //Por ahora lo dejamos para que se pueda pasar
    } ?> class="button">Ver</a>
    -->
  </form>
</body>
<script src="Vistas\js\index.js"></script>
</html>