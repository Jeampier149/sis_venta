<?php
  require '../../model/modelo_persona.php';
  $MP=new Modelo_Persona();
  $error=[];
  $id=htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
  $nombre=htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
  $app=htmlspecialchars($_POST['app'],ENT_QUOTES,'UTF-8');
  $apm=htmlspecialchars($_POST['apm'],ENT_QUOTES,'UTF-8');
  $doc_actual=htmlspecialchars($_POST['documento_actual'],ENT_QUOTES,'UTF-8');
  $doc_nuevo=htmlspecialchars($_POST['documento_nuevo'],ENT_QUOTES,'UTF-8');
  $tipo_doc=htmlspecialchars($_POST['tipo_doc'],ENT_QUOTES,'UTF-8');
  $telefono=htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
  $sexo=htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
  $estado=htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
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
    
    $consulta=$MP->editarPersona($id,$nombre,$app,$apm,$doc_actual,$doc_nuevo,$tipo_doc,$telefono,$sexo,$estado);
    echo $consulta;
  
  }else{
    echo json_encode($error);
  }
  
  


?>