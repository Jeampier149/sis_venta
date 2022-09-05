<?php
require '../../model/modelo_usuario.php';
$MU=new Modelo_Usuario();
$consulta=$MU->listar_combo_persona();
echo json_encode($consulta);