<?php


function ModelarEntradaIndex($entradas, $conexion)
{   
    /*Esta funcion se encarga de mostrar de manera formateada la información de cada entrada 
    en una página. 
    Variables: 
    $entradas: Un array que contiene la información de las entradas a mostrar. 
    $conexion: Una variable que representa la conexión a la base de datos.

    */
    foreach ($entradas as $i) {
        
        $info = DesglosarEntrada($i,$conexion);
        if ($info['Papelera'] == false) {
            echo "<br>";
            echo "<h2>" . $info['Titulo'] . "</h2>";
            echo "<br>";
            echo "<p>" . $info['Contenido'] . "</p>";
            echo "<br>";
            if ($info['Imagen'] != NULL) {
                echo $info['Imagen'];
            }
         
            echo "<p>" . "Autor: " . $info['Usuario'];
            echo  " | " . "Publicado en: " . $info['Fecha'] . "</p>";

            echo "Categoria: " . "<a class='link' href='filtroCategorias.php?categorias=" . $info['Categoria'] . "'>" . $info['Categoria'] . "</a>";
            echo "<br><hr>";
            
        }
    
    }
}

function ModelarEntradaVer($entradas, $conexion)
{
    /*Esta funcion se encarga de mostrar en pantalla del fichero 'Ver.php' las entradas 
    de un blog que no estén en la papelera. 
    Variables:
    $entradas: Esta variable representa un arreglo que contiene las entradas del blog. 
    Cada entrada es un elemento del arreglo. 
    $conexion: Esta variable representa la conexión a la base de datos del blog.
    */
    foreach ($entradas as $entrada) {
        $info = DesglosarEntrada($entrada, $conexion);
        if ($info['Papelera'] == false) {
            $Titulo = $info['Titulo'];
            echo "<br><article><hr><div style='font-size: 30px'>$Titulo</div><p>Categoria:";
            $id = $info['Id'];
            echo $info['Categoria'] . " " . "</p>";
            $editar = "editar.php?entrada=$id";
            $confirmacion = "confirmacion.php?eliminar=2&entrada=$id";
            $mostrar = "mostrar.php?entrada=$id";
            //$_SESSION['accion'] = 'eliminar';
            echo "
            <div>
                <a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;' href='$editar'>Editar</a> |
                <a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px;margin-right: 5px; background-color: red;' href='$confirmacion'>Eliminar</a>|
                <a class='button' style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px;' href='$mostrar'>Ver</a>
            </div>
            <hr>
            ";
        }
    }
}

function ModelarUnaEntrada($id_entrada, $conexion)
{   
    /* Esta funcion  se encarga de obtener y mostrar en pantalla la información detallada 
    de una entrada específica de la base de datos, utilizando el ID de la entrada y la conexión 
    a la base de datos como variables necesarias para su tarea.
    Variables: 
    $id_entrada: Esta variable representa el ID de la entrada que se desea mostrar.
    $conexion: Esta variable representa la conexión a la base de datos.s
    */
    $sql = "SELECT * FROM entradas WHERE id=$id_entrada";
    $entradas = $conexion->consultar($sql);
    foreach ($entradas as $i) {
        $info = DesglosarEntrada($i, $conexion);
        echo "<br>";
        echo "<h2>" . $info['Titulo'] . "</h2>";
        echo "<br>";
        echo "<p>" . $info['Contenido'] . "</p>";
        echo "<br>";
        if ($i['imagen'] != NULL) { echo $info['Imagen']; }
        
        echo "<p>" . "Autor: " . $info['Usuario'];
        echo  " | " . "Publicado en: " . $info['Fecha'] . "</p>";
        echo "Categoria: " . "<a href='filtroCategorias.php?categorias=" .
        $info['Categoria'] . "'>" . $info['Categoria'] . "</a>";
        echo "<br><hr>";
        
    }
}

function BusquedaEntradas($input, $conexion)
{
    /*Esta funcion se encarga de realizar una búsqueda en una base de datos utilizando 
    un término de búsqueda proporcionado como entrada. Devuelve un array con los identificadores 
    de las entradas que coinciden con el término de búsqueda. 
    Variables: 
    $input: Esta variable representa el término de búsqueda que se utilizará para buscar 
    en la base de datos. 
    $conexion: Esta variable representa la conexión a la base de datos. 
    */

    $entradas = [];

    $sql = "SELECT id FROM entradas WHERE titulo LIKE '$input'";
    $titulos = $conexion->consultar($sql);
    if ($titulos != NULL) {
        foreach ($titulos as $t) {
            array_push($entradas, $t['id']);
        }
    }
    $sql = "SELECT id FROM entradas WHERE descripcion LIKE '$input'";
    $contenidos = $conexion->consultar($sql);
    if ($contenidos != NULL) {
        foreach ($contenidos as $c) {
            array_push($entradas, $c['id']);
        }
    }
    $entradas = array_unique($entradas);

    return $entradas;
}

function DesglosarEntrada($registro, $conexion)
{   
    /*
    La presente funcion se encarga de desglosar la información de un registro y almacenarla 
    en variables individuales.
    Variables:
    $registro: Un array que contiene la información del registro a desglosar. 
    $conexion: Una variable que representa la conexión a la base de datos.
     */
    
    $id_Registro = $registro['id'];
    $id_usuario = $registro['usuario_id'];
    $Categoria = $registro['categoria_id'];
    $Titulo = $registro['titulo'];
    $Contenido = $registro['descripcion'];
    $fecha = $registro['fecha'];
    $img = $registro['imagen'];
    $Papelera = $registro['papelera'];

    $sql = "SELECT nombres, apellidos FROM usuarios WHERE id=$id_usuario";
    $nombre = $conexion->consultar($sql);
    $nombre = $nombre[0]['nombres']." ". $nombre[0]['apellidos'];

    $sql = "SELECT nombres FROM categorias WHERE id=$Categoria";
    $Categoria = $conexion->consultar($sql);
    $Categoria = $Categoria[0]['nombres'];

    if ($img != NULL) {
        $ruta = "<img src=img/" . $img . " style='width:500px; margin: 0% auto; text-align: center;
    padding: 25px; display: block;'><br>";
    }else{
        $ruta = null;
    }
    
    $datos = [
        "Id" => $id_Registro,
        "Usuario" => $nombre,
        "ID_Usuario" => $id_usuario,
        "Categoria" => $Categoria,
        "Titulo" => $Titulo,
        "Contenido" => $Contenido,
        "Fecha" => $fecha,
        "Imagen" => $ruta,
        "Papelera" => $Papelera
    ];

    //echo "<pre>";print_r($datos);echo "</pre>";

    return $datos;
}

?>