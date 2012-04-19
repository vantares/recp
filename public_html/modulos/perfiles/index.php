<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion', 'Definir Perfiles'))) {   
   $perfiles = new perfil();   
   //Elimino el perfil 
   if((isset($_GET['idperfil'])&&($_GET['idperfil'] !=''))){
        $perfil = $perfiles->getPerfil($_GET['idperfil']);
   	    $perfiles->deleteRecord($_GET['idperfil']);
        //Registro el evento
        $evento = new evento();      
        $evento->request['descripcion'] = "Se ha eliminado el perfil ".$perfil->request['nombre']; 
        $evento->request['tipoevento'] = "Eliminar perfil";
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();  
   }
      
   $arrayPerfiles = $perfiles->readData();
      
   $smarty->assign('arrayPerfiles',$arrayPerfiles); 
   $smarty->assign('titular','Listado de Perfiles ');
   $smarty->assign('template','perfiles/listadoperfiles.tpl');
   $smarty->display('layout.tpl');
} else {
   header("location: /login.php"); 
} 
?>