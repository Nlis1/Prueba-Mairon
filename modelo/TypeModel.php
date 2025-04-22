<?php

require_once(__DIR__ . '/../core/Conexion.php');

class TypeModel {
    public $conexion;
    public function __construct() {
        $this->conexion = Conexion::conectar();
    }
    public function get($id = null) {
        $sql= $id ? "SELECT * FROM tip_tipo_doc WHERE TIP_ID=$id" : "SELECT * FROM tip_tipo_doc";
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
        $dato = json_decode(file_get_contents('php://input'), true);
        $tip_nombre= $dato['TIP_NOMBRE'];
        $tip_prefijo= $dato['TIP_PREFIJO'];

        $sql="INSERT INTO tip_tipo_doc (TIP_NOMBRE, TIP_PREFIJO) VALUES(?,?)";
        $resultado=$this->conexion->prepare(query: $sql);
        $resultado->bind_param("ss",$tip_nombre, $tip_prefijo);

        if($resultado->execute()){
            echo json_encode("datos insertado con exito!");
        }else{
            echo json_encode("los datos no se pudieron insertar");
        }
    }

    public function put($id){
        $dato = json_decode(file_get_contents('php://input'),true);
        $tip_nombre= $dato['TIP_NOMBRE'];
        $tip_prefijo= $dato['TIP_PREFIJO'];

        $sql="UPDATE tip_tipo_doc SET TIP_NOMBRE='$tip_nombre', TIP_PREFIJO='$tip_prefijo' WHERE TIP_ID='$id'";
        $resultado=$this->conexion->query(query: $sql);

        if($resultado){
           $model = new DocumentModelo();
           $model->update_prefijo_tipo($id);

            echo json_encode("Se actualizo correctamente la tabla");
        }else{
            echo json_encode("No se pudo actualizar la tabla");
        }
    }

    public function delete($id){
        echo "el id a borrar es ".$id;

        $sql= "DELETE FROM tip_tipo_doc WHERE TIP_ID=$id";
        $resultado=$this->conexion->query($sql);
    
        if($resultado){
            echo json_encode(array('mensaje'=> 'documento eliminado correctamente'));
        }else{
            echo json_encode(array('mensaje'=> 'documento no se pudo eliminar'));
        }
        return $resultado;
    }

}