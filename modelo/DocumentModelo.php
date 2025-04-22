<?php

require_once(__DIR__ . '/../core/Conexion.php');

class DocumentModelo {
    public $conexion;
    public function __construct() {
        $this->conexion = Conexion::conectar();
    }
    public function get($busqueda,$id = null) {
        if(isset($busqueda)){
            $sql="SELECT SQL_CALC_FOUND_ROWS * FROM `doc_documento` 
                    WHERE (DOC_NOMBRE LIKE '%$busqueda%' 
                    OR DOC_CONTENIDO LIKE '%$busqueda%' 
                    OR DOC_ID LIKE '%$busqueda%' 
                    OR DOC_CODIGO LIKE '%$busqueda%' 
                    OR DOC_ID_TIPO LIKE '%$busqueda%') 
                    ORDER BY DOC_NOMBRE ASC";
        
        }else{
            $sql= $id ? "SELECT * FROM doc_documento WHERE DOC_ID=$id" : "SELECT * FROM doc_documento";
        }
        
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

    public function post($datos){
        //$datos =  json_decode(file_get_contents('php://input'),true);
        $sql="INSERT INTO doc_documento(doc_nombre, doc_contenido, doc_id_tipo, doc_id_proceso) VALUES (
        ?,?,?,?)";
        $resultado= $this->conexion->prepare($sql);
        $resultado->bind_param("ssss",$datos['DOC_NOMBRE'], $datos['DOC_CONTENIDO'],$datos['DOC_ID_TIPO'], $datos['DOC_ID_PROCESO']);
    
        if( $resultado->execute()){
            $doc_id = $this->conexion->insert_id;
        
            $consulta1 = "SELECT CONCAT(pp.PRO_PREFIJO, '-', ttp.TIP_PREFIJO) as tippro FROM `pro_proceso` as pp join tip_tipo_doc as ttp on ttp.TIP_ID = ? where pp.PRO_ID = ?";

            $stmt = $this->conexion->prepare($consulta1);
            $stmt->bind_param("ii", $datos['DOC_ID_TIPO'], $datos['DOC_ID_PROCESO']);
            $stmt->execute();
            $resultado1 = $stmt->get_result();
        
            if ($fila = $resultado1->fetch_assoc()) {
                $tip_pro = $fila['tippro'];
                $doc_codigo= $tip_pro.'-'.$doc_id;

                $sql_update = "UPDATE DOC_DOCUMENTO SET DOC_CODIGO = ? WHERE DOC_ID = ?";
                $stmt_update = $this->conexion->prepare($sql_update);
                $stmt_update->bind_param("si", $doc_codigo, $doc_id);
                $stmt_update->execute();

            }
        }
    
    }

    public function put($datos,$id){
        // $datos =  json_decode(file_get_contents('php://input'),true);
        
        $sql= "UPDATE `doc_documento` SET `DOC_NOMBRE`=?,`DOC_CONTENIDO`=?,`DOC_ID_TIPO`=?,`DOC_ID_PROCESO`=? WHERE DOC_ID=$id";
        $resultado= $this->conexion->prepare($sql);
        $resultado->bind_param("ssss",$datos['DOC_NOMBRE'], $datos['DOC_CONTENIDO'],$datos['DOC_ID_TIPO'], $datos['DOC_ID_PROCESO']);

        if($resultado->execute()){
            $consulta1="SELECT CONCAT(pp.PRO_PREFIJO, '-', ttp.TIP_PREFIJO) as tippro FROM `pro_proceso` as pp join tip_tipo_doc as ttp on ttp.TIP_ID = ? where pp.PRO_ID = ?";
            $stmt = $this->conexion->prepare($consulta1);
            $stmt->bind_param("ii", $datos['DOC_ID_TIPO'], $datos['DOC_ID_PROCESO']);
            $stmt->execute();
            $resultado1 = $stmt->get_result();

            if ($fila = $resultado1->fetch_assoc()) {
                $tip_pro = $fila['tippro'];
                $doc_codigo= $tip_pro.'-'.$id;
  
                $sql_update = "UPDATE DOC_DOCUMENTO SET DOC_CODIGO = ? WHERE DOC_ID = ?";
                $stmt_update = $this->conexion->prepare($sql_update);
                $stmt_update->bind_param("si", $doc_codigo, $id);
                $stmt_update->execute();
            }
            
        }
        return $this->get($id);
    }

    public function delete($id){    
        $sql= "DELETE FROM doc_documento WHERE DOC_ID=?";
        $resultado=$this->conexion->prepare($sql);
        $resultado->bind_param('s', $id);
        $resultado->execute();
    }

    public function update_prefijo_tipo($id){
        
        $sql_update_type="UPDATE doc_documento AS d
                JOIN tip_tipo_doc AS tip ON d.DOC_ID_TIPO = tip.TIP_ID
                JOIN pro_proceso AS pro ON d.DOC_ID_PROCESO = pro.PRO_ID
                SET d.DOC_CODIGO = CONCAT(tip.TIP_PREFIJO, '-', pro.PRO_PREFIJO, '-', d.DOC_ID)
                WHERE tip.TIP_ID = ?";

        $stmt_update = $this->conexion->prepare($sql_update_type);
        $stmt_update->bind_param("i",$id);
        $stmt_update->execute();
    }

    public function update_prefijo_process($id){
        $sql_update_process="UPDATE doc_documento AS d
                JOIN tip_tipo_doc AS tip ON d.DOC_ID_TIPO = tip.TIP_ID
                JOIN pro_proceso AS pro ON d.DOC_ID_PROCESO = pro.PRO_ID
                SET d.DOC_CODIGO = CONCAT(tip.TIP_PREFIJO, '-', pro.PRO_PREFIJO, '-', d.DOC_ID)
                WHERE pro.PRO_ID = ?";

        $stmt_update = $this->conexion->prepare($sql_update_process);
        $stmt_update->bind_param("i",$id);
        $stmt_update->execute();
    }
}
