<?php
require_once "decodificarArregloProductoCliente.php";
class ganancia
{
    //la presente funcion comprueba si un cliente tiene un producto dado y cuanto dinero se gana con dicho producto.
    //Parametros: id del producto, id del cliente, conexion.
    //Se necesita la funcion decodificarArregloProductoCliente($json, $conexion)
    //Salida: ganancia recibida del cliente en numeros.
    protected static $producto_id;
    protected static $cliente;
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
        self::$cliente = $id;
    }

    public static function getIdCliente()
    {
        return self::$cliente;
    }

    public static function set_id_producto($id)
    {
        self::$producto_id = $id;
    }
    public static function get_id_producto()
    {
        return self::$producto_id;
    }
    public static function Calcular_ganancia()
    {
        $ganancia = 0;
        $id = self::$cliente;
        $sql = "SELECT pedido FROM CLIENTES WHERE id=$id";
        $consulta = self::$conexion->consultar($sql);
        foreach ($consulta as $producto) {
            decodificarArregloProductoCliente::set_conexion(self::$conexion);
            decodificarArregloProductoCliente::set_json($producto['pedido']);
            $pedido = decodificarArregloProductoCliente::decodificar();
        }

        foreach ($pedido as $producto) {

            if ($producto['id'] == self::$producto_id) {
                $ganancia = $producto['cantidad'] * $producto['precio_venta'];
            }
        }

        //echo "<pre>";print_r($ganancia);echo "</pre>"; 
        return $ganancia;
    }
}
