<?php
require '../../model/modelo_categoria.php';
$MC=new Modelo_Categoria();
$categoria=htmlspecialchars(trim($_POST['categoria']),ENT_QUOTES,'UTF-8');
$consulta=$MC->registrarCategoria($categoria);
  echo $consulta;
