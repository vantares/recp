<?php
define('LOGIN',1);
include_once('common.inc.php');   
include_once($_SERVER['DOCUMENT_ROOT'] . '/../classes/app.class.php');  
$usuarios = new usuario();
if(isset($_POST['usuario'])) {
  $iduser = $usuarios->checkUser($_POST['usuario'],$_POST['password'],$error);
  if($iduser > 0) {
     //Cargo las Credenciales y el Perfil del Usuario 
     $usuariobd =  $usuarios->getUser($iduser); 
     $_SESSION['usuario'] = $usuariobd->request['nombreusuario'];  
     $_SESSION['idusuario'] = $usuariobd->request['idusuario'];
     $_SESSION['autenticacion'] = 1; 
     $_SESSION['rol'] =  $usuariobd->getRol();
     //Asigno las areas que van en el menu
     $areas = $usuariobd->getAreas();  
     $arrayAreas = '';
     $areasbd = new area();
     foreach($areas as $area) {
         $areabd = $areasbd->getArea($area['idarea']);
         $arrayAreas[$area['idarea']] = $area['nombre'];
         $arraysubAreas[$area['idarea']] =  $areabd->getSubAreas();  
     } 
     $_SESSION['areas'] =  $arrayAreas;
     $_SESSION['subareas'] = $arraysubAreas;   
     //Registro el evento
     $evento = new evento();
     $evento->request['tipoevento'] = 'autenticacion';
     $evento->request['nombreusuario'] = $usuariobd->request['nombre']; 
     $evento->request['clave'] = $usuariobd->request['clave']; 
     $evento->request['cliente'] = $_SERVER['REMOTE_ADDR'];  
     $evento->request['descripcion'] = 'Se autenticaron en el sistema'; 
     $evento->request['fechaocurrencia'] = date('Y-m-d');
     $evento->addRecord();       
     header("location: /index");  
  } else {
      $smarty->assign('erroruser',$error);
  }    
}
$smarty->display('login.tpl');
?>