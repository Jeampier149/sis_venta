<?php
require '../../model/modelo_proveedor.php';
  $MPV=new Modelo_Proveedor();
  $consulta=$MPV->listarProveedor();
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