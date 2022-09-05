<?php

class Modelo_Rol {
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function listarRol()
     {
         $sql = "call SP_LISTAR_ROL()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function registraRol($rol)
     {
         $sql = "call SP_REGISTRAR_ROL('$rol')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function editarRol($id,$rol_actual,$rol_new,$estado)
     {
         $sql = "call SP_MODIFICAR_ROL('$id','$rol_actual','$rol_new','$estado')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
}