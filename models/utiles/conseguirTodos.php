<?php
require_once './config/DB.php';
class conseguirTodos{
	public $conexion;
	
	public function __construct() {
		$this->conexion = DB::Connect();
	}
	
	public function conseguirTodos($tabla, $order_by = 'ASC'){
		$query = $this->conexion->prepare("SELECT * FROM $tabla ORDER BY id $order_by");
        $query->execute();
		$datos = $query->fetchAll();
		$this->conexion = NULL;
        return $datos;
	}
}
