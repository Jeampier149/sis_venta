<?php

class Modelo_Producto{
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function listarProducto()
     {
         $sql = "call SP_LISTAR_PRODUCTO()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function listar_combo_unidad(){
        $sql = "call SP_LISTAR_COMBO_UNIDAD()";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    public function listar_combo_categoria(){
        $sql = "call SP_LISTAR_COMBO_CATEGORIA()";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    public function  registrarProducto($producto,$presentacion,$unidad_medida,$categoria,$precio_venta,$ruta){
        $sql ="call SP_REGISTRAR_PRODUCTO('$producto','$presentacion','$unidad_medida','$categoria','$precio_venta','$ruta')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
           if ($row = mysqli_fetch_array($consulta)) {
               return  $id = trim($row[0]);
           }

           $this->conexion->cerrar();
        }

    }
     public function editar_producto($id,$producto,$producto_actual,$presentacion,$categoria,$unidad,$precio,$estado)
     {
         $sql = "call SP_MODIFICAR_PRODUCTO('$id','$producto','$producto_actual','$presentacion','$categoria','$unidad','$precio','$estado')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
             if ($row = mysqli_fetch_array($consulta)) {
                 return  $id = trim($row[0]);
             }
 
             $this->conexion->cerrar();
         }
     }
     public function  editar_foto_producto($id,$ruta){
        $sql ="call SP_EDITAR_IMAGEN_PRODUCTO('$id','$ruta')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
           if ($row = mysqli_fetch_array($consulta)) {
               return  $id = trim($row[0]);
           }

           $this->conexion->cerrar();
        }

    }

}