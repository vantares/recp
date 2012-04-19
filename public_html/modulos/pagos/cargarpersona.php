<?php
include_once('../../common.inc.php');
$cedula = $_REQUEST['idpersona'];
if($cedula != '') {
    $personas = new persona();
    $personabd = $personas->getPersonaByCedula($cedula);
    $smarty->assign('add','add');
    
    if($personabd->request['nombre1'] != '') {
        //Datos de la Persona 
        $persona->request['nombre'] =  $personabd->request['nombre1'].' '.$personabd->request['nombre2'].' '.$personabd->request['apellido1'].' '.$personabd->request['apellido2'];
        $persona->request['edad'] = $personabd->getEdad();
        $persona->request['ocupacion'] = $personabd->request['ocupacion']; 
        $persona->request['domicilio'] = $personabd->request['domicilio'];
        $persona->request['nacionalidad'] = $personabd->request['nacionalidad'];
        $persona->request['cedula'] = $personabd->getCiudadano()->request['cedula'];
        $persona->request['estadocivil'] = $personabd->request['estadocivil'];    
        $persona->request['municipio'] = $personabd->getCiudadano()->request['municipio']; 
        $persona->request['ciudad'] = $personabd->getCiudadano()->request['ciudad']; 
        $persona->request['departamento'] = $personabd->getCiudadano()->request['departamento']; 
        $persona->request['pais'] = $personabd->request['paisnacimiento']; 
        $persona->request['idpersona'] = $personabd->request['idpersona'];   
        if($_REQUEST['tipo'] == 'fallecido') {
            //Causa de muertes
            $muertes = new causamuerteTable();
            $arrayCausaMuertes = $muertes->readData();
            $smarty->assign('arrayCausaMuertes',$arrayCausaMuertes);         
        }    
        if($_REQUEST['inscrito'] == 1) {
            $persona->request['nombre1'] = $personabd->request['nombre1'];
            $persona->request['nombre2'] = $personabd->request['nombre2'];
            $persona->request['apellido1'] = $personabd->request['apellido1']; 
            $persona->request['apellido2'] = $personabd->request['apellido2'];  
        }    
        $smarty->assign('persona',$persona);
         
    } else {      
        $smarty->assign('error','La Persona no esta registrada en el sistema <span class="chequear"><a href="/modulos/personas/addpersona.php" target="_blank">Ingresar aqui</a></span>'); 
    }    
}else {
    $smarty->assign('error','La Persona no esta registrada en el sistema <span class="chequear"><a href="/modulos/personas/addpersona.php" target="_blank">Ingresar aqui</a></span>');  
}
$smarty->display($_REQUEST['template']); 
?>
