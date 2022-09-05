<?php
  require '../../model/modelo_rol.php';
  $MR=new Modelo_Rol();
  $consulta=$MR->listarRol();
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
   
