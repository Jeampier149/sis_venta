<?php
  require '../../model/modelo_ingreso.php';
  $MI=new Modelo_Ingreso();

  $id_ingreso=htmlspecialchars($_POST['id_ing'],ENT_QUOTES,'UTF-8');
  $consulta=$MI-> anularIngreso($id_ingreso);
  echo $consulta;