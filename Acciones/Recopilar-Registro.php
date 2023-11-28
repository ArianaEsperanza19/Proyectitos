<?php
require_once("../conexion/conexion.php");
require_once("../Clases/decodificarJsonLimpio.php");


$sql = "SELECT * FROM registro_ventas;";
$conexion = new Conexion();//POR CERRAR
$registros = $conexion->consultar($sql);

require_once("../Vistas/Recopilacion-de-Registros.php");
