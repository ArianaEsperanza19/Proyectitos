<?php

require_once 'utiles/conseguirTodos.php';
require_once 'ModeloDB.php';

class Categoria extends conseguirTodos{
	private $nombre;
	
	public function __construct() {
		$this->conexion = DB::Connect();
	}
	
	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($nombre) {
		require_once 'models/utiles/escaparDatos.php';
		$nombre = escaparDatos::escapar($nombre);
		$this->nombre = $nombre;
	}

	public function listarTodos(){
		//Obtiene un arreglo con todas las categorias en el sistema.
		//Salida: Devuelve un arreglo PDO con el que sera necesario trabajar para obtener los datos.
		//Nota: Atencion, es necesario que esta clase herede de la clase conseguirTodos, para funcionar.
		$listado = $this->conseguirTodos("categorias");
        return $listado;
	}

	public function listarFiltrados($categoria){
		//Lista los productos de una categoria determinada, establecida por parametro.
		//Salida: Devuelve un arreglo PDO con el que sera necesario trabajar.
		$db = new ModeloDB();
		$filtrados = $db->conseguir('productos', '*', "categoria_id=$categoria");
		$db->cerrar();
		return $filtrados;
	}

    public function guardar(){
		//El presente metodo guarda en la DB los datos de la categoria que se tengan almacenados en este objeto.
		//Salida: Devolvera una variable que indicara si la operacion fue exitosa o no.
		//Nota: Atencion, sin acceso al objeto ModeloDB no se podra realizar las operaciones.
		$db = new ModeloDB;
		$n = $this->nombre;
		$sql = "INSERT INTO categorias (nombre) VALUES ('$n');";
		$resultado = $db->ejecutar($sql);
		$db->cerrar();
		return $resultado;
	}

	public function borrar($id){
		/*
		El presente metodo borra el registro una categoria.
		Variable: id-> Numero la categoria en cuestion.
		Nota: Atencion, sin acceso al objeto ModeloDB no se podra realizar las operaciones.
		Salida: Devolvera una variable que indicara si la operacion fue exitosa o no.
		*/
		$db = new ModeloDB();
		$sql = "DELETE FROM categorias WHERE id=$id";
		$resultado = $db->ejecutar($sql);
		$db->cerrar();
		return $resultado;
	}

	public function actualizarRegistro($id){
		/*
		Actualiza una de las categorias, modificando uno o varios de sus campos.
		Variables:
		id-> Identificador de la categoria a editar.
		Nota: Atencion, sin acceso al objeto ModeloDB, encargado de gestionar la DB, no se podra realizar las operaciones.
		Salida: Devolvera una variable que indicara si la operacion fue exitosa o no.
		*/
		$n = $this->nombre;
		$db = new ModeloDB();
		$sql = "UPDATE categorias SET 
			nombre = '$n'
			WHERE id = $id;";
		$resultado = $db->ejecutar($sql);
		return $resultado;
	}

	}