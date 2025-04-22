<?php

require_once './controlador/DocumentController.php';
require_once './controlador/ProcessController.php';
require_once './controlador/TypeController.php';

header("Content-Type: application/json");

$metodo= $_SERVER['REQUEST_METHOD'];

if ($metodo === 'POST' && isset($_POST['_method'])) {
    $metodo = strtoupper($_POST['_method']);
}

$path= isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$params = substr($path, 1);

$explode = explode("/", $params);

$nameController = ucfirst(string: $explode[0])."Controller";
$id = $explode[1] ?? null;

// echo $id;
switch ($metodo) {
    case 'GET':
        $controller = new $nameController();
        echo $controller->consultar($id);
        break;
    case 'POST':
        $controller = new $nameController();
        echo $controller->insertar();
        break;
    case 'PUT':
        $controller = new $nameController();
        echo $controller->actualizar($id);
        break;
    case 'DELETE':
        $controller = new $nameController();
        echo $controller->eliminar($id);
        break;
    default:
        echo 'Metodo no permitido';
        break;
    return;
}

