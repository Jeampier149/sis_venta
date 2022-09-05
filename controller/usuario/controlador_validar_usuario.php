<?php
require '../../model/modelo_usuario.php';
$MU=new Modelo_Usuario();
$user=htmlspecialchars($_POST['user'],ENT_QUOTES,'UTF-8');
$password=htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
$respuesta=$MU->verificarUsuario($user,$password);
$data=json_encode($respuesta);
if(count($respuesta)>0){
    echo $data;
}else{
    echo 0;
}
