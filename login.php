<?php
require_once("cabecera.php");
require_once("ManipulacionDatos.php");
if(!isset($_SESSION)){
  session_start();
}

$nombre = null;
$apellido = null;
$redirect = "";
$user = null;
$pass = null;
$id = null;
$sql = "SELECT * FROM `usuarios`;";
$usuarios = null;


if ($_POST) {
  $user = isset($_POST['usuario']) ? $_POST['usuario'] : false;
  $pass = isset($_POST['password']) ? $_POST['password'] : false;
  
  require_once("validacion_login.php");
  IniciarSesion($user, $pass, $Objeto_conexion);
}


?>

<aside id="log">
  <div class="block_aside">
    <form action="login.php" method="post" name="ingresar" class="formularios" style="width: 200px;">
      <h3>Login</h3><br>
      <div>
        <label for="usuario">Usuario</label><input type="mail" name="usuario" required style='margin: 10px'><br>
        <label for="password">Contraseña</label><input type="password" name="password" required style='margin: 10px'><br>
        <input type="submit" value="Entrar" class='button' style="padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px; margin-top: 5px;"><a href="registrarse.php" class='button' style="padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; margin-right: 5px; margin-top: 5px;">Registrarse</a>
      </div>
    </form>
  </div>
</aside>

<?php
require_once("pie.php");
$conexion->cerrar();
?>