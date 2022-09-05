<?php
  require '../../model/modelo_venta.php';
  $MV=new Modelo_Venta();
  $consulta=$MV->listar_combo_cliente();
  echo json_encode($consulta);