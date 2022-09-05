<?php
require '../../model/modelo_producto.php';
$MPR=new Modelo_Producto();
$producto=htmlspecialchars($_POST['producto'], ENT_QUOTES, 'UTF-8');
$nombre_archivo=htmlspecialchars($_POST['nombre_archivo'],ENT_QUOTES,'UTF-8');

if(is_array($_FILES) && count($_FILES)>0){
    if(move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$nombre_archivo)){
        $ruta="../controller/producto/img/".$nombre_archivo;
        $consulta=$MPR->editar_foto_producto($producto,$ruta);
        echo $consulta;
    }else{
        echo 0;
    }
}else{
    echo 0;
}

