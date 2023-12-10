<?php
Class JsonManager{
    /*
    La presente clase recibe un objeto json para ser decodificado y entregado como un OBJETO.
    Tener en cuenta que si el arreglo solo posee un elemento, hay que verificar los indices, es posible que
    la informacion sea accesible mediante json[0]. 
    Variable:
    $json -> Recibe un string limpio en formato json.
    */
    protected static $json;
    public static function set_json($j)
    {
        self::$json = $j;
    }
    public static function get_json()
    {
        return self::$json;
    }
    public static function decodificar(){
        $elemento = json_decode(self::$json);
        //echo "<pre>";print_r($elemento); echo "</pre>";
        return $elemento;
    }

    public static function codificar(){
        $elemento = json_encode(self::$json);
        return $elemento;
    }
}
?>