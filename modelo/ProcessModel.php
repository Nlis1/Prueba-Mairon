<?php

require_once(__DIR__ . '/../core/Conexion.php');

class ProcessModel {
    public $conexion;
    public function __construct() {
        $this->conexion = Conexion::conectar();
    }
    public function get($id = null) {
        $sql= $id ? "SELECT * FROM pro_proceso WHERE PRO_ID=$id" : "SELECT * FROM pro_proceso";
        $resultado=$this->conexion->query(query: $sql);
    
        $datos = [];
        if($resultado){
            $datos = array();
                while($fila = $resultado->fetch_assoc()){
                    $datos[]= $fila;
                }
        }

        if(count(value: $datos)> 0){
            return $id ? $datos[0] : $datos;
        }

        return $id ? null : [];
    }

    public function post(){
        $dato =  json_decode(file_get_contents('php://input'),true);
        $pro_prefijo=$dato['PRO_PREFIJO'];
        $pro_nombre=$dato['PRO_NOMBRE'];

        $sql= "INSERT INTO pro_proceso(PRO_PREFIJO, PRO_NOMBRE) VALUES(?,?)";
        $resultado=$this->conexion->prepare(query: $sql);
        $resultado->bind_param("ss",$pro_prefijo, $pro_nombre);

        if($resultado->execute()){
            echo "Se creo correctamente";
            return $dato;
        }
    }

    public function put($id) {
        $dato =  json_decode(file_get_contents('php://input'),true);
        $pro_prefijo=$dato['PRO_PREFIJO'];
        $pro_nombre=$dato['PRO_NOMBRE'];

        $sql="UPDATE pro_proceso SET PRO_NOMBRE='$pro_nombre', PRO_PREFIJO='$pro_prefijo' WHERE PRO_ID='$id'";
        $resultado=$this->conexion->query(query: $sql);

        if($resultado){
            $model = new DocumentModelo();
            $model->update_prefijo_process($id);
 
            echo json_encode(array('mensaje'=> 'el proceso esta actualizdo'));
        }else{
            echo json_encode(array('mensaje'=> 'no se pudo actualizar el proceso'));
        }
        return $resultado;
    }
    
    public function delete($id){
        echo "el id a borrar es ".$id;

        $sql= "DELETE FROM pro_proceso WHERE PRO_ID=$id";
        $resultado=$this->conexion->query($sql);
    
        if($resultado){
            echo json_encode(array('mensaje'=> 'el proceso fue eliminado correctamente'));
        }else{
            echo json_encode(array('mensaje'=> 'el proceso no se pudo eliminar'));
        }
        return $resultado;
    }
}