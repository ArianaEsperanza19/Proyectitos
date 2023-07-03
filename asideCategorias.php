<?php
require_once __DIR__ . "/BD/conexion.php";
$sql = "SELECT * FROM `categorias`;";
$idCategorias = $Objeto_conexion->consultar($sql); //Estan en un arreglo


?>



<aside id="lateral">
    <?php foreach ($idCategorias as $i) {

        $categoriasid = "SELECT nombres FROM categorias WHERE id=" . $i[0];
        //echo $categoriasid;
        $categorias = $Objeto_conexion->consultar($categoriasid);
        foreach ($categorias as $j) { ?>
            <ul>

            <?php
            echo "<li><a class='link' href='filtroCategorias.php?categorias=" . $j['nombres'] . "'>" . $j['nombres'] . "</a></li>";
        }
            ?>
            </ul>
        <?php }; ?>
</aside>