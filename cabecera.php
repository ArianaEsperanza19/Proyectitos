<?php
require_once __DIR__ . "/BD/conexion.php";

$Objeto_conexion = new Conexion();
$style = __DIR__.'\css\style.css';
//echo $style;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" type="text/css" href="css\style.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
   
    <header>
        <a class="link" href="index.php">
        <h1>BLOG DE ARIANA</h1>
        </a>
    </header>
    
    <nav id="nav" class="">
    <ul>
    <a class="link" href="index.php">
        <li>Inicio</li><a>
    <a class="link" href="login.php"><li>Ingresar</li></a>
    <?php if(isset($_SESSION['login']) == 'true'){ echo "<a class='link' href='panel_usuario.php'><li>Usuario</li></a>"; } ?>
    <?php if(isset($_SESSION['login']) == 'true'){ echo "<a class='link' href='cerrar.php'><li>Cerrar Sesion</li></a>"; } ?>
    <a class="link" href="sobreMi.php"><li>Acerca de</li></a>
        
</ul>
    <div id="buscador">
    <form action="busqueda.php" method="post">
    <input type="text" name="busqueda" required>
    <input class='button' style="padding: 3px 10px; font-size: 12px; margin-left: 5px" type="submit" name="buscar" value="Buscar">
    </form>
    </div>
    </nav>
    <div class="clearfix"> </div> 