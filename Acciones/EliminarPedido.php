<?php 
require_once("../conexion/conexion.php");
require_once "../Clases/procesarDatosBrutosClientes.php";
//echo "Aqui se elimina el pedido";
if($_GET)
{
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    $conexion = new Conexion();
    $sql = "SELECT * FROM CLIENTES WHERE id=$id";
    $data = $conexion->consultar($sql);
    procesarDatosBrutosClientes::set_datos_Clientes($data);
    $data = procesarDatosBrutosClientes::procesarDatos();
    //$data = procesarDatosBrutosClientes($data);
    $data = $data[0];
    $nombre = $data['nombre'];
    $pedido = $data['pedido'];
    $fecha = $data['quincena'];
    $sql = "INSERT INTO registro_ventas (id_cliente, nombre, pedido, fecha) VALUES ($id, '$nombre', '$pedido', '$fecha');";
    $conexion->ejecutar($sql);
    $sql = "DELETE FROM CLIENTES WHERE id=$id";
    $conexion->ejecutar($sql);
    $conexion->cerrar();
    $redireccion = "<script>window.location.href = '../ventas.php'</script>;";
    echo $redireccion;
}
?>