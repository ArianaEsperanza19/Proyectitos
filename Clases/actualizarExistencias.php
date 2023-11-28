<?php
class actualizarExistencias
{
    protected static $id_producto;
    protected static $cantidad;
    protected static $conexion;
    public static function set_conexion($BD)
    {
        self::$conexion = $BD;
    }
    public static function get_conexion()
    {
        return self::$conexion;
    }
    public static function set_cantidad($cantidad)
    {
        self::$cantidad = $cantidad;
    }
    public static function get_cantidad()
    {
        return self::$cantidad;
    }
    public static function set_idProducto($id)
    {
        self::$id_producto = $id;
    }
    public static function get_idProducto()
    {
        return self::$id_producto;
    }
    public static function actualizar()
    {
        $id = self::$id_producto;
        $sql = "SELECT existencias FROM productos WHERE id='$id'";
        $existencias = self::$conexion->consultar($sql);
        $existencias = $existencias[0][0];
        $actualizacion = $existencias - self::$cantidad;
        $sql = "UPDATE productos SET existencias='$actualizacion' WHERE id='$id'";
        self::$conexion->ejecutar($sql);
    }
}
