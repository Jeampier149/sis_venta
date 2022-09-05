<?php
require '../../model/modelo_usuario.php';
$MU=new Modelo_Usuario();
$usuario=htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
$nombre_archivo=htmlspecialchars($_POST['nombre_archivo'],ENT_QUOTES,'UTF-8');

if(is_array($_FILES) && count($_FILES)>0){
    if(move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$nombre_archivo)){
        $ruta="../controller/usuario/img/".$nombre_archivo;
        $consulta=$MU->editar_foto($usuario,$ruta);
        echo $consulta;
    }else{
        echo 0;
    }
}else{
    echo 0;
}
