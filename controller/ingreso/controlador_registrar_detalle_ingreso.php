<?php
  require '../../model/modelo_ingreso.php';
  $MI=new Modelo_Ingreso();

  $id=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
  $producto=$_POST['arr_producto'];
  $precio=$_POST['arr_precio'];
  $cantidad=$_POST['arr_cantidad'];

  $array_producto=json_decode($producto);
  $array_precio=json_decode($precio);
  $array_cantidad=json_decode($cantidad);

 for ($i=0; $i<count($array_producto); $i++) { 
    $consulta=$MI-> registrar_detalle_ingreso($id,$array_producto[$i],$array_precio[$i],$array_cantidad[$i]);
 }

 echo $consulta;
  
 ?>