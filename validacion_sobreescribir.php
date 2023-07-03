<?php
require_once("sobreescribir.php");


$errores = [];

if($t === ""){
    array_push($errores,"El titulo no puede estar vacio.");
}
if($c === ""){
    array_push($errores,"El contenido no puede estar vacio.");
}
if($cate === ""){
    array_push($errores,"Seleccione una categoria.");
}
$mensaje = null;
foreach($errores as $error){
    $mensaje += "• $error"."<br>";
}
//Problemas para transferir la informacion
?>