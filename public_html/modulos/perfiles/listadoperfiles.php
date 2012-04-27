<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);

if($usuario->checkCredenciales(array('Administracion', 'Definir Perfiles'))) {   
   $perfiles = new perfil();                                                     
   //Elimino el perfil 
   if((isset($_GET['idperfil'])&&($_GET['idperfil'] !=''))){
   //if((isset($_GET['idperfil'])){
        $perfiles->deleteRecord($_GET['idperfil']);
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
