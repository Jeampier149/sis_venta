<?php
  require '../../model/modelo_ingreso.php';
  $MI=new Modelo_Ingreso();
  $fechaini=htmlspecialchars($_POST['fechainicio'],ENT_QUOTES,'UTF-8');
  $final=htmlspecialchars($_POST['fechafin'],ENT_QUOTES,'UTF-8');
  $consulta=$MI->listarIngreso($fechaini,$final);
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