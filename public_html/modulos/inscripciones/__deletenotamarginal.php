<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($args[1]) && $args[1] > 0) {
        $notamarginal = new notamarginal();
        $inscripcion = new inscripcion();
        $inscripcionbd =  $inscripcion->getInscripcion($args[2]);
        switch ($inscripcionbd->request['tipoinscripcion']) {
          case 'Nacimientos':
               $url = '/modulos/inscripciones/editnacimiento.php';
          break; 
          case 'Matrimonios':
               $url = '/modulos/inscripciones/editmatrimonio.php';
          break;    
          case 'Defunciones':
               $url = '/modulos/inscripciones/editdefuncion.php';
          break;  
          case 'Reposicion Nacimiento':
               $url = '/modulos/inscripciones/editreponacimiento.php';   
          break; 
          case 'Disolucion Vinculo Matrimonial':
               $url = '/modulos/inscripciones/editdisolucionmatrimonio.php';
          break;   
          case 'Inscripciones Varias':
               $url = '/modulos/inscripciones/editinscripcionvaria.php';
          break;    
          case 'Reposicion Matrimonio':
               $url = '/modulos/inscripciones/reposicionmatrimonio.php';
          break;            
        }         
        $notamarginal->deleteRecord($args[1]);
    }
    
    header("Location: ".$url."?id=".$args[2]);   
} else {
    header("Location: ./login.php");
}      
?>
