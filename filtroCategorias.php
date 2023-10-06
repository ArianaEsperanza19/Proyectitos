<?php
require_once("cabecera.php");
require_once("ModelarDatos.php");
$i = null;
if (isset($_GET['categorias'])) {
    $i = $_GET['categorias'];
}
//var_dump($i);

$query = "SELECT id FROM `categorias` WHERE nombres = '$i';";
$idCategorias = $Objeto_conexion->consultar($query);
foreach ($idCategorias as $id) {
    $sql = "SELECT * FROM `entradas` WHERE categoria_id=" . $id[0];
}

$entradas = $Objeto_conexion->consultar($sql);
?>

<div id="principal">
    <?php
    //Mostrar entradas
    echo "<h1>Entradas de la categoria $i:</h1>";

    ModelarEntradaIndex($entradas, $Objeto_conexion);

    ?>
</div>
<aside>
    <?php require_once("asideCategorias.php"); ?>
</aside>

<?php
require_once("pie.php");
$Objeto_conexion->cerrar();
?>