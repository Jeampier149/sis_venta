<?php
require '../../model/modelo_producto.php';
$MPR=new Modelo_Producto();
$consulta=$MPR->listar_combo_categoria();
echo json_encode($consulta);