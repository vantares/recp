<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);
//Para windows
if(isset($_REQUEST['idlibro'])) $args[1] = $_REQUEST['idlibro']; 
if($usuario->checkCredenciales(array('Libros Registrales', 'Crear Libro Registral'))) {
   if(isset($args[1]))$_SESSION['libroregistral'] = $args[1];  
   if((isset($args[1]) && ($args[1] > 0)) || (isset($_SESSION['libroregistral'])) ) {
       $tomos = new tomo();
       //busqueda por rubro
       $estado = $_POST['estado'];
       if((isset($_POST['estado']) &&  $_POST['estado'] != ''))  {
           $arrayTomos = $tomos->readDataFilter("tomo.idlibro=".$_SESSION['libroregistral']." AND estado='".$estado."'");
       } else {
           $arrayTomos = $tomos->readDataFilter('tomo.idlibro='.$_SESSION['libroregistral']);
       } 
       if(is_array($arrayTomos)) { 
           foreach($arrayTomos as $key => $tomo) {
               $tomobd = $tomos->getTomo($tomo['idtomo']);
               $apertura = $tomobd->getApertura();
               $cierre = $tomobd->getCierre();  
               $tomo['cantpartidas'] = $tomobd->getCantpartidas();
               $tomo['cantfolios'] = $tomobd->getCantFolios();
               $cierretomo = ($cierre->request['fecha'] != '') ? strftime('%d-%m-%Y',strtotime($cierre->request['fecha'])) : '';
               $aperturatomo = ($apertura['fecha'] != '') ? strftime('%d-%m-%Y',strtotime($apertura['fecha'])) : '';
               $tomo['fechaapertura'] = $aperturatomo;
               $tomo['fechacierre'] = $cierretomo; 
               $arrayTomos[$key] = $tomo;     
           }
       }  
       $libro = new libroregistral();
       $librobd = $libro->getLibro($_SESSION['libroregistral']);  
       $smarty->assign('estado',$estado);
       $smarty->assign('arrayTomos',$arrayTomos); 
       $smarty->assign('camino','>> Tomos >> Listado');
       $smarty->assign('titular','Listado de Tomos del libro de '.$librobd->getNomRubro());
       $smarty->assign('template','tomos/listadotomos.tpl');
       $smarty->display('layout.tpl');
   } else {
       header("location: /librosregistrales"); 
   } 
} else {
    header("Location: /login.php");
}      
?>
