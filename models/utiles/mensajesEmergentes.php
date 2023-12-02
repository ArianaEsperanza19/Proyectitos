<?php
class mensajesEmergentes
{
    public static function borrar()
    {
        if (isset($_SESSION['borrado'])) {
            require_once('./models/utiles/borrarSession.php');
            echo  "<strong><snag style='color:green'>• Borrado completado con exito</snag></strong>";
            borrarSession::borrar('borrado');
          }
          if (isset($_SESSION["borrado"]) && $_SESSION['borrado'] == false) {
            require_once('./models/utiles/borrarSession.php');
            echo  "<strong><snag style='color:red'>• Error al borrar</snag></strong>";
            borrarSession::borrar('borrado');
          }
    }
    public static function editar()
    {
        if (isset($_SESSION['edicion'])) :
            require_once('./models/utiles/borrarSession.php');
            if ($_SESSION['edicion']  == "completed") :
              echo  "<strong><snag style='color:green'>• Registro editado con exito</snag></strong>";
              borrarSession::borrar('edicion');
            else :
              if ($_SESSION['edicion']  == "failed") :
                echo  "<strong><snag style='color:red'>• Edicion fallida, verifica los datos</snag></strong>";
                borrarSession::borrar('edicion');
              endif;
            endif;
          
          endif;
    }
    public static function guardado()
    {
        if (isset($_SESSION['register'])) :
            require_once('./models/utiles/borrarSession.php');
            if ($_SESSION['register']  == "completed") :
                echo  "<strong><snag style='color:green'>• Registro completado con exito</snag></strong>";
                borrarSession::borrar('register');
            else :
                if ($_SESSION['register']  == "failed") :
                    echo  "<strong><snag style='color:red'>• Registro no guardado, verifica los datos</snag></strong>";
                    borrarSession::borrar('register');
                endif;
            endif;

        endif;
    }
}