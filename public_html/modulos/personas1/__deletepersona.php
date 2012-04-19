<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Personas'))) { 
    if(isset($args[1]) && $args[1] > 0) {
        $persona = new persona();
        $personabd = $persona->getPersona($args[1]);
        $personabd->delete();
    }
    header("Location: /modulos/personas/");   
} else {
    header("Location: ./login.php");
}      
?>
