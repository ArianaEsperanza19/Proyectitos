<?php
class Surtir
{
    protected static $id_producto;
    protected static $conexion;

    public static function set_conexion($BD)
    {
        self::$conexion = $BD;
    }

    public static function get_conexion()
    {
        return self::$conexion;
    }

    public static function set_id_producto($id)
    {
        self::$id_producto = $id;
    }

    public static function get_id_producto()
    {
        return self::$id_producto;
    }

    public static function Surtir()
    {
        $id = self::$id_producto;
        $sql = "SELECT costo_pack FROM productos WHERE id=$id";
        $consulta = self::$conexion->consultar($sql);
        foreach ($consulta as $pack) {
            $pack = json_decode($pack['costo_pack']);
            $packCantidad = $pack->cantidad;
            $packUnidades = $pack->unidadesXpack;
            $surtir = $packCantidad * $packUnidades;
        }
        $sql = "UPDATE PRODUCTOS SET existencias = '$surtir' WHERE id=$id";
        self::$conexion->ejecutar($sql);
        self::$conexion->cerrar();
        $redireccion = "<script>window.location.href = '../Vistas/Panel-Productos.php'</script>;";
        echo $redireccion;
    }
}
