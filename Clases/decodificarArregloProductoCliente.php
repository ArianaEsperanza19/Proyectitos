<?php
class decodificarArregloProductoCliente
{
    /*
  La presente funcion recibe un objeto json con el pedido del 
  cliente (id del producto, la cantidad)
  lo procesa y devuelve un arreglo con la id, nombre, cantidad, precio_venta, costo y existencias.
  Variables:
  $json -> json con el pedido del cliente.
  $conexion -> conexion para ingresar a la base de datos.
  */
    protected static $json;
    protected static $conexion;

    public static function set_conexion($BD)
    {
        self::$conexion = $BD;
    }
    public static function get_conexion()
    {
        return self::$conexion;
    }
    public static function set_json($j)
    {
        self::$json = $j;
    }
    public static function get_json()
    {
        return self::$json;
    }
    public static function decodificar()
    {
        $json = json_decode(self::$json);
        $pedidos = [];
        //echo "<pre>";print_r($json);echo "</pre>";
        foreach ($json as $p) {
            $cantidad = $p->cantidad;
            $id = $p->producto;
            $nombre = "";
            $sql = "SELECT * FROM PRODUCTOS WHERE id=$id";
            $data = self::$conexion->consultar($sql);
            if ($data != null) {
                $nombre = $data[0]['nombre'];
                $precio = $data[0]['precio'];
                $costo = $data[0]['costo_pack'];
                $existencias = $data[0]['existencias'];
                $indice =
                    [
                        'id' => $id,
                        'nombre' => $nombre,
                        'cantidad' => $cantidad,
                        'precio_venta' => $precio,
                        'costo' => $costo,
                        'existencias' => $existencias
                    ];
                array_push($pedidos, $indice);
            }
        }
        //echo "<pre>";print_r($pedidos);echo "</pre>";
        return $pedidos;
    }
}
