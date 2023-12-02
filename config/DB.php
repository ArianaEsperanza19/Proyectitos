<?php
class DB{
    public static function Connect(){
        $conexion = new PDO("mysql:host=localhost;dbname=digitienda", "root", "");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$conexion = new mysqli("localhost", "root", "", "digitienda");
		$conexion->query("SET NAMES 'utf8'");
		
		return $conexion;
    }
}
?>