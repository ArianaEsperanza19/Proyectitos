<?php
require_once("cabecera.php");
require_once("ModelarDatos.php");
$id = null;
if (isset($_GET['entrada'])) {
    $id = $_GET['entrada'];
    $sql = "SELECT * FROM `entradas` WHERE id=$id;";
    $entrada = $Objeto_conexion->consultar($sql);
}

?>


<div id="principal">

    <article class="entrada">
        <?php

        foreach ($entrada as $i) {
            $info = DesglosarEntrada($i, $Objeto_conexion);
            if ($info['Papelera'] == false) {
                echo "<br>";
                echo "<h2>" . $info['Titulo'] . "</h2>";
                echo "<br>";
                echo "<p>" . $info['Contenido'] . "</p>";
                echo "<br>";
                if ($info['Imagen'] != NULL) {echo $info['Imagen'];}
                echo "<p>" . "Autor: " . $info['Usuario'];

                echo  " | " . "Publicado en: " . $info['Fecha'] . "</p>";

                echo "Categoria: " . $info['Categoria'];
                echo "<br><a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px; margin-top: 5px;' href='editar.php?entrada=$id'>Editar</a>|
                <a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; margin-top: 5px; background-color: red;' href='confirmacion.php?eliminar=2&entrada=$id'>Eliminar</a> |
                <a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px; margin-top: 5px;' href='ver.php'>Volver</a><hr>";
            }
        }

        ?>
    </article>
</div>

<?php
require_once("pie.php");
$Objeto_conexion->cerrar();
?>