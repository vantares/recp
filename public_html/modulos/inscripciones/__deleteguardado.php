<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($args[1]) && $args[1] > 0) {
        $guardado = new guarda();
        $guardado->deleteRecord($args[1]);
    }
    header("Location: /modulos/inscripciones/editdisolucionmatrimonio.php?id=".$args[2]);   
} else {
    header("Location: ./login.php");
}      
?>
