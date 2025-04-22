<?php 

class Conexion{
    public static $host="localhost";
    public static $usuario="root";
    public static $password="";
    public static $basededatos="gestion_documentos";

    public static function conectar() { 
        $conexion = new mysqli(self::$host,self::$usuario,self::$password,self::$basededatos);
        if ($conexion->connect_error) {
            die("Conexion no establecida". $conexion->connect_error);
        }
        return $conexion;
    }
    
}