<?php
require_once("cabecera.php");
require_once("ModelarDatos.php");
require_once("ManipulacionDatos.php");
if(!isset($_SESSION)){
    session_start();
}
$arreglo_entradas_id = [];
$input = null;
$alert = false;
$paginacion = false;
$num_paginas = 1;
//echo "<pre>";print_r($entradas);echo "</pre>";


//CUANDO NO SE RESIBE UN NUMERO DE PAGINA
if(!isset($_GET['numPag'])){

    if (isset($_POST['busqueda'])) {

        $input = "%" . $_POST['busqueda'] . "%";
    }
    
    $entradas = BusquedaEntradas($input, $Objeto_conexion);
    //CUANDO NO HAY RESULTADOS
    if ($entradas == NULL) {
        $alert = true;
    //CUANDO HAY RESULTADOS
    }else{

        require_once("Paginacion.php");
        
    }
}else{
    $arreglo_entradas_id = $_SESSION['arreglo_id'];
    $num_paginas = count($arreglo_entradas_id) / 3;
    $numPag = $_GET['numPag'];
    $entradas = $_SESSION['arreglo_id'];
    $entradas = Paginar($numPag, $entradas, $Objeto_conexion);
    $paginacion = true;
}



?>
<div id="principal">
<article class="entrada">
<?php
        if($alert == true){
            echo "<div style='color: red'>No se encontraron datos que coincidan... </div>"."<br>";
        }else{
            echo "<h1>Entradas encontradas:</h1>";
        }

        if($paginacion == true){
            
            ModelarEntradaIndex($entradas, $Objeto_conexion);
            
        }else{
            ModelarEntradaIndex($entradas, $Objeto_conexion);

        }

        


        ?>
    
        
    </article>
    <?php

    //SE IMPRIME UN NUMERO IGUAL DE ENLACES A LA CANTIDAD DE PAGINAS DADO POR $num_paginas 
    $contador = 0;
    
    if($num_paginas > 1){

        foreach ($arreglo_entradas_id as $j) {
            $contador++;
            //IMPRIMIRA CADA ENLACE MIENTRAS EL CONTADOR SEA MENOR AL NUMERO TOTAL DE PAGINAS
            if ($contador > $num_paginas) {
                break;
            } else {
                //CADA ENLACE AL SER PRESIONADO ENVIARA EL NUMERO DE PAGINA POR GET
                if($numPag != $contador){
                    echo "<div style='text-align: center; float: left; margin: 5px ;'><a style='color: rgb(103, 106, 255)' href='busqueda.php?numPag=$contador'>$contador</a></div>";
                }else{
                    echo "<div style='text-align: center; float: left; margin: 5px ;'><a style='color: black' href='busqueda.php?numPag=$contador'>$contador</a></div>";
                    
                }
    
                
            }
        }
    }
    ?>
</div>




<aside>
    <?php require_once("asideCategorias.php"); ?>
</aside>



<?php
require_once("pie.php");
$Objeto_conexion->cerrar();
?>