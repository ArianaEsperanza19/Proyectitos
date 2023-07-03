<?php
if(!isset($_SESSION)){
    session_start();
}
require_once("cabecera.php");
require_once("ManipulacionDatos.php");

$entrada_id = NULL;
if (isset($_GET['entrada'])) {
    $entrada_id = $_GET['entrada'];
}

$t = NULL;
$c = NULL;
$id = $_SESSION['idUser'];


if ($_POST && $_FILES['img']) {
    $t = isset($_POST['titulo']) ? $_POST['titulo'] : false;
    $c = isset($_POST['contenido']) ? $_POST['contenido'] : false;
    $cate = isset($_POST['categorias']) ? $_POST['categorias'] : false;
    $img = isset($_FILES['img']) ? $_FILES['img'] : false;
    $img = $img['name'];
    $fecha = new DateTime();
    if ($img != "" || $img != false) {
        $img = $fecha->getTimestamp() . '_' . $_FILES['img']['name']; //Recepciona el nombre del archivo que viene en el arreglo que se recibe
        $imagenTemporal = $_FILES['img']['tmp_name']; //Imagen temporal
        move_uploaded_file($imagenTemporal, "img/" . $img);
    } //Mueve el archivo recibido a la carpeta dada

    $errores = [];
    if ($t === "") {
        array_push($errores, "El titulo no puede estar vacio.");
    }
    if ($c === "") {
        array_push($errores, "El contenido no puede estar vacio.");
    }
    if ($cate === "") {
        array_push($errores, "Seleccione una categoria.");
    }
    $mensaje = NULL;

    if ($errores != NULL) {
        foreach ($errores as $error) {
            $mensaje = "
                    <div class='mensajes'>
                    <ul style='list-style: none;'>
                    <li>-$error</li>
                    </ul>
                    </div>
                    ";
        }
    }

    $sql = "SELECT id FROM categorias WHERE nombres = '$cate';";
    $idCategorias = $Objeto_conexion->consultar($sql);

    $categoriaEntrada = null;
    foreach ($idCategorias as $ca) {
        $categoriaEntrada = $ca;
    }
    $categoriaEntrada = $categoriaEntrada['id'];
    
    if ($errores == NULL) {

        EditarEntrada($entrada_id, $id, $categoriaEntrada, $t, $c, $img, $Objeto_conexion);

    } else {
        echo "<div style='border: solid 1px red;'>";
        foreach ($errores as $error) {
            echo "<div class='mensajes'>
            <ul style='list-style: none;'>
            <li>-$error</li>
            </ul>
            </div>";
        }
        echo "</div>";
    }
}


//FORMULARIO DE EDITAR LLENO


$sql = "SELECT * FROM entradas WHERE id=$entrada_id;";
$entrada = $Objeto_conexion->consultar($sql); //Entradas del usuario
$sql = "SELECT nombres FROM categorias;";
$categorias = $Objeto_conexion->consultar($sql);

?>


<form action='<?php echo "sobreescribir.php?entrada=$entrada_id" ?>' method="post" enctype="multipart/form-data">

    <?php foreach ($entrada as $i) {
        $contenido = $i['descripcion'];
        $t = $i['titulo'];
        $categoria = $i['categoria_id'];
        $sql = "SELECT nombres FROM categorias WHERE id=$categoria";
        $categoriaNombre = $Objeto_conexion->consultar($sql);
        $categoriaNombre = $categoriaNombre[0]['nombres'];
    ?>


        <label>Titulo</label><input type="text" name="titulo" value="<?php echo $t; ?>" required><br>
        <label>Contenido</label><textarea name="contenido" required><?php echo $contenido; ?></textarea><br>
        <label>Categorias: </label><select name="categorias" value="<?php echo $categoriaNombre ?>" id="">
            <?php foreach ($categorias as $categoria) { ?>
                <option value=<?php echo $categoria['nombres']; ?> <?php if ($categoria['nombres'] == $categoriaNombre) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $categoria['nombres']; ?></option>
        <?php }
        } ?>
        </select><br>
        IMAGEN: <input type="file" name='img'>
        <br>
        <input type="submit" value="Guardar" class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; margin-top: 5px;'>
</form>