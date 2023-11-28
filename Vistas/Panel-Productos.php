<?php
require_once("../conexion/conexion.php");
//echo "Aqui se muestran los productos existentes en la base de datos";

$conexion = new Conexion();
$sql = "SELECT * FROM PRODUCTOS";
$consulta = $conexion->consultar($sql);
$conexion->cerrar();
//echo "<pre>";print_r($consulta);echo "</pre>";

?>
<html>
<link rel="stylesheet" type="text/css" href="css\Panel-Productos.css">
<div class="barra">
    <span id='botones-barra'>
        <a href="../ventas.php" id='flecha'><img src='../Assets/atras.png' width='30px'></a>
        <a href="../Vistas/FormularioNuevoProducto.html" class='button2' id='NuevoProducto'>Insertar Nuevo Producto</a>
    </span>
</div>
<div id='despliegue'>
    <div class="panelGridLayout">
        <span class='caja'>Id</span>
        <span class='caja'>Nombre</span>
        <span class='caja'>Precio al mayor</span>
        <span class='caja'>Precio al detal</span>
        <span class='caja'></span>
        <span class='caja'></span>
        <?php
        foreach ($consulta as $producto) {
            $id = $producto['id'];
            $nombre = $producto['nombre'];
            $precio = $producto['precio'];
            $existencias = $producto['existencias'];
            $pack = $producto['costo_pack'];
            $pack = json_decode($pack);
            $pack = $pack->pack;
            $a = "<span><a href='PantallaAdvertencia.php?id=$id&BD=true' class='button'>Borrar</a></span>";
            $a2 = "<span><a href='../Acciones/Surtir.php?id=$id' class='button'>Surtir</a></span>";
            $borrar = "<span class='caja'>$a</span>";
            $surtir_boton = "<span class='caja'>$a2</span>";
            echo "
        <span class='caja'>#$id</span>
    <span class='caja'>$nombre</span>
    <span class='caja'>$pack$</span>
    <span class='caja'>$precio$</span>
    $borrar
    ";
    if($existencias <= 0){echo $surtir_boton;}else{echo "<span class='caja'></span>";}
        }
        ?>
    </div>
</div>

</html>