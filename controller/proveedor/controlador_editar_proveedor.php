<?php 
require '../../model/modelo_proveedor.php';
$MPV=new Modelo_Proveedor();
$id=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
$razon=htmlspecialchars($_POST['razon'],ENT_QUOTES,'UTF-8');
$contacto=htmlspecialchars($_POST['contacto'],ENT_QUOTES,'UTF-8');
$num_contacto=htmlspecialchars($_POST['num_contacto'],ENT_QUOTES,'UTF-8');
$consulta=$MPV->editar_proveedor($id,$razon,$contacto,$num_contacto);
echo $consulta;