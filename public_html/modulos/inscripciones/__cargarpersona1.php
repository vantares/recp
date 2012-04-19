<?php
include_once('../../common.inc.php');
$persona = new persona();
$personabd = $persona->getPersona($_REQUEST['idpersona']);
if($personabd != '') {
    //Datos de la Persona 
    $arrayPersona[$_REQUEST['tipo']]['nombre1'] =  $personabd->request['nombre1'];
    $arrayPersona[$_REQUEST['tipo']]['nombre2'] =  $personabd->request['nombre2'];  
    $arrayPersona[$_REQUEST['tipo']]['apellido1'] =  $personabd->request['apellido1'];
    $arrayPersona[$_REQUEST['tipo']]['apellido2'] =  $personabd->request['apellido2']; 
    $arrayPersona[$_REQUEST['tipo']]['edad'] = $personabd->getEdad();
    $arrayPersona[$_REQUEST['tipo']]['oficio'] = $personabd->request['ocupacion']; 
    $arrayPersona[$_REQUEST['tipo']]['domicilio'] = $personabd->request['domicilio'];
    $arrayPersona[$_REQUEST['tipo']]['nacionalidad'] = $personabd->request['nacionalidad'];
    $arrayPersona[$_REQUEST['tipo']]['cedula'] = $personabd->getCiudadano()->request['cedula'];
    $arrayPersona[$_REQUEST['tipo']]['estadocivil'] = $personabd->request['estadocivil']; 
    $arrayPersona[$_REQUEST['tipo']]['edad'] = $personabd->getEdad();  
    $arrayPersona[$_REQUEST['tipo']]['municipio'] = $personabd->getCiudadano()->request['municipio']; 
    $arrayPersona[$_REQUEST['tipo']]['ciudad'] = $personabd->getCiudadano()->request['ciudad']; 
    $arrayPersona[$_REQUEST['tipo']]['departamento'] = $personabd->getCiudadano()->request['departamento']; 
    $arrayPersona[$_REQUEST['tipo']]['pais'] = $personabd->request['paisnacimiento']; 
    
    if(in_array($_REQUEST['tipo'],array('comparecientes1','comparecientes2'))) {
        $arrayPersona[$_REQUEST['tipo']]['nombre'] =  $personabd->request['nombre1'].' '.$personabd->request['nombre2'].' '.$personabd->request['apellido1'].' '.$personabd->request['apellido2'];
    }
    $smarty->assign('persona',$arrayPersona); 
} else {
    $smarty->assign('error','La Persona no esta registrada en el sistema <span class="chequear"><a href="/modulos/personas/addpersona.php" target="_blank">Ingresar aqui</a></span>'); 
}    

$smarty->assign('add','add');   
$smarty->display($_REQUEST['template']); 
?>