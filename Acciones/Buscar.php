<?php
require_once "../conexion/conexion.php";
require_once "../Clases/procesarDatosBrutosClientes.php";
//echo "Hola, este es el buscador.";
if(isset($_POST['busqueda']))
{   $entrada = $_POST['busqueda'];
    //echo "Enviaste ".$entrada;
    $input = "%" . $_POST['busqueda'] . "%";
    $conexion = new Conexion();
    $sql = "SELECT id FROM CLIENTES WHERE nombre LIKE '$input'";
    $busqueda = $conexion->consultar($sql);
    $ids = [];
    if($busqueda != NULL)
    {
        foreach ($busqueda as $c) {
            array_push($ids, $c['id']);
        }
    }
    $sql = "SELECT id FROM CLIENTES WHERE id LIKE '$input'";
    $busqueda = $conexion->consultar($sql);
    if($busqueda != NULL)
    {
        foreach ($busqueda as $c) {
            array_push($ids, $c['id']);
        }
    }
    $ids = array_unique($ids);
    //echo "<pre>";print_r($ids);echo "</pre>";
    $clientes = [];

    foreach($ids as $id)
    {
        $sql = "SELECT * FROM CLIENTES WHERE id=$id;";
        $datos = $conexion->consultar($sql);
        array_push($clientes, $datos[0]);
    }

    $salida = [];//OJO
    foreach($clientes as $cliente)
    {
        procesarDatosBrutosClientes::set_datos_Clientes($cliente);
        $DatosProcesados = procesarDatosBrutosClientes::procesarDatos();
        //echo "<pre>";print_r($DatosProcesados);echo "</pre>";
        array_push($salida,$DatosProcesados[0]);
    }
    //$datos = procesarDatosBrutosClientes($clientes);
    //$datos = array_unique($datos);
    //echo "<pre>";print_r($salida);echo "</pre>";
    $conexion->cerrar();
    if($salida == null)
    {
        header("Location: ../ventas.php");
    }
}

require_once "../Vistas/Resultados-Busqueda.php";
//echo $redireccion;
?>
