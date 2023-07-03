<?php
require_once("login.php");
$errores = [];


if($user == ""){
    array_push($errores,"Introduzca el usuario.");
}
if($user != "" && strpos($user,"@") === false){
    array_push($errores,"Usuario introducido no valido.");
}
if($pass == ""){
    array_push($errores,"La contraseña no puede estar vacia.");
}

if($errores != null){

echo "<div style='border: solid 1px red;'>";
foreach($errores as $error){
    echo "
    <div class='mensajes'>
    <ul style='list-style: none;'>
    <li>• $error</li>
    </ul>
    </div>
    ";
    
}
echo "</div>";
}
