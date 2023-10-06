<?php

function Registrarse($nombre, $apellido, $email, $contrasenya, $conexion)
{
    $tabla = 'usuarios';
    $sql = "INSERT INTO $tabla(id, nombres, apellidos, email, contrasenya) 
    VALUES(NULL,'$nombre','$apellido','$email','$contrasenya');";
    //var_dump($sql);
    $conexion->ejecutar($sql);
    echo "<script>swal('Perfecto','Usuario registrado', 'success');</script>";
}

function IniciarSesion($user, $pass, $conexion)
{

    $sql = "SELECT * FROM `usuarios` WHERE (email = '$user') AND (contrasenya = '$pass');";
    //var_dump($sql);
    $usuarios = $conexion->consultar($sql);
    if ($usuarios != null) {
        foreach ($usuarios as $u) {

            //var_dump($usuarios);
            $_SESSION['login'] = "true";
            $nombre = $u['nombres'];
            $apellido = $u['apellidos'];
            $_SESSION['user'] = $nombre . " " . $apellido;
            $id = $u['id'];
            $_SESSION['admin'] = null;
            if ($id == 10) {
                $_SESSION['admin'] = $id;
            }
            
            $_SESSION['idUser'] = $id;
            $redirect = "location:panel_usuario.php";
            header($redirect);
        }
    } else {
        echo "<script>swal('Error','Usuario o contraseña incorrecta', 'error');</script>";
        //echo '<script>alert("Usuario o contraseña incorrecta");</script>';
    }
}

function EliminarEntrada($id, $conexion)
{
    $sql = "UPDATE entradas SET papelera=TRUE WHERE id=$id;";
    //$sql = "DELETE FROM entradas WHERE id=$entrada";
    $conexion->ejecutar($sql);
    header('location: ver.php');
}

function EditarEntrada($idEntrada, $id_usuario, $id_categoria, $titulo, $contenido, $img, $conexion)
{
    $tabla = 'entradas';
    $sql = "SELECT CURDATE()";
    $fecha = $conexion->consultar($sql);
    $fecha = $fecha[0]["CURDATE()"];

    if ($img == "" || $img == NULL) {
        $sql = "UPDATE $tabla SET usuario_id='$id_usuario', categoria_id='$id_categoria', titulo='$titulo', descripcion='$contenido', fecha='$fecha' WHERE id='$idEntrada';";
    } else {
        $sql = "UPDATE $tabla SET usuario_id='$id_usuario', categoria_id='$id_categoria', titulo='$titulo', descripcion='$contenido', fecha='$fecha', imagen='$img' WHERE id='$idEntrada';";
    }

    $conexion->ejecutar($sql);
    header("location: ver.php");
}

function VaciarPapelera($conexion)
{
    $sql = "SELECT imagen FROM entradas WHERE papelera = TRUE;";
    $entradas = $conexion->consultar($sql);

    foreach ($entradas as $entrada) {
        $Nombre_img = $entrada['imagen'];
        $rutaAbsoluta = "img/";
        $rutaAbsoluta = $rutaAbsoluta . $Nombre_img;
        if (file_exists($rutaAbsoluta) || $Nombre_img != null) {
            echo $rutaAbsoluta;

            unlink("$rutaAbsoluta");
        }
    }
    $_SESSION['signal'] = 'eliminar_todo';
    $sql = "DELETE FROM entradas WHERE papelera=TRUE;";
    $conexion->ejecutar($sql);
    header("location:panel_usuario.php");
}

function EliminarUsuario($id, $conexion)
{
    $sql = "DELETE FROM usuarios WHERE id=$id";
    $conexion->ejecutar($sql);
    header('location: Admin_usuarios.php');
}

function RestaurarEntrada($id, $conexion)
{
    $sql = "UPDATE entradas SET papelera = FALSE WHERE id=$id;";
    $conexion->ejecutar($sql);
    $_SESSION['signal'] = 'restaurar';
    header("location:panel_usuario.php");
}

function Paginar($numPag, $arreglo_entradas_id, $Objeto_conexion)
{

    $posicion = 0;
    $envio = [];

    //SI ES LA PRIMERA PAGINA
    if ($numPag == 1 || $numPag == null) {
        $entradas_filtradas = array_slice($arreglo_entradas_id, 0, 3);

        foreach ($entradas_filtradas as $id) {

            if ($id != "*") {
                $sql = "SELECT * FROM entradas WHERE id=$id;";
                $entradas = $Objeto_conexion->consultar($sql);
                foreach ($entradas as $i) {
                    array_push($envio, $i);
                }

                //echo "<pre>"; print_r($entradas); echo "</pre>";
            }
        }
    } else {
        //CALCULA LOS EXTREMOS PARA EJECUTAR LA FUNCION SLICE
        $posicion = 3;
        $posicion_inicial_registro = $posicion * $numPag - 3;
        $entradas_filtradas = array_slice($arreglo_entradas_id, $posicion_inicial_registro, 3);
        //$entradas_filtradas = array_slice($entradas_filtradas);


        foreach ($entradas_filtradas as $id) {



            if ($id != "*") {
                $sql = "SELECT * FROM entradas WHERE id=$id;";
                $entradas = $Objeto_conexion->consultar($sql);
                foreach ($entradas as $i) {
                    array_push($envio, $i);
                }
                //echo "<pre>"; print_r($entradas); echo "</pre>";
            }
        }
    }

    //echo "<pre>";print_r($envio);echo "</pre>";


    return $envio;
}

