<?php

class Modelo_Categoria{
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function listar_categoria()
     {
         $sql = "call SP_LISTAR_CATEGORIA()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function registrarCategoria($categoria)
     {
         $sql = "call SP_REGISTRAR_CATEGORIA('$categoria')";
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
}