<?php
//VISTA DONDE SE HACE UNA CONSULTA SQL Y SE MOSTRARAN LOS CLIENTES EN LA FICHA clientesDatos.php QUE SE ALOJA EN LA CARPETA 'VISTAS'  
require_once("conexion/conexion.php");
require_once("Clases/procesarDatosBrutosClientes.php");

$sql = "SELECT * FROM CLIENTES";
$conexion = new Conexion();
$datos_clientes = $conexion->consultar($sql);

if($datos_clientes != null)
{
  procesarDatosBrutosClientes::set_datos_Clientes($datos_clientes);
  $clientes = procesarDatosBrutosClientes::procesarDatos();
}

//echo "<pre>";print_r($clientes);echo "</pre>";



require_once("Vistas/clientesDatos.php");
?>

