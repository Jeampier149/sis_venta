
<?php
require '../../model/modelo_rol.php';
$MR=new Modelo_Rol();
$id=htmlspecialchars(trim($_POST['id']),ENT_QUOTES,'UTF-8');
$rol_actual=htmlspecialchars(trim($_POST['rol_actual']),ENT_QUOTES,'UTF-8');
$rol_new=htmlspecialchars(trim($_POST['rol_new']),ENT_QUOTES,'UTF-8');
$estado=htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
$consulta=$MR->editarRol($id,$rol_actual,$rol_new,$estado);
  echo $consulta;
