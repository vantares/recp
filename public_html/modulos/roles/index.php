<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);

if($usuario->checkCredenciales(array('Administracion','Definir Roles'))) {   
   $roles = new rol();   
   //Eliminar el rol 
   if((isset($args[1])&&($args[1] !=''))){
        $rol = $roles->getRol($args[1]);
        $rol1 = $roles->getRol($args[1]); 
        $rol->delete();
        //Registro el evento
        $evento = new evento();      
        $evento->request['descripcion'] = "Se ha eliminado el rol ".$rol1->request['nombrerol']; 
        $evento->request['tipoevento'] = "Eliminar rol";
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();
   }   
   $arrayRoles = $roles->readData();
   
   $smarty->assign('arrayRoles',$arrayRoles); 
   $smarty->assign('titular','Listado de Roles ');
   $smarty->assign('template','roles/listadoroles.tpl');
   $smarty->display('layout.tpl');
} else {
   header("location: /login.php"); 
}  
    
?>