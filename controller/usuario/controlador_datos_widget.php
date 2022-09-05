<?php
require '../../model/modelo_usuario.php';
$MU=new Modelo_Usuario();
$inicio=htmlspecialchars($_POST['inicio'], ENT_QUOTES, 'UTF-8');
$fin=htmlspecialchars($_POST['fin'],ENT_QUOTES,'UTF-8');
$consulta=$MU->datos_widget($inicio,$fin);
echo json_encode($consulta);