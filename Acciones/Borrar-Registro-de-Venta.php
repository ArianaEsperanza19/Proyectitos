<?php
require_once("../conexion/conexion.php");

if($_GET){
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $conexion = new Conexion();
    $sql = "DELETE FROM registro_ventas WHERE id_cliente=$id";
    $conexion->ejecutar($sql);
    $conexion->cerrar();
    $redireccion = "<script>window.location.href = '../Acciones/Recopilar-Registro.php'</script>;";
    echo $redireccion;
}
?>