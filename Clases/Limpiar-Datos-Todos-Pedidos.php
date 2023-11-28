<?php
class LimpiarDatosTodosPedidos
{
    /*La presente funcion recibe un arreglo de id en bruto extraido de la BD mysql,
    obtiene los pedidos de cada cliente para luego hacer una consulta a la base de datos
    y verificar si las id de cada producto pedido por un cliente, existe en la BD, si no existe
    se crea un nuevo arreglo excluyendo los productos cuya id no exista.
    Finalmente se actualiza la base de datos, sustituyendo los los objeto json guardados en pedido,
    por la nueva version.
    variables:
    $id_clientes -> El arreglo de id de los clientes.
    $conexion -> una conexion para ingresar a la base de datos mysql
    */
    protected static $id_clientes;
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
        self::$id_clientes = $id;
    }

    public static function getIdCliente()
    {
        return self::$id_clientes;
    }
    public static function LimpiarDatosTodosPedidos()
    {
        foreach (self::$id_clientes as $id) {
            $Limpiar = [];
            $id = $id['id'];
            $sql = "SELECT pedido FROM CLIENTES WHERE id=$id;";
            $pedido = self::$conexion->consultar($sql);
            $pedido = $pedido[0]['pedido'];
            $pedido = json_decode($pedido);

            //echo "<pre>";print_r($info->producto);echo "</pre>";
            //echo "<pre>";print_r($info);echo "</pre>";

            foreach ($pedido as $info) {
                $arr = $info->producto;

                $sql = "SELECT id FROM PRODUCTOS WHERE id=$arr;";
                $consulta = self::$conexion->consultar($sql);
                if ($consulta == null) {
                    array_push($Limpiar, $arr);
                }
            }
            foreach ($Limpiar as $elemento) {

                for ($i = count($pedido) - 1; $i >= 0; $i--) {
                    $producto = $pedido[$i]->producto;
                    #echo "<pre>";
                    #print_r("Elemento del pedido: " . $producto . " Elemento a eliminar:" . $elemento);
                    #echo "<pre>";
                    if (in_array($producto, $Limpiar)) {
                        unset($pedido[$i]);
                        //echo "Elemento eliminado del índice $i<br>";
                    }
                }
                $pedido = array_values($pedido);
            }

            $pedido = json_encode($pedido);
            $sql = "UPDATE CLIENTES SET pedido = '$pedido' WHERE id=$id;";
            //echo "<pre>";print_r($pedido);echo "</pre>";
            self::$conexion->ejecutar($sql);
        }
    }
}