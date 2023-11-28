<?php
$cliente = null;
$producto = null;


if ($_GET) {
    if ($_GET['id'] && @$_GET['producto']) {
        $cliente = isset($_GET['id']) ? $_GET['id'] : false;
        $producto = isset($_GET['producto']) ? $_GET['producto'] : false;
        $redireccionar = "../Acciones/EliminarUnProducto.php?Cliente=$cliente&Producto=$producto";
        echo
        "
        <!DOCTYPE html>
        <html>
        <head>
        <link rel='stylesheet' href='css/PantallaAdvertencia.css' />
        <title>Advertencia</title>
        </head>
        <body>
        <div class='container'>
        <h1>Advertencia</h1>
        <p>¿Realmente quieres borrar el producto?</p>
        <a class='button' href='$redireccionar' name='confirmar'>Aceptar</a>
        <a class='button' type='button' value='Cancelar' onclick='history.back()'>Cancelar</a>
        </div>
        </body>
        </html>
        ";
    } else {

        if ($_GET['id'] && @$_GET['BD'] == 'true') {
            $cliente = isset($_GET['id']) ? $_GET['id'] : false;
            $redireccionar = "../Acciones/EliminarRegistroProducto.php?id=$cliente";
            echo
            "
            <!DOCTYPE html>
            <html>
            <head>
            <link rel='stylesheet' href='css/PantallaAdvertencia.css' />
            <title>Advertencia</title>
            </head>
            <body>
            <div class='container'>
            <h1>Advertencia</h1>
            <p>¿Realmente quiere borrar el producto de la Base de datos?</p>
            <a class='button' href='$redireccionar' name='confirmar'>Aceptar</a>
            <a class='button' type='button' value='Cancelar' onclick='history.back()'>Cancelar</a>
            </div>
            </body>
            </html>
            ";
        } else {

            if ($_GET['id'] && @$_GET['R'] == 'true') {

                $cliente = isset($_GET['id']) ? $_GET['id'] : false;
                $redireccionar = "../Acciones/Borrar-Registro-de-Venta.php?id=$cliente";
                echo
                "
            <!DOCTYPE html>
            <html>
            <head>
            <link rel='stylesheet' href='css/PantallaAdvertencia.css' />
            <title>Advertencia</title>
            </head>
            <body>
            <div class='container'>
            <h1>Advertencia</h1>
            <p>¿Realmente quiere borrar el registro de este pedido permanentemenete?</p>
            <a class='button' href='$redireccionar' name='confirmar'>Aceptar</a>
            <a class='button' type='button' value='Cancelar' onclick='history.back()'>Cancelar</a>
            </div>
            </body>
            </html>
            ";
            } else {
                $id = isset($_GET['id']) ? $_GET['id'] : false;
                $redireccionar = "../Acciones/EliminarPedido.php?id=$id";
                echo
                "
            <!DOCTYPE html>
            <html>
            <head>
            <link rel='stylesheet' href='css/PantallaAdvertencia.css' />
            <title>Advertencia</title>
            </head>
            <body>
            <div class='container'>
            <h1>Advertencia</h1>
            <p>¿Realmente quieres borrar el pedido #$id?</p>
            <a class='button' href='$redireccionar' name='confirmar'>Aceptar</a>
            <a class='button' type='button' value='Cancelar' onclick='history.back()'>Cancelar</a>
            </div>
            </body>
            </html>
            ";
            }
        }
    }
}
