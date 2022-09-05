<?php

class Modelo_usuario {
    private $conexion;
    function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
     }
     public function verificarUsuario($user,$password){
         $sql = "call SP_VERIFICAR_USUARIO('$user')";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_array($consulta)) {
                 if (password_verify($password, $consulta_VU["usuario_password"])) {
                     $arreglo[] = $consulta_VU;
                 }
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function listarUsuario(){
         $sql = "call SP_LISTAR_USUARIO()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                 $arreglo['data'][] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }

     public function listar_combo_persona(){
         $sql = "call SP_LISTAR_COMBO_PERSONA()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_array($consulta)) {
                 $arreglo[] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function listar_combo_rol(){
         $sql = "call SP_LISTAR_COMBO_ROL()";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_array($consulta)) {
                 $arreglo[] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function  registrarUsuario($usuario,$password,$email,$rol,$persona,$ruta){
         $sql ="call SP_REGISTRAR_USUARIO('$usuario','$password','$email','$rol','$persona','$ruta')";
         if ($consulta = $this->conexion->conexion->query($sql)) {
            if ($row = mysqli_fetch_array($consulta)) {
                return  $id = trim($row[0]);
            }

            $this->conexion->cerrar();
         }
 
     }
     public function traer_datos($id){
         $sql = "call SP_TRAER_DATOS_USUARIO('$id')";
         $arreglo = array();
         if ($consulta = $this->conexion->conexion->query($sql)) {
             while ($consulta_VU = mysqli_fetch_array($consulta)) {
                 $arreglo[] = $consulta_VU;
             }
             return $arreglo;
             $this->conexion->cerrar();
         }
     }
     public function datos_widget($inicio,$fin){
        $sql = "call SP_DATOS_WIDGET('$inicio','$fin')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    public function datos_grafico_venta($inicio,$fin){
        $sql = "call SP_DATOS_GRAFICO_VENTA('$inicio','$fin')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    public function datos_grafico_ingreso($inicio,$fin){
        $sql = "call SP_DATOS_GRAFICO_INGRESO('$inicio','$fin')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
     public function  editar_usuario($id,$email,$email_actual,$rol,$persona,$estado){
        $sql ="call SP_MODIFICAR_USUARIO('$id','$email','$email_actual','$rol','$persona','$estado')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
           if ($row = mysqli_fetch_array($consulta)) {
               return  $id = trim($row[0]);
           }

           $this->conexion->cerrar();
        }

    }
    public function  editar_foto($id,$ruta){
        $sql ="call SP_EDITAR_IMAGEN('$id','$ruta')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
           if ($row = mysqli_fetch_array($consulta)) {
               return  $id = trim($row[0]);
           }

           $this->conexion->cerrar();
        }

    }
    public function actualizar_datos_profile($id,$nombre,$app,$apm,$doc,$tipo_doc,$telefono,$sexo)
    {
        $sql = "call SP_ACTUALIZAR_DATOS_PROFILE('$id','$nombre','$app','$apm','$doc','$tipo_doc','$telefono','$sexo')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            if ($row = mysqli_fetch_array($consulta)) {
                return  $id = trim($row[0]);
            }

            $this->conexion->cerrar();
        }
    }
    public function  editarContra($idusuario, $contranu)
    {
        $sql = "call SP_MODIFICAR_CONTRA('$idusuario','$contranu')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        } else {
            return 0;
        }

        $this->conexion->cerrar();
    }
 
}

