<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Certificaciones'))) {
    $inscripciones = new inscripcion();
    $inscripcion = $inscripciones->getInscripcion($args[1]);
    $hechovital = $inscripcion->getHechoVital();
    $defuncion = $hechovital->getDefuncion();
    $acta = $inscripcion->getActa();
    $tomo = $acta->getNoTomo();
    
    //Lleno los datos madre   
    $madre->request['edad'] = $nacimiento->request['edadmadre'];
    $madre->request['oficio'] = $nacimiento->request['oficiomadre'];
    $madre->request['domicilio'] = $nacimiento->request['domiciliomadre'];
    $madre->request['nacionalidad'] = $nacimiento->request['nacionalidadmadre']; 
    $madre->request['cedula'] = $nacimiento->request['cedulamadre'];
    $madre->request['nombre'] = $hechovital->request['nombremadre']; 
    //Lleno los datos padre   
    $padre->request['edad'] = $nacimiento->request['edadpadre'];
    $padre->request['oficio'] = $nacimiento->request['oficiopadre'];
    $padre->request['domicilio'] = $nacimiento->request['domiciliopadre'];
    $padre->request['nacionalidad'] = $nacimiento->request['nacionalidadpadre']; 
    $padre->request['cedula'] = $nacimiento->request['cedulapadre'];
    $padre->request['nombre'] = $hechovital->request['padrenombre'];
    //Lleno los datos del compareciente1  
    $compareciente1->request['cedula'] = $inscripcion->request['compareciente1cedula'];
    $compareciente1->request['nombre'] = $inscripcion->request['compareciente1nombre']; 
    $compareciente1->request['edad'] = $inscripcion->request['compareciente1edad']; 
    $compareciente1->request['oficio'] = $inscripcion->request['compareciente1oficio']; 
    $compareciente1->request['domicilio'] = $inscripcion->request['compareciente1domicilio']; 
    $compareciente1->request['nacionalidad'] = $nacimiento->request['compareciente1nacionalidad']; 
    //Lleno los datos del compareciente2   
    $compareciente2->request['cedula'] = $nacimiento->request['compareciente2cedula'];
    $compareciente2->request['nombre'] = $nacimiento->request['compareciente2nombre']; 
    $compareciente2->request['edad'] = $nacimiento->request['compareciente2edad']; 
    $compareciente2->request['oficio'] = $nacimiento->request['compareciente2oficio']; 
    $compareciente2->request['domicilio'] = $nacimiento->request['compareciente2domicilio']; 
    $compareciente2->request['nacionalidad'] = $nacimiento->request['compareciente2nacionalidad'];     
  
    if((isset($_POST['certificar'])) && ($_POST['certificar'] == 'certificar')) {
    
    }
    
    $smarty->assign('madre',$madre); 
    $smarty->assign('padre',$padre);
    $smarty->assign('compareciente1',$compareciente1);
    $smarty->assign('compareciente2',$compareciente2);
    $smarty->assign('inscripcion',$inscripcion);
    $smarty->assign('hechovital',$hechovital);  
    $smarty->assign('acta',$acta); 
    $smarty->assign('tomo',$tomo);
    $smarty->assign('url','/modulos/certificaciones/addcertnacimiento');
    $smarty->assign('camino','>> Certificaciones >> Nacimientos >> Nueva');
    $smarty->assign('template','certificaciones/nacimiento.tpl');  
    $smarty->display('layout.tpl');
}else {
   header("location: /login.php"); 
}  
?>
