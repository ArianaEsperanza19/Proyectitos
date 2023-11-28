<?php
require_once "../conexion/conexion.php";
require_once("../Clases/decodificarJsonLimpio.php");

if($_POST){
    $fecha_inicial = isset($_POST['fecha_inicial']) ? $_POST['fecha_inicial'] : false;
    $fecha_final = isset($_POST['fecha_final']) ? $_POST['fecha_final'] : false;
    $sql = "SELECT * FROM registro_ventas WHERE fecha BETWEEN '$fecha_inicial' AND '$fecha_final';";
    $conexion = new Conexion();
    $registros = $conexion->consultar($sql);
}

require_once "../Vistas/Registros-filtrados.php";
?>