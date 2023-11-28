<?php

class ObtenerProductosCliente
{
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
    public static function ObtenerProductos()
    {
        $id = self::$id_cliente;
        $sql = "SELECT pedido FROM CLIENTES WHERE id=$id;";
        $registro_productos = self::$conexion->consultar($sql);
        //echo "<pre>";print_r($registro_productos[0]['pedido']);echo "</pre>";

        return $registro_productos[0]['pedido'];
    }
}
