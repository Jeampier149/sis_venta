<?php
require '../../model/modelo_usuario.php';
$MU=new Modelo_Usuario();
$id=htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
$email_actual=htmlspecialchars($_POST['email_actual'],ENT_QUOTES,'UTF-8');
$rol=htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
$persona=htmlspecialchars($_POST['persona'],ENT_QUOTES,'UTF-8');
$estado=htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
$consulta=$MU->editar_usuario($id,$email,$email_actual,$rol,$persona,$estado);
echo $consulta;