<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$persona = new persona();
$filter = '';
if($_REQUEST['nombre'] != '') $filter .= " AND (persona.nombre1 LIKE '%".$_REQUEST['nombre']."%' OR persona.nombre2 LIKE '%".$_REQUEST['nombre']."%')";
if($_REQUEST['apellido'] != '') $filter .= " AND (persona.apellido1 LIKE '%".$_REQUEST['apellido']."%' OR persona.apellido2 LIKE '%".$_REQUEST['apellido']."%')";
if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] != ''){
     $filter .= " AND (persona.fechanacimiento>='".$_REQUEST['fechainicial']."' AND persona.fechanacimiento<='".$_REQUEST['fechafinal']."')";
} else if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] == ''){   
    $filter .= " AND persona.fechanacimiento>='".$_REQUEST['fechainicial']."'";
} elseif($_REQUEST['fechainicial'] == '' && $_REQUEST['fechafinal'] != ''){  
   $filter .= " AND persona.fechanacimiento<='".$_REQUEST['fechafinal']."'";
} 
$personasbd = $persona->readDataFilter("persona.idpersona>0 ".$filter);
foreach($personasbd as $key => $personavalor) {
    $personabd = $persona->getPersona($personavalor); 
    $ciudadanobd = $personabd->getCiudadano();
    $personavalor['cedula'] = $ciudadanobd->request['cedula'];  
    $personasbd[$key] = $personavalor;
} 
$smarty->assign('personasbd',$personasbd);  
$smarty->assign('nombre',$_REQUEST['nombre']); 
$smarty->assign('apellido',$_REQUEST['apellido']); 
$smarty->assign('fechainicial',$_REQUEST['fechainicial']);
$smarty->assign('fechafinal',$_REQUEST['fechafinal']); 
$smarty->assign('camino','>> Personas >> Listado');  
$smarty->assign('template','personas/listadopersonas.tpl');      
$smarty->display('layout.tpl');  
?>
