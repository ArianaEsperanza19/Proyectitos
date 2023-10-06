<?php
require_once("cabecera.php");
if(!isset($_SESSION)){
    session_start();
}



//echo "<script>swal('Atencion','Eliminacion de usuario abortada', 'error');</script>";
//echo "<script>swal('Atencion','Usuario modificado con exito', 'success');</script>";
//echo "<script>swal('Perfecto','Se ha eliminado el usuario', 'success');</script>";


if($_POST){
    $b = isset($_POST['buscar_usuarios']) ? $_POST['buscar_usuarios'] : false;
    header("location: filtro_admin_user.php?busqueda=$b");
}



$sql = "SELECT * FROM usuarios;";
$usuarios = $Objeto_conexion->consultar($sql);
$nombre = NULL;
$apellido = NULL;
$id = NULL;
//echo "<pre>"; print_r($resultados); echo "</pre>";

echo '<form action="Admin_usuarios.php" method="POST" style="text-align: center"><input required type="text" name="buscar_usuarios" placeholder="Ingrese nombre, apellido, email o id..." style="width: 250px" /><input type="submit"  value="Ir" class="button" style="padding: 3px 10px; font-size: 12px; margin-left: 5px"/></form>';
echo "<h2 style='text-align: center; margin: 0% auto; margin: 30px;'>Usuarios registrados en el sistema</h2>";
foreach ($usuarios as $u) {
    $nombre = $u['nombres'];
    $apellido = $u['apellidos'];
    $id = $u['id'];
    if($id != $_SESSION['admin']){
    //USUARIOS DATOS
    echo "<div class='formularios' style='width: 350px; height: 20px;text-align: center;'>
    <div style='text-align: left;'>
    $id|$nombre|$apellido
    </div>
    <div style='width: 50%; margin-left: 180px;text-align: right; position: relative; bottom: 20px; right: 10px'> ";
    //Boton ELIMINAR
    echo "<a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px;margin-right: 5px; background-color: red'; href='confirmacion.php?eliminar=3&id=$id'>Eliminar</a>|";
    //Boton Editar
    echo "<a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;' href='usuario_datos.php?id=$id'>Editar</a>";
    //CERRAR DIVS
    echo "
    </div></div><br>";
}}

?>

<?php
require_once("pie.php"); 
$Objeto_conexion->cerrar();?>