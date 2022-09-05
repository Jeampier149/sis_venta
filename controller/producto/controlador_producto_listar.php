<?php
require '../../model/modelo_producto.php';
  $MPR=new Modelo_Producto();
  $consulta=$MPR->listarProducto();
   if($consulta){
       echo json_encode($consulta);
   }else{
    echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';

   }
   
?>