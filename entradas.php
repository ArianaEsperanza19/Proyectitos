<div id="principal">
    <?php
    if (isset($_GET['busqueda']) == 'false') {
        echo "<div style='color: red'>No se encontraron datos que coincidan.</div>" . "<br>";
    }
    ?>
    <h1>Entradas del blog:</h1>
    <article class="entrada">
        <?php
        //FORMATEAR E IMPRIMIR LA ENTRADA
        ModelarEntradaIndex($entradas, $Objeto_conexion);
        ?>
    </article>

    <?php

    //SE IMPRIME UN NUMERO IGUAL DE ENLACES A LA CANTIDAD DE PAGINAS DADO POR $num_paginas 
    $contador = 0;
    foreach ($arreglo_entradas_id as $j) {
        $contador++;
        //IMPRIMIRA CADA ENLACE MIENTRAS EL CONTADOR SEA MENOR AL NUMERO TOTAL DE PAGINAS
        if ($contador > $num_paginas) {
            break;
        } else {
            //CADA ENLACE AL SER PRESIONADO ENVIARA EL NUMERO DE PAGINA POR GET
            if ($numPag != $contador) {
                echo "<div style='text-align: center; float: left; margin: 5px ;'><a style='color: rgb(103, 106, 255)' href='index.php?numPag=$contador'>$contador</a></div>";
            } else {
                echo "<div style='text-align: center; float: left; margin: 5px ;'><a style='color: black' href='index.php?numPag=$contador'>$contador</a></div>";
            }
        }
    }
    ?>
</div>
