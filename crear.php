<?php
if(!isset($_SESSION)){
    session_start();
}
require_once(__DIR__ . '\cabecera.php');
require_once "claseUsuario.php";
$t = NULL;
$c = NULL;
$id = $_SESSION['idUser'];
$usuario = new Usuario($id);
$f = NULL;
$img = NULL;


$sql = "SELECT nombres FROM categorias;";
$categorias = $Objeto_conexion->consultar($sql);
if (@$_POST && @$_FILES['img']) {
    $t = isset($_POST['titulo']) ? $_POST['titulo'] : false;
    $c = isset($_POST['contenido']) ? $_POST['contenido'] : false;
    $cate = isset($_POST['categorias']) ? $_POST['categorias'] : false;
    $img = isset($_FILES['img']) ? $_FILES['img'] : false;
    $fecha = new DateTime();

    if ($img['name'] != NULL || $img == false) {
        $img = $fecha->getTimestamp() . '_' . $_FILES['img']['name']; //Recepciona el nombre del archivo que viene en el arreglo que se recibe
        $imagenTemporal = $_FILES['img']['tmp_name']; //Imagen temporal
        move_uploaded_file($imagenTemporal, "img/" . $img);
    } else {
        $img = NULL;
    }

    //Mueve el archivo recibido a la carpeta dada
    require_once(__DIR__ . '\validacion_crear.php');
    $sql = "SELECT id FROM categorias WHERE nombres = '$cate';";
    $idCategorias = $Objeto_conexion->consultar($sql);
    $categoriaEntrada = null;
    foreach ($idCategorias as $ca) {
        $categoriaEntrada = $ca;
    }
    $categoriaEntrada = $categoriaEntrada['id'];
    $sql = "SELECT CURDATE()";
    $f = $Objeto_conexion->consultar($sql);
    $f = $f[0]["CURDATE()"];
    if ($errores == NULL) {

        $usuario->CrearEntrada($t, $categoriaEntrada, $c, $f, $img, $Objeto_conexion);

        header("location: panel_usuario.php");
    }
}


?>

<form action="crear.php" method="post" enctype="multipart/form-data" class="formularios" style="width: 600px; height: 600px; padding: 50px;">
    <label>Titulo</label><br><input placeholder="Escribe el titulo..." type="text" name="titulo" required style="width: 250px; margin-top: 10px; margin-bottom: 10px"><br>
    <label>Contenido</label><textarea placeholder="Escribe aqui el contenido de tu entrada..." name="contenido" required style="width: 550px; height: 300px; margin: 30px; margin-top: 10px"></textarea><br>
    <div style="display:block;">
        <label style="display:inline; margin: 20px; position: relative; right: 150px">Categorias: </label><select name="categorias" id="" style="display:inline; margin: 20px;">
            <?php foreach ($categorias as $categoria) { ?>
                <option value=<?php echo $categoria['nombres']; ?>><?php echo $categoria['nombres']; ?></option>
            <?php } ?>
        </select><br>
        <label style="display:inline; margin: 20px; position: relative; right: 70px">IMAGEN:</label><input type="file" name='img' style="display:inline; margin: 20px;  position: relative; left: 50px">
        <br>
    </div>

    <input type="submit" value="Guardar" class='button' style='padding: 10px 30px; font-size: 15px; margin-bottom: 5px; margin-left: 5px; margin-top: 5px; position:relative; top: 30px'>
</form>

<?php
require_once("pie.php");
$Objeto_conexion->cerrar();
?>