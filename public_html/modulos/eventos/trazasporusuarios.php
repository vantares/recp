<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion','Monitoreo Trazas'))) {
    $eventos = new evento();
    $sql = "SELECT nombreusuario FROM evento GROUP BY nombreusuario ORDER BY nombreusuario";
    $arrayTrazas =  $eventos->readDataSQL($sql);
    
    $perfiles = new perfil();
    $roles  = new rolTable();
    $arrayRoles = $roles->readData();
    $arrayPerfiles =  $perfiles->readData();

    $smarty->assign('arrayPerfiles',$arrayPerfiles); 
    $smarty->assign('arrayRoles',$arrayRoles);
    $smarty->assign('arrayTrazas',$arrayTrazas); 
    $smarty->assign('titular','Listado de Usuarios');
    $smarty->assign('template','eventos/listadousuarioseventos.tpl');
    $smarty->display('layout.tpl');  
} else {
   header("location: /login.php"); 
}   

   
?>
