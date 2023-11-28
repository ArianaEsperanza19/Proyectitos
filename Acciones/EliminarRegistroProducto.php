<?php
require_once "../conexion/conexion.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conexion = new Conexion();
    $sql = "DELETE FROM PRODUCTOS WHERE id=$id";
    $conexion->ejecutar($sql);
    $conexion->cerrar();

}

$redireccion = "<script>window.location.href = '../Vistas/Panel-Productos.php'</script>;";
echo $redireccion;
?>