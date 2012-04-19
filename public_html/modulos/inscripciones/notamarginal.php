<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) { 
   $notamarginal = new notamarginal();
   $notamarginalbd = $notamarginal->getNotamarginal($args[1]);
   $smarty->assign('notamarginalbd',$notamarginalbd);
   $smarty->assign('template','inscripciones/notamarginal.tpl');
   $smarty->display('layout.tpl'); 
} else {
    header("Location: ./login.php");
}   
?>
