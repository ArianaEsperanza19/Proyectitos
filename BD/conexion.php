<?php


class Conexion
{
    private $Servidor = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->Servidor;dbname=blog", $this->usuario, $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "conexion fallida " . $error;
        }
    }

    public function ejecutar($sql) //Insertar, borrar ,actualizar
    {
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId(); //Devuelve el id insertado

    }

    public function consultar($sql)
    {
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    public function cerrar()
    {
        $this->conexion = null;
    }
}
