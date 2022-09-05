<?php
  require '../../model/modelo_persona.php';
  $MP=new Modelo_Persona();
  $error=[];
  $nombre=htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
  $app=htmlspecialchars($_POST['app'],ENT_QUOTES,'UTF-8');
  $apm=htmlspecialchars($_POST['apm'],ENT_QUOTES,'UTF-8');
  $doc=htmlspecialchars($_POST['documento'],ENT_QUOTES,'UTF-8');
  $tipo_doc=htmlspecialchars($_POST['tipo_doc'],ENT_QUOTES,'UTF-8');
  $telefono=htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
  $sexo=htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
  if (!preg_match("/^[a-zA-Z ]+$/", $nombre)) {
    $error[] = "El nombre solo debe contener letras";
}
  if(!ctype_alpha($app)){
    $error[]="El apellido paterno solo debe contener letras";
  }
  if(!ctype_alpha($apm)){
    $error[]="El apellido materno solo debe contener letras";
  }
  if(empty($error)){
    
    $consulta=$MP->registrarPersona($nombre,$app,$apm,$doc,$tipo_doc,$telefono,$sexo);
    echo $consulta;
  
  }else{
    echo json_encode($error);
  }
  
  


?>