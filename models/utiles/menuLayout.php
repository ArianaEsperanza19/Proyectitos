<?php
require_once "./models/ModeloDB.php";
class menuLayout
{
    public static function desplegar()
    {
        $db = new ModeloDB();
        $categorias = $db->conseguirTodos('categorias');
        return $categorias;
    }
}
?>