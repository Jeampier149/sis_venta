<?php
require '../../model/modelo_unidad_medida.php';
$MUM=new Modelo_Unidad_Medida();
$id=htmlspecialchars(trim($_POST['id']),ENT_QUOTES,'UTF-8');
$unidad_actual=htmlspecialchars(trim($_POST['unidad_actual']),ENT_QUOTES,'UTF-8');
$abrev_actual=htmlspecialchars(trim($_POST['abrev_actual']),ENT_QUOTES,'UTF-8');
$unidad_nueva=htmlspecialchars(trim($_POST['unidad_new']),ENT_QUOTES,'UTF-8');
$abrev_nueva=htmlspecialchars(trim($_POST['abrev_new']),ENT_QUOTES,'UTF-8');
$estado=htmlspecialchars(trim($_POST['estado']),ENT_QUOTES,'UTF-8');
$consulta=$MUM->editar_unidad($id,$unidad_actual,$unidad_nueva,$abrev_actual,$abrev_nueva,$estado);
echo $consulta;