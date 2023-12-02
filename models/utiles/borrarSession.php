<?php
class borrarSession
{
    public static function borrar($nombre)
    {
        if (isset($_SESSION[$nombre])) {
            $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }
        return $nombre;
    }
}
