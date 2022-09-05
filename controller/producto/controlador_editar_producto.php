<?php
require '../../model/modelo_producto.php';
$MPR=new Modelo_Producto();
$error=[];
$id=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
$presentacion=htmlspecialchars($_POST['presentacion'],ENT_QUOTES,'UTF-8');
$producto=htmlspecialchars($_POST['producto'],ENT_QUOTES,'UTF-8');
$producto_actual=htmlspecialchars($_POST['producto_actual'],ENT_QUOTES,'UTF-8');
$categoria=htmlspecialchars($_POST['categoria'],ENT_QUOTES,'UTF-8');
$unidad=htmlspecialchars($_POST['unidad'],ENT_QUOTES,'UTF-8');
$estado=htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
$precio=htmlspecialchars($_POST['precio'],ENT_QUOTES,'UTF-8');

if (!preg_match('/^[0-9 .]*$/', $precio)) {
    $error[]="El precio solo debe contener numeros";
}

if(empty($error)) {
    $consulta=$MPR->editar_producto($id,$producto,$producto_actual,$presentacion,$categoria,$unidad,$precio,$estado);
    echo $consulta;
}else{
    echo json_encode($error);
}