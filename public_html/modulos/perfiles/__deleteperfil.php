<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Administracion', 'Definir Perfiles'))) {   
   if(isset($args[1])) {
   	$perfiles = new perfil();                                                     
        $perfilbd = $perfiles->getPerfil($args[1]);
        $perfilbd->deleteRecord($_args[1]);
    }
    header("Location: /modulos/perfiles");   
} else {
    header("Location: ./login.php");
}      
?>
