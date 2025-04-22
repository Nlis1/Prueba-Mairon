<?php
    require_once("../controlador/DocumentController.php");
    $insDocument= new DocumentController();

    if(isset($_POST["type-prefijo"]) && isset($_POST["nombre-documento"])){
        $resultado = $insDocument->insertar();
    } 

    if(isset($_POST["codigo-document"])){
        $resultado = $insDocument->eliminar($_POST['codigo-document']);
        
    }

    if(isset($_POST["nombre-up"]) && isset($_POST["contenido-up"])){
        $resultado = $insDocument->actualizar($_POST['id-up']);
    }