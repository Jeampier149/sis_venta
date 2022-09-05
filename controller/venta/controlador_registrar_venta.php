<?php
  require '../../model/modelo_venta.php';
  $MV=new Modelo_Venta();

  $idusuario=htmlspecialchars($_POST['usuario_id'],ENT_QUOTES,'UTF-8');
  $idcliente=htmlspecialchars($_POST['cliente_id'],ENT_QUOTES,'UTF-8');
  $tipo_c=htmlspecialchars($_POST['tipo_comprobante'],ENT_QUOTES,'UTF-8');
  $serie=htmlspecialchars($_POST['serie_comprobante'],ENT_QUOTES,'UTF-8');
  $num_c=htmlspecialchars($_POST['num_comprobante'],ENT_QUOTES,'UTF-8');
  $impuesto=htmlspecialchars($_POST['impuesto'],ENT_QUOTES,'UTF-8');
  $igv=htmlspecialchars($_POST['igv'],ENT_QUOTES,'UTF-8');
  $total=htmlspecialchars($_POST['total'],ENT_QUOTES,'UTF-8');
  $consulta=$MV-> registrarVenta($idusuario,$idcliente,$tipo_c,$serie,$num_c,$igv,$total,$impuesto);
  echo $consulta;