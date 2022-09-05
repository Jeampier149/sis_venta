<?php

class Modelo_Persona{
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function listarPersona()
     {
         $sql = "call SP_LISTAR_PERSONA()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function registrarPersona($nombre,$app,$apm,$doc,$tipo_doc,$telefono,$sexo)
     {
         $sql = "call SP_REGISTRAR_PERSONA('$nombre','$app','$apm','$doc','$tipo_doc','$telefono','$sexo')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function editarPersona($id,$nombre,$app,$apm,$doc_actual,$doc_nuevo,$tipo_doc,$telefono,$sexo,$estado)
     {
         $sql = "call SP_MODIFICAR_PERSONA('$id','$nombre','$app','$apm','$doc_actual','$doc_nuevo','$tipo_doc','$telefono','$sexo','$estado')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }

}