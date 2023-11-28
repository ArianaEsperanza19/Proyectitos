<?php
require_once "ObtenerProductosCliente.php";
class IngresarProducto
{
    /*La presente funcion permite ingresar un nuevo producto en el pedido de un cliente.
    Variables:
    $id_cliente -> id del cliente
    $pedido -> Un arreglo con el pedido. Se espera que tenga el id del producto y la cantidad pedida.
    $conexion -> Conexion para ingresar a la base de datos.
    */
    protected static $Nuevo_pedido;
    protected static $id_cliente;
    protected static $conexion;

    public static function set_conexion($BD)
    {
        self::$conexion = $BD;
    }
    public static function get_conexion()
    {
        return self::$conexion;
    }
    public static function setIdCliente($id)
    {
        self::$id_cliente = $id;
    }

    public static function getIdCliente()
    {
        return self::$id_cliente;
    }

    public static function set_nuevoPedido($pedido)
    {
        self::$Nuevo_pedido = $pedido;
    }

    public static function get_nuevoPedido()
    {
        return self::$Nuevo_pedido;
    }
    public static function ingresarProducto()
    {   
        ObtenerProductosCliente::setIdCliente(self::$id_cliente);
        ObtenerProductosCliente::set_conexion(self::$conexion);
        $pedido_cliente_bruto = ObtenerProductosCliente::ObtenerProductos();
        $pedido_cliente_arreglo_para_DB = json_decode($pedido_cliente_bruto);
        //echo "<pre>";print_r($pedido_cliente);echo "</pre>";

        $centinela = false; //Mientras sea falso, significa que el producto no esta en el arreglo

        foreach ($pedido_cliente_arreglo_para_DB as $valor) {
            if ($valor->producto == self::$Nuevo_pedido['producto']) {
                $valor->cantidad += self::$Nuevo_pedido['cantidad'];
                $centinela = true; //Significa que el producto ya esta en el arreglo
            }
        }



        if ($centinela === false) {
            array_push($pedido_cliente_arreglo_para_DB, self::$Nuevo_pedido);
        }
        //echo "<pre>";print_r($pedido_cliente_arreglo_para_DB);echo "</pre>";
        $actualizacion = json_encode($pedido_cliente_arreglo_para_DB);
        $actualizacion = str_replace('"', "\"", $actualizacion);
        $id = self::$id_cliente;
        $sql = "UPDATE CLIENTES SET pedido='$actualizacion' WHERE id='$id';";
        self::$conexion->ejecutar($sql);
        self::$conexion->cerrar();
    }
}
