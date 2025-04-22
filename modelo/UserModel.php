<?php

require_once './core/Conexion.php';

class UserModel {
    public $conexion;
    public function __construct() {
        $this->conexion = Conexion::conectar();
    }

    public function validate_credentials($datos) {
        $sql="SELECT * FROM users WHERE usuario=? AND contrasena=?";
        $stmt=$this->conexion->prepare(query: $sql);
        $stmt->bind_param("ss", $datos['Usuario'],$datos['Contrasena'] );
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
} 