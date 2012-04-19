<?php
include_once('../../common.inc.php');
/*
 * este script carga la lista de personas coincidentes por con el numero de cedula ingresado
 * u otro parametro de busqueda ingresado
 **/
$smarty->assign('add','add'); 
$filter = '';
if(in_array($_REQUEST['tipo'],array('comparecientes1','comparecientes2','persona','padre','madre'))) {
   if($_REQUEST['nombre'] != '') {
       $nombrebd = explode(' ',trim($_REQUEST['nombre']));
	echo "<!-- resultados para : ". $_REQUEST['nombre']. " -->";
       switch (count($nombrebd)) {
           case 4:
                $nombre1 = $nombrebd[0];
                $nombre2 = $nombrebd[1];
                $apellido1 = $nombrebd[2];
                $apellido2 = $nombrebd[3];
                break;
           case 3:
                $nombre1 = $nombrebd[0];
                $apellido1 = $nombrebd[1];
                $apellido2 = $nombrebd[2];
                break;
           case 2:
                $nombre1 = $nombrebd[0];
                $apellido1 = $nombrebd[1];
                break;
           case 1:
                $nombre1 = $nombrebd[0];
                break;
       }
       $_REQUEST['nombre1']   =  $nombre1;
       $_REQUEST['nombre2']   =  $nombre2;
       $_REQUEST['apellido1'] =  $apellido1;
       $_REQUEST['apellido2'] =  $apellido2;
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
if($_REQUEST['cedula'] != '' && $_REQUEST['cedula'] != 'undefined') $filter .= " AND (ciudadano.cedula='".$_REQUEST['cedula']."')";
if($filter != '') {
    $sql = "SELECT persona.*,
                   ciudadano.cedula 
              FROM persona 
   LEFT OUTER JOIN ciudadano
                ON persona.idpersona = ciudadano.idciudadano
             WHERE persona.idpersona != -1 ".$filter;
         
    $personas = new persona();
    $arrayResultados = $personas->readDataSQL($sql);
    if(count($arrayResultados) > 0) {
        $smarty->assign('arrayresultados',$arrayResultados);    
        $smarty->assign('tipo',$_REQUEST['tipo']);
        $smarty->assign('module',$_REQUEST['module']);
    } else {
        $smarty->assign('error','No hay personas registradas con esos datos en el sistema'); 
    } 
} else {
    $smarty->assign('error','Para mostrar resultados debe introducir un criterio de busqueda, nombre o cedula');
}
$smarty->assign('defuncionb',$_REQUEST['defuncionb']);
$smarty->display($_REQUEST['template']);         
?>
