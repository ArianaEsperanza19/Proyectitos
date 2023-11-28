<?php
require_once "../Clases/surtir.php";
require_once "../conexion/conexion.php";

if($_GET){
    $id = isset($_GET["id"]) ? $_GET["id"] : false;
    $conexion = new Conexion();
    Surtir::set_conexion($conexion);
    Surtir::set_id_producto($id);
    Surtir::Surtir();
}
?>