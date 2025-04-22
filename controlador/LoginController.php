<?php

require_once './modelo/UserModel.php';
class LoginController{

    public $model;

    public function __construct() {
        $this->model = new UserModel();
    }
    public function iniciar_sesion(){
        $usuario=$_POST['usuario'];
        $contrasena=$_POST['contrasena'];

        $datosLogin = [
            "Usuario"=>$usuario,
            "Contrasena"=>$contrasena
        ];

        $user= $this->model->validate_credentials($datosLogin);
        if($user){
            session_start();
            $_SESSION["usuario"] = $user['usuario'];
            $url="http://localhost/prueba-mairon/vista/home.php";
            $urlLocation='<script> window.location="'.$url.'"</script>';
            return $urlLocation;
        }else{
            echo "el usuario o contraseña no son correctos";
        }

    }
}