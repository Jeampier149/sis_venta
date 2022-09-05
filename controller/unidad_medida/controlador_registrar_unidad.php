<?php
require '../../model/modelo_unidad_medida.php';
$MUM=new Modelo_Unidad_Medida();
$unidad=htmlspecialchars(trim($_POST['unidad_medida']),ENT_QUOTES,'UTF-8');
$abrev=htmlspecialchars(trim($_POST['unidad_abreviatura']),ENT_QUOTES,'UTF-8');
$consulta=$MUM->registrar_unidad($unidad,$abrev);
echo $consulta;