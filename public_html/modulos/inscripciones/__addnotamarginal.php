<?php
include_once('../../common.inc.php'); 
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    $inscripcion = new inscripcion();
    $inscripcionbd = $inscripcion->getInscripcion($_POST['idinscripcion']);
    $actabd = $inscripcionbd->getActa();
    //Asiento de la nota marginal
    $asientonota = new asientoregistral();
    $_REQUEST['fecha'] = date('Y-m-d');
    $asientonota->readEnv();
    try {
        $asientonota->addRecord();
    }
    catch (Exception $e) {
        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
        $error = true;
    } 
    if(!$error) {   
        $notamarginal = new notamarginal();
        $_REQUEST['idnotamarginal'] = $asientonota->getlastId();
        /*$_REQUEST['tomoinscripcion'] = $actabd->request['idtomo'];
        $_REQUEST['folioinscripcion'] = $actabd->request['folio'];
        $_REQUEST['partidainscripcion'] = $actabd->request['partida'];
        $fecha = explode('-',$actabd->request['fecha']);
        $_REQUEST['anyoinscripcion'] = $fecha[0];*/
	
        $_REQUEST['idinscripcion'] = $_POST['idinscripcion'];
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
               $url = '/modulos/inscripciones/repomatrimonio.php';
          break;   
          case 'Reposicion Defuncion':
               $url = '/modulos/inscripciones/editrepodefuncion.php';
          break;                     
        }           
        $_REQUEST['libroinscripcion'] = $inscripcionbd->request['tipoinscripcion'];
        $_REQUEST['lugarinscripcion'] = $inscripcionvariabd->request['ciudadinscripcion'].' '.$inscripcionvariabd->request['municipioinscripcion'];
//TODO: recibir y registrar los campos faltantes de la nota marginal
        $notamarginal->readEnv();
        try {
            $notamarginal->addRecord();  
        }  
        catch (Exception $e) {
            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            $error = true;
        }
    }
    if(!$error) {
        header("Location: ".$url."?id=".$_POST['idinscripcion']);    
    }     
} else {
    header("Location: ./login.php");
}    
?>
