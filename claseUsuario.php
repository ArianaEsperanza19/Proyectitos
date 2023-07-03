<?php
require_once __DIR__ . "/BD/conexion.php";
$Objeto_conexion = new Conexion();

class Usuario
{
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $contrasenya;
    public function __construct($id, $nombre = null, $apellido = null, $email = null, $contrasenya = null)
    {
        $this->id = $id;
        $this->$nombre = $nombre;
        $this->$apellido = $apellido;
        $this->$email = $email;
        $this->$contrasenya = $contrasenya;
    }

    public function datos($conexion)
    {

        if ($this->nombre == null && $this->apellido == null && $this->email == null && $this->contrasenya == null) {
            $id = $this->id;
            $sql = "SELECT * FROM usuarios WHERE id=$id";
            $datos = $conexion->consultar($sql);
            $this->nombre = $datos[0]['nombres'];
            $this->apellido = $datos[0]['apellidos'];
            $this->email = $datos[0]['email'];
            $this->contrasenya = $datos[0]['contrasenya'];
            $datos = [
                'ID' => $this->id,
                'Nombre' => $this->nombre,
                'Apellido' => $this->apellido,
                'Email' => $this->email,
                'Contrasenya' => $this->contrasenya
            ];
        } else {

            $datos = [$this->id, $this->nombre, $this->apellido, $this->email, $this->contrasenya];
        }

        return $datos;
    }

    public function Entradas($conexion)
    {
        $usuario = $this->id;
        $sql = "SELECT * FROM entradas WHERE usuario_id=$usuario";
        $entradas = $conexion->consultar($sql);
        return $entradas;
    }

    public function CrearEntrada($titulo, $id_categoria, $contenido, $fecha, $img, $conexion)
    {
        /*NOTA: ESTA FUNCION REQUIERE QUE EL OBJETO SEA DECLARADO CON LA ID */
        $tabla = "entradas";
        $id = $this->id;
        if ($img == "") {
            $sql = "INSERT INTO $tabla(`id`,`usuario_id`, `categoria_id`,`titulo`,`descripcion`,`fecha`) VALUES(NULL, '$id', '$id_categoria', '$titulo', '$contenido', '$fecha');";
        } else {
            $sql = "INSERT INTO $tabla(`id`,`usuario_id`, `categoria_id`,`titulo`,`descripcion`,`fecha`,`imagen`) VALUES(NULL, '$id', '$id_categoria', '$titulo', '$contenido', '$fecha','$img');";
        }
        $conexion->ejecutar($sql);
    }

}
