<?php

class Modelo_Unidad_Medida{
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function listar_unidad()
     {
         $sql = "call SP_LISTAR_UNIDAD()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function registrar_unidad($unidad,$abrev)
     {
         $sql = "call SP_REGISTRAR_UNIDAD('$unidad','$abrev')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function editar_unidad($id,$unidad_actual,$unidad_nueva,$abrev_actual,$abrev_nueva,$estado)
     {
         $sql = "call SP_MODIFICAR_UNIDAD('$id','$unidad_actual','$unidad_nueva','$abrev_actual','$abrev_nueva','$estado')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
}