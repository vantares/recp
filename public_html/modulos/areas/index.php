<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion', 'Gestionar Areas'))) {
   $areas = new area();
   if((isset($args[1])&&(($args[1]) !=''))){
        $area = $areas->getArea($args[1]); 
        $areas->deleteRecord($args[1]);
        //Registro el evento
        $evento = new evento();      
        $evento->request['descripcion'] = "Se ha eliminado el area ".$area->request['nombre']; 
        $evento->request['tipoevento'] = "Eliminar area";
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord(); 
   }
   
   $arrayAreas = $areas->readData();
    
   $smarty->assign('arrayAreas',$arrayAreas); 
   $smarty->assign('titular','Listado de Areas ');
   $smarty->assign('template','areas/listadoareas.tpl');
   $smarty->display('layout.tpl');
} else {
   header("location: /login.php"); 
}    
?>
