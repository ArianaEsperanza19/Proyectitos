<?php

require_once("cabecera.php");
$sql = "SELECT * FROM `categorias`;";
$idCategorias = $Objeto_conexion->consultar($sql); //Estan en un arreglo
$id_borrar = null;
if (isset($_GET['accion']) && isset($_GET['id'])) {
    if ($_GET['accion'] == "borrar") {
        $id_borrar = $_GET['id'];
        $sql = "DELETE FROM categorias WHERE id='$id_borrar'";
        $Objeto_conexion->ejecutar($sql);
        echo "<script>swal('Perfecto','Categoria Eliminada', 'success');</script>";
    }
}

$n = null;
if (@$_POST['crear']) {
    $n = isset($_POST['crear']) ? $_POST['crear'] : null;
    if ($n == null) {
        header("refresh:5;url:editarC.php");
        echo "<script>swal('Atencio','Categoria no creada', 'fail');</script>";
    } else {
        $sql = "INSERT INTO categorias VALUES(NULL,'$n');";
        $Objeto_conexion->ejecutar($sql);
        
        
    }
    header("location:editarC.php");
    echo "<script>swal('Perfecto','Categoria Creada', 'success');</script>";
}

?>



<div>
    <form action="editarC.php" method="post">
        <label>Nueva Categoria</label><input type="text" name="crear" required><input type="submit" value="Crear" class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;'>
    </form>
    <br>
</div>
<div>
    <?php foreach ($idCategorias as $i) {

        $categoriasid = "SELECT * FROM categorias WHERE id=" . $i[0];
        //echo $categoriasid;
        $categorias = $Objeto_conexion->consultar($categoriasid);

        foreach ($categorias as $j) { ?>
            <ul>

            <?php
            $i = $j['id'];
            $href = "editarC.php?accion=borrar&id=$i";
            echo "<li><a class='link' style='font-size: 25px;' href='filtroCategorias.php?categorias=" . $j['nombres'] . "'>" . $j['nombres'] . "</a></li><a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; background-color: red;' href='$href'>Borrar<a/><hr>";
        }
            ?>
            </ul>
        <?php }; 
        $Objeto_conexion->cerrar();?>
</div>