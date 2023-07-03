<?php
if(!isset($_SESSION)){
    session_start();
}
require_once("cabecera.php");

if (isset($_GET)) {
    $eliminar = $_GET['eliminar'];
    if(isset($_GET['entrada'])){
        $id = $_GET['entrada'];    
    }else{
        $id = @$_GET['id'];    
    }
}


//1 BORRAR TODO
//2 BORRAR ENTRADA
//3 BORRAR USUARIO
switch ($eliminar) {
        //VACIAR PAPELERA
    case 1:
        #echo "CON 1 se VACIA la papelera";
        echo '
        <div class="formularios" style="width: 400px; height: 200px;">
        <div style="padding:30px">
        <h2 style="margin-bottom:10px; text-align: center;">¿Está seguro de que quiere eliminar PERMANENTEMENTE las entradas?</h2>
        <a class="button" href="panel_usuario.php?signal=5" name="NO" value="NO" style="margin: 15px; background-color: green;">NO</a>
        <a class="button" href="Papelera.php?eliminar=1" name="SI" value="SI" style="margin: 15px; background-color: red;">SI</a>
        </div>
        </div>
            ';
        break;
        //BORRAR ENTRADA        
    case 2:
        #echo 'CON 2 Se quiere borrar una entrada';
        //echo $id;
        $_SESSION['cancelar'] = "si";
        echo "<div class='formularios' style='width: 400px; height: 200px;'>
        <div style='padding:30px'>
        <h2 style='margin-bottom:10px; text-align: center;'>¿Está seguro de que quiere eliminar esta entrada?</h2>
        <a class='button' href='ver.php?' name='NO' value='NO' style='margin: 15px; background-color: green;'>NO</a>
        <a class='button' href='eliminar.php?entrada=$id' name='SI' value='SI' style='margin: 15px; background-color: red;'>SI</a>
        </div>
        </div>";
        break;
        //BORRAR USUARIO
    case 3:
        #echo 'CON 3 Se quiere BORRAR UN USUARIO';
        echo $id;
        //Buscar nombre en base de datos

        $sql = "SELECT nombres, apellidos FROM usuarios WHERE id=$id";
        $usuario = $Objeto_conexion->consultar($sql);
        $n = $usuario[0]['nombres'];
        $a = $usuario[0]['apellidos'];
        $usuario = $n . " " . $a;
        //echo "<pre>";print_r($usuario);echo "</pre>";
        //die();
        echo "
        <div class='formularios' style='width: 400px; height: 200px;'>
        <div style='padding:30px'>
        <h2 style='margin-bottom:10px; text-align: center;'>¿Está seguro de que quiere eliminar al usuario #$id $usuario?</h2>
        <a class='button' href='Admin_usuarios.php?signal=6' name='NO' value='NO' style='margin: 15px; background-color: green;'>NO</a>
        <a class='button' href='eliminar.php?user=$id' name='SI' value='SI' style='margin: 15px; background-color: red;'>SI</a>
        </div>
        </div>";
        break;
}

?>







<?php
require_once("pie.php");
?>