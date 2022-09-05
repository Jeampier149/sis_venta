<?php

class Modelo_Cliente{
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function listarCliente()
     {
         $sql = "call SP_LISTAR_CLIENTE()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function registrarCliente($nombre,$app,$apm,$doc,$tipo_doc,$telefono,$sexo)
     {
         $sql = "call SP_REGISTRAR_CLIENTE('$nombre','$app','$apm','$doc','$tipo_doc','$telefono','$sexo')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function editar_estado_cliente($id,$estado)
     {
         $sql = "call SP_MODIFICAR_ESTADO_CLIENTE('$id','$estado')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
}