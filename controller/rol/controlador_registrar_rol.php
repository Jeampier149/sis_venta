<?php
require '../../model/modelo_rol.php';
$MR=new Modelo_Rol();
$rol=htmlspecialchars(trim($_POST['rol']),ENT_QUOTES,'UTF-8');
$consulta=$MR->registraRol($rol);
  echo $consulta;
