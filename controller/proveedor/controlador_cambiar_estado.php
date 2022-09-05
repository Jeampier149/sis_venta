<?php 
require '../../model/modelo_proveedor.php';
$MPV=new Modelo_Proveedor();
$id=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
$estado=htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
$consulta=$MPV->editar_estado_proveedor($id,$estado);
echo $consulta;