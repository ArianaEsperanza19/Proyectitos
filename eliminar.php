<?php
require_once("ManipulacionDatos.php");
require_once("cabecera.php");

$entrada = null;
if(isset($_GET['entrada'])){
    $entrada = $_GET['entrada'];
    //var_dump($entrada);
    EliminarEntrada($entrada, $Objeto_conexion);
}


if(isset($_GET['user'])){
    $id = $_GET['user'];
    EliminarUsuario($id, $Objeto_conexion);
}

//
