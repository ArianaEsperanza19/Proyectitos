<?php
if(!isset($_SESSION)){
        session_start();
    }
require_once("cabecera.php");
require_once("ModelarDatos.php");


$usuario = $_SESSION['idUser'];
$sql = "SELECT * FROM entradas WHERE usuario_id=$usuario";
$entradas = $Objeto_conexion->consultar($sql);


?>

<h1>Entras del usuario <?php echo $_SESSION['user']; ?></h1>
<?php   

ModelarEntradaVer($entradas, $Objeto_conexion);
$Objeto_conexion->cerrar();
?>




        </p></article>