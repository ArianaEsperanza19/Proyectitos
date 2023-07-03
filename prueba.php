<?php 
require_once __DIR__ . "/BD/conexion.php";
$conexion = new Conexion();
require_once("claseUsuario.php");
require_once("ModelarDatos.php");

$Mauricio = new Usuario(2,'Mauricio','Hernandez','MariHernandez@gmail.com','HHHH1421_a');

//$datos = $Mauricio->datos($conexion);
//var_dump($datos);

$usuario = new Usuario(12);
$datos = $usuario->entradas($conexion);
//"<pre>"; print_r($datos[0]['id']);echo "</pre>";

$usuario = new Usuario(3);
$registros = $usuario->Entradas($Objeto_conexion);
//var_dump($registros);

foreach($registros as $registro){

    $entrada = DesglosarEntrada($registro, $conexion);
    echo "<h1>".$entrada['Titulo']."</h1>";
    echo "<p>".$entrada['Contenido']."</p>";
    echo $entrada['Imagen'];
    echo "Autor: ".$entrada['Usuario']." | ";
    echo "Categoria: ".$entrada['Categoria']." | ";
    echo "Fecha de publicacion: ".$entrada['Fecha']."<br>";
}

//$usuario->CrearEntrada("El nuevo juego de la saga Avatar: Frontiers of Pandora", 3, "Xsadsadasdasa", "2023-06-16", "Avatar.webp", $conexion);

?>