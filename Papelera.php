<?php
require_once("ManipulacionDatos.php");
require_once("ModelarDatos.php");
require_once("cabecera.php");
if(!isset($_SESSION)){
    session_start();
}
if (isset($_GET['eliminar']) == 1) {
    VaciarPapelera($Objeto_conexion);
}


if (isset($_GET['restaurar']) == 1) {
    $id = $_GET['id'];
    RestaurarEntrada($id, $Objeto_conexion);
}


$sql = "SELECT * FROM entradas WHERE papelera = TRUE;";
$entradas = $Objeto_conexion->consultar($sql);
$titulo = NULL;
$user = NULL;
$id = NULL;
$id_user = NULL;
//echo "<pre>"; print_r($resultados); echo "</pre>";

echo "<h2 style='text-align: center; margin: 0% auto; margin: 30px;'>Entradas en la papelera</h2>";
    //BOTON PARA BORRAR TODO
echo "<div style='text-align: center; margin-bottom: 10px;'><a class='button' style='width: 170px; padding: 8px 20px; font-size: 16px; margin: 0 auto; background-color: red;' href='confirmacion.php?eliminar=1'>VACIAR PAPELERA</a></div>";
foreach ($entradas as $u) {
    $info = DesglosarEntrada($u, $Objeto_conexion);
    $id = $u['id'];
    $titulo = $info['Titulo'];
    $usuario = $info['Usuario'];
    echo "<div class='formularios' style='text-align: center; border: none'>";
    //ENTRADAS DATOS
    echo "<div class='formularios' style='width: 650px; height: 20px;text-align: center;'>
    <div style='text-align: left;'>
    $id|$titulo|$usuario
    </div>
    <div style='width: 50%; margin-left: 320px;text-align: right; position: relative; bottom: 20px; right: 10px'> ";
    //Boton Editar
    echo "<a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;' href='Papelera.php?restaurar=1&id=$id'>Restaurar</a>";
    //CERRAR DIVS
    echo "
    </div></div><br>";
}
?>