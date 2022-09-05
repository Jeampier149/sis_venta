<?php

class Modelo_Proveedor{
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function listarProveedor()
     {
         $sql = "call SP_LISTAR_PROVEEDOR()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function registrarProveedor($nombre,$razon,$contacto,$num_contacto,$app,$apm,$doc,$tipo_doc,$telefono,$sexo)
     {
         $sql = "call SP_REGISTRAR_PROVEEDOR('$nombre','$razon','$contacto','$num_contacto','$app','$apm','$doc','$tipo_doc','$telefono','$sexo')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function editarCategoria($id,$categoria_actual,$categoria_new,$estado)
     {
         $sql = "call SP_MODIFICAR_CATEGORIA('$id','$categoria_actual','$categoria_new','$estado')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function editar_estado_proveedor($id,$estado)
     {
         $sql = "call SP_MODIFICAR_ESTADO_PROVEEDOR('$id','$estado')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function editar_proveedor($id,$razon,$contacto,$num_contacto)
     {
         $sql = "call SP_MODIFICAR_PROVEEDOR('$id','$razon','$contacto','$num_contacto')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             return 1;          
         }else{
             return 0;
         }
         $this->conexion->cerrar();
     }
}