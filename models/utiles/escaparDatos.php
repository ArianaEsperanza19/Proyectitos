<?php
class escaparDatos
{
    public static function escapar($datos){
		//Escapa la informacion recibida para evitar fallos.
		$mysqli = new mysqli("localhost", "root", "", "digitienda");
		$mysqli->query("SET NAMES 'utf8'");
		$datos = $mysqli->real_escape_string($datos);
		$mysqli->close();
		return $datos;
	}
}
?>



