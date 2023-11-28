<?php
require_once ("../conexion/conexion.php");
if($_POST)
{
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
    $Mayor = isset($_POST['costoMayor']) ? $_POST["costoMayor"] : false; 
    $Detal = isset($_POST['precioDetal']) ? $_POST["precioDetal"] : false; 
    $Cantidad = isset($_POST['cantidad']) ? $_POST["cantidad"] : false;
    $Unidades = isset($_POST['unidades']) ? $_POST["unidades"] : false;
    $costoUnidad = $Mayor/$Unidades;
}

$Mayor = [
    "pack" => "$Mayor",
    "cantidad" => "$Cantidad",
    "unidadesXpack" => "$Unidades",
    "costoUnidad" => "$costoUnidad"
];
$Existencias = $Cantidad*$Unidades;
$Mayor = json_encode($Mayor);
$Mayor = str_replace('"', "\"", $Mayor);
$conexion = new Conexion();
$sql = "INSERT INTO PRODUCTOS(id, nombre, precio, costo_pack, existencias) VALUES(NULL, '$nombre', '$Detal', '$Mayor','$Existencias');";;
$conexion->ejecutar($sql);
$redireccion = "<script>window.location.href = '../Vistas/Panel-Productos.php'</script>;";
echo $redireccion;
?>