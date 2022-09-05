<?php 
require '../../model/modelo_usuario.php';
$MU=new Modelo_Usuario();
$id=htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
$consulta=$MU->traer_datos($id);
echo json_encode($consulta);