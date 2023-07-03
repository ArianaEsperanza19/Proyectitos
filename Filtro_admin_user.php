<?php
require_once('cabecera.php');

$busqueda = null;
$resultado_nombres = null;
$resultados = [];
if (!empty(isset($_GET['busqueda']))) {
    $busqueda = $_GET['busqueda'];
    if($busqueda != null){
        $sql = "SELECT id FROM usuarios WHERE nombres LIKE '%$busqueda%'";
    $resultado_nombres = $Objeto_conexion->consultar($sql);
    if ($resultado_nombres != null) {
        $resultado_nombres = $resultado_nombres[0]['id'];
        array_push($resultados, $resultado_nombres);
    }
    $sql = "SELECT id FROM usuarios WHERE apellidos LIKE '%$busqueda%'";
    $resultado_apellidos = $Objeto_conexion->consultar($sql);
    if ($resultado_apellidos != null) {
        $resultado_apellidos = $resultado_apellidos[0]['id'];
        array_push($resultados, $resultado_apellidos);
    }
    
    $patronLetras = "/[qwertyuiopasdfghjklzxcvbnm ]/";
    

    if (!preg_match($patronLetras, $busqueda)) {
        $n = $_GET['busqueda'];
        $sql = "SELECT * FROM usuarios WHERE id=$n";
        $resultado_id = $Objeto_conexion->consultar($sql);
        if ($resultado_id != null) {
            $resultado_id = $resultado_id[0]['id'];
            array_push($resultados, $resultado_id);
        }
    }


    $sql = "SELECT id FROM usuarios WHERE email LIKE '%$busqueda%'";
    $resultado_email = $Objeto_conexion->consultar($sql);
    if ($resultado_email != null) {
        foreach($resultado_email as $email){
            
            array_push($resultados, $email['id']);
        }
        
    }
    
    $resultados = array_unique($resultados);
    }        
    
}else{
    $resultados = "Rellena el buscador.";
}
//echo "<pre>"; print_r($resultados); echo "</pre>";



echo "<h2 style='text-align: center; margin-bottom:3%;'>Usuarios Encontrados |
<a style='margin-left:' href='Admin_usuarios.php' class='link'>| Volver a usuarios</a></h2>";
if($resultados == null){
    echo "<div style='color:red; text-align: center'>Sin resultados que coincidan con la busqueda</div>";
}
foreach($resultados as $usuarios){
    $sql = "SELECT * FROM usuarios WHERE id=$usuarios";
    $usuarios = $Objeto_conexion->consultar($sql);


foreach ($usuarios as $u) {
    $nombre = $u['nombres'];
    $apellido = $u['apellidos'];
    $id = $u['id'];
    //USUARIOS DATOS
    echo "<div class='formularios' style='width: 350px; height: 20px;text-align: center;'>
    <div style='text-align: left;'>
    $id|$nombre|$apellido
    </div>
    <div style='width: 50%; margin-left: 180px;text-align: right; position: relative; bottom: 20px; right: 10px'> ";
    //BOTONES DIV

    //Boton ELIMINAR
    echo "<a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px;margin-right: 5px; background-color: red'; href='confirmacion.php?eliminar=3&id=$id'>Eliminar</a>|";
    //Boton Editar
    echo "<a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;' href='usuario_datos.php?id=$id'>Editar</a>";
    //CERRAR DIVS
    echo "
    </div></div><br>";
}}
