<?php
if(!isset($_SESSION)){
    session_start();
}
require_once("cabecera.php");
require_once("ModelarDatos.php");
require_once("ManipulacionDatos.php");

$sql = "SELECT * FROM `entradas` WHERE papelera = false;";
$entradas = $Objeto_conexion->consultar($sql);
//REUNIR TODAS LAS ID PARA PODER CALCULAR EL TOTAL DE REGISTROS POR MEDIO DE COUNT()

$arreglo_entradas_id = [];
foreach ($entradas as $i) {
    array_push($arreglo_entradas_id, $i['id']);
}

//CALCULAR NUMERO DE PAGINAS
$num_paginas = null;
//SI EL TOTAL DE INDICES DEL ARREGLO ES DIVISIBLE ENTRE 3
if (count($arreglo_entradas_id) % 3 == 0) {
    //SACAR EL NUMERO DE PAGINAS SI EL TOTAL DE REGISTROS ES DIVISIBLE ENTRE 3
    $num_paginas = count($arreglo_entradas_id) / 3;
    //echo "<h1>Numero de paginas $num_paginas</h1>";
} else {

    //CUANDO EL TOTAL DE REGISTROS NO ES DIVISIBLE ENTRE 3, SE COMPENSA AGREGANDO INDICES QUE CONTENGAN *
    while ((count($arreglo_entradas_id) % 3) != 0) {
        array_push($arreglo_entradas_id, "*");


    }
    //SACAR EL NUMERO DE PAGINAS CUANDO EL TOTAL DE REGISTROS NO ES DIVISIBLE ENTRE 3S
    $num_paginas = count($arreglo_entradas_id) / 3;
}

//"<pre>";var_dump($arreglo_entradas_id);echo "</pre>";

$numPag = null;
//SI SE RECIBE EL NUMERO DE PAGINAS
if (isset($_GET['numPag'])) {
    $numPag = $_GET['numPag'];
    //SE FILTRAN LOS REGISTROS HASTA SOLO QUEDAR LOS QUE CORRESPONDEN A LA PAGINA DADA
    $entradas = Paginar($numPag, $arreglo_entradas_id, $Objeto_conexion);
} else {
    //SI NO SE RECIBE ENTONCES EL NUMERO DE PAGINA ES = NULL 
    $entradas = Paginar($numPag, $arreglo_entradas_id, $Objeto_conexion);
}

//AQUI SE MUESTRAN LAS ENTRADAS
require_once("entradas.php");

?>

<aside>
    <!--Categorias-->
    <?php require_once("asideCategorias.php"); ?>
</aside>

<?php
//PIE DE PAGINA
require_once("pie.php");
$Objeto_conexion->cerrar();
?>
