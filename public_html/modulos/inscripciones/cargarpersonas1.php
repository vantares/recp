<?php
include_once('../../common.inc.php');
$smarty->assign('add','add'); 
$filter = '';
if(in_array($_REQUEST['tipo'],array('compareciente1','compareciente2'))) {
   if($_REQUEST['nombre'] != '') { 
       $nombres = explode(' ', $_REQUEST['nombre']);
       $_REQUEST['nombre1'] =  $nombres[0];
       $_REQUEST['nombre2'] =  $nombres[1];
       $_REQUEST['apellido1'] =  $nombres[2]; 
       $_REQUEST['apellido2'] =  $nombres[3];       
   } else {
       $_REQUEST['nombre1'] =  '';
       $_REQUEST['nombre2'] =  '';
       $_REQUEST['apellido1'] =  ''; 
       $_REQUEST['apellido2'] =  '';     
   }    

} 

if($_REQUEST['nombre1'] != '') $filter .= " AND (persona.nombre1 ILIKE '%".$_REQUEST['nombre1']."%')";
if($_REQUEST['nombre2'] != '') $filter .= " AND (persona.nombre2 ILIKE '%".$_REQUEST['nombre2']."%')";
if($_REQUEST['apellido1'] != '') $filter .= " AND (persona.apellido1 ILIKE '%".$_REQUEST['apellido1']."%')";
if($_REQUEST['apellido2'] != '') $filter .= " AND (persona.apellido2 ILIKE '%".$_REQUEST['apellido2']."%')";
if($_REQUEST['cedula'] != '') $filter .= " AND (ciudadano.cedula='".$_REQUEST['cedula']."')";
    
$sql = "SELECT persona.*,
               ciudadano.cedula 
          FROM persona 
    INNER JOIN ciudadano
            ON persona.idpersona = ciudadano.idciudadano
         WHERE persona.idpersona != -1 ".$filter;
         
$personas = new persona();
$arrayResultados = $personas->readDataSQL($sql);
if(count($arrayResultados) > 0) {
    $smarty->assign('arrayresultados',$arrayResultados);    
    $smarty->assign('tipo',$_REQUEST['tipo']);
} else {
    $smarty->assign('error','No hay personas registradas con esos datos en el sistema'); 
}  
$smarty->display($_REQUEST['template']);         
?>
