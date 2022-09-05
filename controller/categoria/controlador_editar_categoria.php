
<?php
require '../../model/modelo_categoria.php';
$MC=new Modelo_Categoria();
$id=htmlspecialchars(trim($_POST['id']),ENT_QUOTES,'UTF-8');
$categoria_actual=htmlspecialchars(trim($_POST['categoria_actual']),ENT_QUOTES,'UTF-8');
$categoria_new=htmlspecialchars(trim($_POST['categoria_new']),ENT_QUOTES,'UTF-8');
$estado=htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
$consulta=$MC->editarCategoria($id,$categoria_actual,$categoria_new,$estado);
  echo $consulta;
