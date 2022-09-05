<?php
  require '../../model/modelo_ingreso.php';
  $MI=new Modelo_Ingreso();

  $idusuario=htmlspecialchars($_POST['usuario_id'],ENT_QUOTES,'UTF-8');
  $idproveedor=htmlspecialchars($_POST['proveedor_id'],ENT_QUOTES,'UTF-8');
  $tipo_c=htmlspecialchars($_POST['tipo_comprobante'],ENT_QUOTES,'UTF-8');
  $serie=htmlspecialchars($_POST['serie_comprobante'],ENT_QUOTES,'UTF-8');
  $num_c=htmlspecialchars($_POST['num_comprobante'],ENT_QUOTES,'UTF-8');
  $impuesto=htmlspecialchars($_POST['impuesto'],ENT_QUOTES,'UTF-8');
  $igv=htmlspecialchars($_POST['igv'],ENT_QUOTES,'UTF-8');
  $total=htmlspecialchars($_POST['total'],ENT_QUOTES,'UTF-8');
  $consulta=$MI-> registrarIngreso($idusuario,$idproveedor,$tipo_c,$serie,$num_c,$igv,$total,$impuesto);
  echo $consulta;