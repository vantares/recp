<?php
session_start();  
include_once('common.inc.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/../classes/function.numeros.php');
$args = explode("/", $_SERVER['PATH_INFO']); 
if(isset($_REQUEST['acta'])) $args[1] = $_REQUEST['acta'];  
if(isset($_REQUEST['idtomo'])) $args[2] = $_REQUEST['idtomo'];  
if(isset($args[1])) { 
    $smarty->register_function("convertir_a_letras", "convertir_a_letras");
    $usuarios = new usuario();
    $usuario = $usuarios->getUser($_SESSION['idusuario']);  
    $perfil = new Perfil();
    $perfilbd = $perfil->getPerfil($usuario->request['idperfil']);    
    $smarty->assign('Municipio',$perfilbd->getParametro('Municipio')); 
    $smarty->assign('Provincia',$perfilbd->getParametro('Provincia'));
    $smarty->assign('Departamento',$perfilbd->getParametro('Departamento'));
    switch($args[1]) {
       case 'apertura':
       $tomo = new tomo();
       $tomobd = $tomo->getTomo($args[2]);
       $valores = $tomobd->getApertura();
       $libroregistral = new libroregistral();
       $libroregistralbd = $libroregistral->getLibro($_SESSION['libroregistral']);
       $valores['rubro'] = $libroregistralbd->getNomrubro();
       $valores['numero'] = $tomo->request['numero'];
       //$valores['fecha'] = convertir_a_letras($valores['fecha']);
       $template = 'actas/apertura.tpl';
       break;
       case 'cierre':
       $tomo = new tomo();
       $tomobd = $tomo->getTomo($args[2]);
       $valores = $tomobd->getApertura();
       $libroregistral = new libroregistral();
       $libroregistralbd = $libroregistral->getLibro($_SESSION['libroregistral']);
       $valores['rubro'] = $libroregistralbd->getNomrubro();
       $valores['numero'] = $tomo->request['numero'];
       $valores['cantpartidas'] = $tomo->getCantpartidas();
       $valores['cantfolios'] = $tomo->getCantFolios(); 
       $cierre = $tomobd->getCierre();
       $smarty->assign('cierre',$cierre);
       $template = 'actas/cierre.tpl';       
       break;
       case 'indice':
       $tomo = new tomo();
       $tomobd = $tomo->getTomo($args[2]);
       $valores = $tomobd->getApertura();
       $libroregistral = new libroregistral();
       $libroregistralbd = $libroregistral->getLibro($_SESSION['libroregistral']);
       $valores['rubro'] = $libroregistralbd->getNomrubro();
       $valores['numero'] = $tomo->request['numero'];
       $valores['date'] = date('Y-m-d ');
       $valores['year'] = date('Y');
       $valores['cantpartidas'] = $tomo->getCantpartidas();
       $indice = new indice();
       $indicebd = $indice->getIndice($tomo->request['idtomo']);
       $valores['indice'] = $indicebd;
	//TODO: los valores del rubro son establecidos surante la creacion del indice, los valores aca contenidos deben corresponder al nombre del rubro o tipo de otras inscripciones
       $valores['items'] = $indicebd->getItems();
       $template = 'actas/indice.tpl';       
       break;       
    }
    $smarty->assign('valores',$valores); 
    $smarty->display($template);   
}    
?>
