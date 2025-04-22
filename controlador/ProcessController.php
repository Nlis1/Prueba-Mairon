<?php

require_once 'modelo/ProcessModel.php';

class ProcessController{

    public $model;

    public function __construct() {
        $this->model = new ProcessModel();
    }
    public function consultar($id = null){
        $response = $this->model->get($id);
        return json_encode($response);
    }

    public function insertar(){
        $response = $this->model->post();
        return json_encode($response);
    }

    public function actualizar($id){
        $response = $this->model->put($id);
        return json_encode($response);
    }

    public function eliminar($id){
        $response = $this->model->delete($id);
        return json_encode($response);
    }

}