<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$persona = new persona();
$filter = '';
$limit= 5000;
$offset= 1;
$persona->limit=5000;

if($_REQUEST['nombre'] != '') $filter .= " AND (persona.nombre1 ILIKE '%".$_REQUEST['nombre']."%' OR persona.nombre2 ILIKE '%".$_REQUEST['nombre']."%')";
if($_REQUEST['apellido'] != '') $filter .= " AND (persona.apellido1 ILIKE '%".$_REQUEST['apellido']."%' OR persona.apellido2 ILIKE '%".$_REQUEST['apellido']."%')";
if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] != ''){
     $filter .= " AND (persona.fechanacimiento >= '".$_REQUEST['fechainicial']."' AND persona.fechanacimiento <= '".$_REQUEST['fechafinal']."')";
} else if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] == ''){   
    $filter .= " AND persona.fechanacimiento>='".$_REQUEST['fechainicial']."'";
} elseif($_REQUEST['fechainicial'] == '' && $_REQUEST['fechafinal'] != ''){  
   $filter .= " AND persona.fechanacimiento<='".$_REQUEST['fechafinal']."'";
} 
$personasbd = $persona->readDataSQL("SELECT persona.idpersona,
                                            persona.nombre1,
                                            persona.nombre2,
                                            persona.apellido1,
                                            persona.apellido2,
                                            persona.fechanacimiento,
                                            ciudadano.cedula
                                       FROM persona
                                 LEFT OUTER JOIN ciudadano 
                                         ON persona.idpersona = ciudadano.idciudadano
                                      WHERE persona.idpersona > 0 ".$filter . "LIMIT ". $limit ." OFFSET " . $offset);                                         
$cadena = new TCadena();
if($personasbd) {
   $smarty->assign('personasbd',$cadena->convert_sqlData_toString($personasbd));  
}
$smarty->assign('nombre',$_REQUEST['nombre']); 
$smarty->assign('apellido',$_REQUEST['apellido']); 
$smarty->assign('fechainicial',$_REQUEST['fechainicial']);
$smarty->assign('fechafinal',$_REQUEST['fechafinal']); 
$smarty->assign('camino','>> Personas >> Listado');  
$smarty->assign('template','personas/listadopersonas.tpl');      
$smarty->display('layout.tpl');  
?>
