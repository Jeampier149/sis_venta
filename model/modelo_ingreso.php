<?php
class Modelo_Ingreso
{
    private $conexion;
    public function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    public function listarIngreso($fechaini, $fechafinal)
    {
        $sql = "call SP_LISTAR_INGRESO('$fechaini','$fechafinal')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo['data'][] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    public function listar_combo_producto(){
        $sql = "call SP_LISTAR_COMBO_PRODUCTO()";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    public function listar_combo_proveedor(){
        $sql = "call SP_LISTAR_COMBO_PROVEEDOR()";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    public function registrarIngreso($idusuario,$idproveedor,$tipo_c,$serie,$num_c,$impuesto,$total,$impuesto_porcentaje)
    {
        $sql = "call  SP_REGISTRAR_INGRESO('$idusuario','$idproveedor','$tipo_c','$serie','$num_c','$impuesto','$total','$impuesto_porcentaje')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            if ($row = mysqli_fetch_array($consulta)) {
                return  $id = trim($row[0]);
            }

            $this->conexion->cerrar();
        }
    }
 
    public function registrar_detalle_ingreso($idingreso,$producto,$precio,$cantidad)
    {
        $sql = "call SP_REGISTRAR_DETALLE_INGRESO('$idingreso','$producto','$precio','$cantidad')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        } else {
            return 0;
        }
        $this->conexion->cerrar();
    }
    
    public function anularIngreso($id_ingreso)
    {
        $sql = "call SP_ANULAR_INGRESO('$id_ingreso')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        } else {
            return 0;
        }
        $this->conexion->cerrar();
    }
}