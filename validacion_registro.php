<?php
require_once("registrarse.php");
require_once __DIR__ . "/BD/conexion.php";
$Objeto_conexion = new Conexion();
$sql = "SELECT email FROM usuarios;";
$emails = $Objeto_conexion->consultar($sql);
//echo "<pre>";print_r($emails);echo "</pre>";

$errores = [];

// Validacion de nombre
if ($n === "") {
    array_push($errores, "El nombre no puede estar vacio.");
}


// Validacion de apellido
if ($s === "") {
    array_push($errores, "El apellido no puede estar vacio.");
}


if ($s === "" && $n === "") {
    $errores = [];
    array_push($errores, "El nombre y apellido no pueden estar vacios.");
}

// Validacion de Email
if ($e == "") {
    array_push($errores, "Se necesita el correo electronico.");
}

$centinela = false;
foreach ($emails as $email) {
    if($e == $email['email']){
        $centinela = true;
    }
    if($centinela == true){
        array_push($errores, "Email ya registrado en la base de datos.");
        break;
    }    
}

if ($e != "" && strpos($e, "@") === false) {
    array_push($errores, "Introduzca una direccion de correo electronico validas.");
}

// Validacion de contrase;a
if ($p == "") {
    array_push($errores, "La contraseña no puede estar vacia.");
}
if ($p != "" && strlen($p) < 6) {
    array_push($errores, "La contraseña debe ser mayor a seis caracteres.");
}
if(!preg_match("/[A-Z]/", $p)){
    array_push($errores, "La contraseña debe tener al menos una mayúscula.");
}
if(!preg_match("/\d/", $p)){
    array_push($errores, "La contraseña debe tener al menos un numero.");
}

// Validacion de contrase;a repetida
if ($p2 == "") {
    array_push($errores, "Debe repetir la contraseña.");
}
if ($p != $p2) {
    array_push($errores, "Las contraseñas no coinciden.");
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
    echo "</div><br>";
    }
