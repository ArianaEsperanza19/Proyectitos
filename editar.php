<?php
if(!isset($_SESSION)){
    session_start();
}
require_once("cabecera.php");
$id = null;
if(isset($_GET['entrada'])){
    $id = $_GET['entrada']; 
}
$contenido = null;
$titulo = null;
$categoria = null;
$sql = "SELECT * FROM entradas WHERE id=$id;";
$entrada = $Objeto_conexion->consultar($sql);//Entradas del usuario
$sql = "SELECT nombres FROM categorias;";
$categorias = $Objeto_conexion->consultar($sql);


?>


<form action='<?php echo "sobreescribir.php?entrada=$id" ?>' method="post" enctype="multipart/form-data" class="formularios" style="width: 600px; height: 600px; padding: 50px;">

    <?php foreach($entrada as $i){ 
     $contenido = $i['descripcion'];
     $titulo = $i['titulo'];
     $categoria = $i['categoria_id'];   
     $img = $i['imagen'];
     $sql = "SELECT nombres FROM categorias WHERE id=$categoria";   
     $categoriaNombre =$Objeto_conexion->consultar($sql);   
     $categoriaNombre = $categoriaNombre[0]['nombres'];
        ?>


    <label>Titulo</label><br><input type="text" name="titulo" value="<?php echo $titulo; ?>" required style="width: 250px; margin-top: 10px; margin-bottom: 10px"><br>
    <label>Contenido</label><textarea name="contenido" required style="width: 550px; height: 300px; margin: 30px; margin-top: 10px"><?php echo $contenido; ?></textarea><br>
    <div style="display:block;">
    <label style="display:inline; margin: 20px; position: relative; right: 150px">Categorias: </label><select name="categorias" value="<?php echo $categoriaNombre ?>" id="" style="display:inline; margin: 20px;">
        <?php foreach($categorias as $categoria){ ?>
            <option value=<?php echo $categoria['nombres']; ?> <?php if($categoria['nombres'] == $categoriaNombre){ echo "selected";} ?>
            ><?php echo $categoria['nombres']; ?></option>
        <?php }}?>
    </select><br>
    <label style="display:inline; margin: 20px; position: relative; right: 70px">IMAGEN</label><input type="file" name='img' value='<?php echo $img; ?>' style="display:inline; margin: 20px;  position: relative; left: 50px">
    <br>
    </div>
    <input type="submit" value="Guardar" class='button' style='padding: 10px 30px; font-size: 15px; margin-bottom: 5px; margin-left: 5px; margin-top: 5px; position:relative; top: 30px'>
</form>

<?php
require_once("pie.php");
 ?>