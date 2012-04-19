<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

#if($user->checkCredenciales(array('Certificaciones'))) {
   $incripciones = new inscripcion();
   //$arrayIncripciones = $incripciones->readData();
   
   $filter = '';
   if($_REQUEST['nombre'] != '') $filter .= " AND (inscripcion.inscrito1nombre1 LIKE '%".$_REQUEST['nombre']."%' OR inscripcion.inscrito1nombre2 LIKE '%".$_REQUEST['nombre']."%')";
   //if($_REQUEST['nombre'] != '') $filter .= " AND (usuario.nombreusuario LIKE '%".$_REQUEST['nombre']."%' OR evento.nombreusuario LIKE '%".$_REQUEST['nombre']."%')";
   if($_REQUEST['apellido1'] != '' && $_REQUEST['apellido1'] != '') $filter .= " AND inscripcion.inscrito1apellido1 LIKE '%".$_REQUEST['apellido1']."%'";                                                                            
   /*if($_REQUEST['anyo'] != '' && $_REQUEST['anyo'] == '') //$filter .= " AND inscripcion.inscrito1apellido1 LIKE '%".$_REQUEST['apellido1']."%'";  */
   
   $rubro = "Nacimientos"; 
   if($filter == ''){    
       $inscripcionesdb = $incripciones->readDataFilter("inscripcion.tipoinscripcion = '".$rubro."'");     
   } else {
       $inscripcionesdb = $incripciones->readDataSQL("SELECT inscripcion.*
                                                   FROM inscripcion     
                                                  WHERE inscripcion.tipoinscripcion = '".$rubro."' ".$filter);
   }
    
   $smarty->assign('arrayInscripciones',$inscripcionesdb); 
   $smarty->assign('nombre',$_REQUEST['nombre']);  
   $smarty->assign('apellido1',$_REQUEST['apellido1']);
   $smarty->assign('titular','Listado de Usuarios ');
   $smarty->assign('template','certificaciones/listadocertnacimiento.tpl');
   $smarty->display('layout.tpl');
#} else {
#   header("location: /login.php"); 
#}
?>
