<?php
if(!isset($_SESSION)){
    session_start();
}
require_once("cabecera.php");

# entrada creada con exito
# entradas eliminadas permanentemente
# eliminacion abortada no_eliminar
# Se ha restaurado la entrada con exito restaurar

//echo "<script>swal('Perfecto','Entradas eliminadas de forma permanente', 'success');</script>";
//echo "<script>swal('Perfecto','Entradas eliminadas de forma permanente', 'success');</script>";
//echo "<script>swal('Atencion','Eliminacion abortada', 'error');</script>";
//echo "<script>swal('Perfecto','Se ha restaurado la entrada con exito', 'success');</script>";




$sql = "SELECT * FROM entradas WHERE papelera=TRUE;";
$post = $Objeto_conexion->consultar($sql);
$botonRojo = "
<a class='button' 
style='width: 170px; padding: 8px 20px; font-size: 16px; margin-bottom: 5px; margin-left: 5px; background-color: red;' href='Papelera.php'>
Papelera de Entradas</a>
";
?>
<div id="Panel_user">
    <h1>Bienvenido usuario <?php echo $_SESSION['user']; ?></h1>
    <br>
    <a class="buttonUSER" href='ver.php'>Ver Entradas</a><br>
    <a class="buttonUSER" href='crear.php'>Crear Entrada</a><br>
    <?php if (isset($_SESSION['idUser']) == $_SESSION['admin']) {
        echo "<a class='buttonUSER' href='editarC.php'>Editar Categorias</a>";
    } ?><br>
    <?php if (isset($_SESSION['idUser']) == $_SESSION['admin']) {
        echo "<a class='buttonUSER' href='Admin_usuarios.php'>Lista de Usuarios</a>";
    } ?><br>
    <?php if (isset($_SESSION['idUser']) == $_SESSION['admin'] && $post != NULL) {
        echo $botonRojo;
    } 
    $Objeto_conexion->cerrar();
    ?><br>
</div>