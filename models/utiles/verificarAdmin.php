<?php
class verificarAdmin
{
    public static function verificar()
    {   
        $centinela = null;
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            $centinela = true;
        }else{
            $centinela = false;
        }
        return $centinela;
    }
}
