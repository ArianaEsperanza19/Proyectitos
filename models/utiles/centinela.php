<?php
class centinela
{
    public static function verificar($datos_session)
    {
        $contador = 0;
        $centinela = false;
        foreach($datos_session as $d){
            if(is_object($d)){
                $contador += 1;
            }
        }
        
        if($contador == 1){
            $centinela = true;
        }
        
        return $centinela;
}
}

?>