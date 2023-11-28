<?php

class procesarDatosBrutosClientes
{
    //Clase que procesa los datos de los clientes.
    //Variable: Los datos en bruto recien salidos de la base de datos mysql.
    protected static $clientes;

    public static function set_datos_Clientes($cliente)
    {
        self::$clientes = $cliente;
    }

    public static function get_datos_Clientes()
    {
        return self::$clientes;
    }

    public static function procesarDatos()
    {
        $respuesta = [];
        $centinela = false;
        foreach (self::$clientes as $cliente) {
            //echo "<pre>";print_r($clientes);echo "</pre>";
            if (!is_array($cliente)) {
                $centinela = true;
                break;
            } else {
                $arr =
                    [
                        'id' => $cliente['id'],
                        'nombre' => $cliente['nombre'],
                        'pedido' => $cliente['pedido'],
                        'fecha' => $cliente['fecha'],
                        'quincena' => $cliente['quincena']
                    ];

                array_push($respuesta, $arr);
            }
        }

        if ($centinela === true) {
            $arr =
                [
                    'id' => self::$clientes['id'],
                    'nombre' => self::$clientes['nombre'],
                    'pedido' => self::$clientes['pedido'],
                    'fecha' => self::$clientes['fecha'],
                    'quincena' => self::$clientes['quincena']
                ];
            array_push($respuesta, $arr);
        }

        return $respuesta;
    }
}
