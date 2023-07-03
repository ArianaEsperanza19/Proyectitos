<?php
require_once("crear.php");

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

foreach($errores as $error){
    echo "
    <div class='mensajes'>
    <ul style='list-style: none;'>
    <li>-$error</li>
    </ul>
    </div>
    ";
    
}
