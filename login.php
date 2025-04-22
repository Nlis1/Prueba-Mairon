<?php

if(isset($_POST["usuario"]) && isset($_POST["contrasena"])){
    require_once "./controlador/LoginController.php";
    $login = new LoginController();

    echo $login->iniciar_sesion();
}