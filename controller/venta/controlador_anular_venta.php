<?php
  require '../../model/modelo_venta.php';
  $MV=new Modelo_Venta();

  $id_venta=htmlspecialchars($_POST['id_ven'],ENT_QUOTES,'UTF-8');
  $consulta=$MV-> anularVenta($id_venta);
  echo $consulta;