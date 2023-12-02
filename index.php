<?php
session_start();
require_once 'autoload.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

#Comprobar si se llama un controlador por la url
if(@$_GET){
	if(isset($_GET['controller'])){
		$nombre_controlador = $_GET['controller'].'Controller'; //Se concatena Controller para formar el nombre completo del controlador
	}else{
		//echo "La pagina que buscas no existe";
		exit();
	}
	#Comprobar si la clase del controlador existe
	if(class_exists($nombre_controlador)){	
		$controlador = new $nombre_controlador();
		#Comprobar si el metodo llamado mediante 'action' en la url, existe en el controlador dado
		if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
			$action = $_GET['action'];
			$controlador->$action();
		}else{
			//echo "La pagina que buscas no existe";
		}
	}else{
		//echo "La pagina que buscas no existe";
	}
}else{
	header("Location: ?controller=Productos&action=index");
}
require_once 'views/layout/footer.php';
?>