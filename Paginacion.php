<?php

    if (count($entradas) == 1) {
    array_push($arreglo_entradas_id, $entradas[0]);
}   else {
    //RELLENAR CON LOS REGISTROS QUE COINCIDEN    
    foreach ($entradas as $i) {

    array_push($arreglo_entradas_id, $i);
}

    //CALCULAR NUMERO DE PAGINAS

    //SI EL TOTAL DE INDICES DEL ARREGLO ES DIVISIBLE ENTRE 3
    if (count($arreglo_entradas_id) % 3 == 0) {
        //SACAR EL NUMERO DE PAGINAS SI EL TOTAL DE REGISTROS ES DIVISIBLE ENTRE 3
    $num_paginas = count($arreglo_entradas_id) / 3;
        //echo "<h1>Numero de paginas $num_paginas</h1>";
}   else {

        //CUANDO EL TOTAL DE REGISTROS NO ES DIVISIBLE ENTRE 3, SE COMPENSA AGREGANDO INDICES QUE CONTENGAN *
    while ((count($arreglo_entradas_id) % 3) != 0) {
    array_push($arreglo_entradas_id, "*");
}
        //SACAR EL NUMERO DE PAGINAS CUANDO EL TOTAL DE REGISTROS NO ES DIVISIBLE ENTRE 3S
    $num_paginas = count($arreglo_entradas_id) / 3;
}
    $_SESSION['arreglo_id'] = $arreglo_entradas_id;
} //ELSE de buscar

    $numPag = null;
//SI SE RECIBE EL NUMERO DE PAGINAS
    if (!empty(isset($_GET['numPag']))) {
    $numPag = $_GET['numPag'];
    //var_dump($numPag);
    //SE FILTRAN LOS REGISTROS HASTA SOLO QUEDAR LOS QUE CORRESPONDEN A LA PAGINA DADA
    $entradas = Paginar($numPag, $arreglo_entradas_id, $Objeto_conexion);
}   else {
    //SI NO SE RECIBE ENTONCES EL NUMERO DE PAGINA ES = NULL 
    $entradas = Paginar($numPag, $arreglo_entradas_id, $Objeto_conexion);
}
