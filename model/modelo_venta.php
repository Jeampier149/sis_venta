<?php
class Modelo_Venta
{
    private $conexion;
    public function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    public function listarVenta($fechaini, $fechafinal)
    {
        $sql = "call SP_LISTAR_VENTA('$fechaini','$fechafinal')";
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
    public function listar_combo_cliente(){
        $sql = "call SP_LISTAR_COMBO_CLIENTE()";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    public function registrarVenta($idusuario,$idcliente,$tipo_c,$serie,$num_c,$igv,$total,$impuesto_porcentaje)
    {
        $sql = "call  SP_REGISTRAR_VENTA('$idusuario','$idcliente','$tipo_c','$serie','$num_c','$igv','$total','$impuesto_porcentaje')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            if ($row = mysqli_fetch_array($consulta)) {
                return  $id = trim($row[0]);
            }

            $this->conexion->cerrar();
        }
    }
 
    public function registrar_detalle_venta($idventa,$producto,$precio,$cantidad)
    {
        $sql = "call SP_REGISTRAR_DETALLE_VENTA('$idventa','$producto','$precio','$cantidad')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        } else {
            return 0;
        }
        $this->conexion->cerrar();
    }
    
    public function anularVenta($id_venta)
    {
        $sql = "call SP_ANULAR_VENTA('$id_venta')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        } else {
            return 0;
        }
        $this->conexion->cerrar();
    }
}