<?php

require_once './modelo/DocumentModelo.php';
require_once './core/Conexion.php';

class DocumentController{

    public $model;
    public $conexion;

    public function __construct() {
        $this->model = new DocumentModelo();
        $this->conexion = Conexion::conectar();
    }
    public function consultar($id = null){
        $busqueda = isset($_GET['busqueda_inicial']) ? $_GET['busqueda_inicial'] : '';
        $response = $this->model->get($busqueda, $id);
    
        $contador = 1;
        $html = '';
            
        foreach ($response as $row) {
            $html .= "<tr>
                        <td>{$contador}</td>
                        <td>{$row['DOC_CODIGO']}</td>
                        <td>{$row['DOC_NOMBRE']}</td>
                        <td>{$row['DOC_CONTENIDO']}</td>
                        <td>{$row['DOC_ID_TIPO']}</td>
                        <td>{$row['DOC_ID_PROCESO']}</td>
                        <td>
                            <a href='./mydocuments.php?id={$row['DOC_ID']}' class='btn btn-success btn-raised btn-xs'>
                                <i class='bi bi-arrow-clockwise'></i>
                            </a>
                        </td>
                        <td>
                            <form class='FormularioAjax eliminarDocumento' method='POST' action='../api.php/document/{$row['DOC_ID']}'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <button type='submit' class='btn btn-danger btn-raised btn-xs'>
                                    <i class='bi bi-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>";
            $contador++;
        }
        echo json_encode($html); 
    }

    public function insertar(): bool|string{
        $doc_nombre= $_POST['nombre-documento'];
        $doc_contenido= $_POST['contenido-documento'];
        $doc_id_tipo= $_POST['type-prefijo'];
        $doc_id_proceso= $_POST['process-prefijo'];

        $datos=[
            "DOC_NOMBRE"=>$doc_nombre,
            "DOC_CONTENIDO"=>$doc_contenido,
            "DOC_ID_TIPO"=>$doc_id_tipo,
            "DOC_ID_PROCESO"=>$doc_id_proceso
        ];

        $response = $this->model->post($datos);
        return json_encode($response);
    }

    public function actualizar($id): bool|string{
        $datos=[
            "DOC_NOMBRE"=>$_POST['nombre-up'],
            "DOC_CONTENIDO"=>$_POST['contenido-up'],
            "DOC_ID_TIPO"=>$_POST['type-up'],
            "DOC_ID_PROCESO"=>$_POST['process-up']
        ];

        $response = $this->model->put($datos,$id);
        return json_encode($response);
    }
    public function eliminar($id): bool|string{
        $response = $this->model->delete($id);
        return json_encode($response);
    }

}