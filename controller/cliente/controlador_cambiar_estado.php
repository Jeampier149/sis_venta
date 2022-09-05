<?php 
require '../../model/modelo_cliente.php';
$MCL=new Modelo_Cliente();
$id=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
$estado=htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
$consulta=$MCL->editar_estado_cliente($id,$estado);
echo $consulta;