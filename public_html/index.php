<?php
include_once('common.inc.php');
include_once('menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);
$smarty->assign('arrayEventos',$usuario->getLastEvents());
$smarty->assign('template','inicio.tpl');
$smarty->display('layout.tpl');
?>
