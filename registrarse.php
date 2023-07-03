<?php
require_once("cabecera.php");
require_once("ManipulacionDatos.php");

//NOTA AUN NO SE HA CONSEGUIDO ESCAPAR LOS DATOS CORRECTAMENTE, ASI QUE EVITAR EL USO DE COMILLAS
$n = null;
$s = null;
$e = null;
$p = null;
$p2 = null;

if ($_POST) {
        //$n = mysqli_real_escape_string($Objeto_conexion, isset($_POST['name']));
        $n = isset($_POST['name']) ? $_POST['name'] : false;
        $s = isset($_POST['surname']) ? $_POST['surname'] : false;
        $e = isset($_POST['email']) ? ($_POST['email']) : false;
        $p = isset($_POST['password']) ? $_POST['password'] : false;
        $p2 = isset($_POST['passwordR']) ? $_POST['passwordR'] : false;
        require_once("validacion_registro.php");
        if ($errores == NULL) {
                if ($p == $p2) {
                        //echo $n . "|" . $s . "|" . $e . "|" . $p;
                        //Se cifra la contrase;a mediante el siguiente metodo
                        //Sin embargo no lo usaremos porque esta base de datos es solo una prueba
                        #contrasenya_segura = password_hash($p, PASSWORD_BCRYPT, ['cost' => 4]);
                        //Comparar la contrase;a original con la cifrada
                        #Verificacion = password_verify($p , $contrasenya_segura);
                        $p = $cadenaSinEspacios = str_replace(' ', '', $p);
                        $e = $cadenaSinEspacios = str_replace(' ', '', $e);

                        Registrarse($n, $s, $e, $p, $Objeto_conexion);
                        //header('location : index.php');
                        //echo "<script> setTimeout(\"location.href='index.php'\",1000); </script>";
                } else {
                        echo "<script>alert('ERROR la contrase;a no coincide.');</script>";
                }
        }
}




?>


<div class="block_aside">
        <form action="registrarse.php" method="post" name="ingresar" class="formularios" style="width: 300px;">
                <h3>Registrarse</h3><br>
                <div style="display: flex; justify-content: center;  flex-direction: column; align-items: center;">
                        <label>Nombre</label for="name"><input type="text" name="name" required
                                style="margin: 10px; width: 150px;">
                        <label>Apellido</label for="surname"><input type="text" name="surname" required
                                style="margin: 10px; width: 150px;">
                        <label style="position:relative;">Email</label><input type="text" name="email" required
                                style="margin: 10px; margin-bottom: 15px; width: 150px;">
                </div>
                <hr>
                <div style="position:relative; top: 10px; margin-bottom: 10px;">
                        <label style='margin-top: 15px;'>Contraseña</label><br><input type="password" name="password"
                                required style="margin: 10px; width: 150px;"><br>
                        <label>Repetir Contraseña</label><br>
                        <input type="password" name="passwordR" required style="margin: 10px; width: 150px;"><br>
                </div>
                <input type="submit" value="Registrar" class='button'
                        style='padding: 3px 10px; font-size: 12px; margin-bottom: 5px; margin-left: 5px; margin-top: 5px;'>
        </form>
</div>

<?php
require_once("pie.php");
?>