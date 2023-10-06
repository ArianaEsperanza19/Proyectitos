<?php
require_once("cabecera.php");


$id = NULL;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$nom = NULL;
$ape = NULL;
$em = NULL;
$pass = NULL;
$id_user = NULL;
if ($_POST) {
    $nom = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $ape = isset($_POST['apellido']) ? $_POST['apellido'] : false;
    $em = isset($_POST['email']) ? $_POST['email'] : false;
    $pass = isset($_POST['contraseña']) ? $_POST['contraseña'] : false;
    $sql = "UPDATE usuarios SET nombres='$nom', apellidos='$ape', email='$em', contrasenya='$pass' WHERE id=$id;";
    $Objeto_conexion->ejecutar($sql);
    header('location: Admin_usuarios.php?signal=7');
}




$sql = "SELECT * FROM usuarios WHERE id=$id";
$usuarios = $Objeto_conexion->consultar($sql);
//echo "<pre>"; print_r($usuarios); echo "</pre>";







?>


<div>
    <form method="POST" action='<?php echo "usuario_datos.php?id=$id"; ?>' name="user" style="width: 300px; height: 280px; border: solid 1px rgb(103, 106, 255); margin-left: auto; margin-right: auto; margin-top: 30px">
        <?php foreach ($usuarios as $usuario) { ?>
            <h3 style='text-align:center; position: relative; top: 5%'>Editar Usuario</h3>
            <h2 style='text-align:center; position: relative; top: 5%'><?php echo $usuario['nombres'] . " " . $usuario['apellidos']; ?></h2>
            <div style="text-align: left; width: 80px; margin-left: auto; margin-right: 60%; position:relative; top: 15%;">
                <label>Nombre</label><br>
                <label>Apellido</label><br>
                <label>Email</label><br>
                <label>Contraseña</label><br>
                <label>ID</label><br>
            </div>





            <div style="text-align: right; width: 220px; margin-left:auto; margin-right: auto; padding: 10px; padding-bottom: 10px; position:relative; bottom: 25%">

                <input type="text" name="nombre" value="<?php echo $usuario['nombres']; ?>"><br>
                <input type="text" name="apellido" value="<?php echo $usuario['apellidos']; ?>"><br>
                <input type="email" name="email" value="<?php echo $usuario['email']; ?>"><br>
                <input type="text" name="contraseña" value="<?php echo $usuario['contrasenya']; ?>"><br>
                <input type="text" name="id" value="<?php echo $usuario['id']; ?>" readonly><br>


                <div style="margin-top: 25px; margin-right: auto; margin-left: auto; text-align: center;">
                    <input type="submit" value="Guardar" class='button' style='padding: 10px 30px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;'>
                    <a class="button" href="Admin_usuarios.php" style='padding: 10px 30px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;'>Volver</a>
                </div>
            </div>
        <?php } 
        $Objeto_conexion->cerrar();?>
    </form>

</div>