<?php
  require '../../model/modelo_ingreso.php';
  $MI=new Modelo_Ingreso();
  $consulta=$MI->listar_combo_producto();
  echo json_encode($consulta);