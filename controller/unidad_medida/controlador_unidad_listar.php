<?php
require '../../model/modelo_unidad_medida.php';
$MUM=new Modelo_Unidad_Medida();
$consulta=$MUM->listar_unidad();
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