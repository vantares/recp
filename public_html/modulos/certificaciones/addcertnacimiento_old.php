<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Certificaciones'))) {
    $inscripciones = new inscripcion();
    $recibos = new recibo();
    $libroregistral = new libroregistral(); 
    $tomos = new tomo();
    $esprimero = true;
    $perfil = new Perfil();
    $perfilbd = $perfil->getPerfil($user->request['idperfil']);
        
    //Busco los datos del recibo, la solicitud y la persona 
    $recibo = $recibos->getRecibo($args[1]); 
    $solicitudtramite = $recibo->getSolicitudTramite();
    $solicitudcert = $solicitudtramite->getSolicitudCertificacion(); 
    $persona = $recibo->getPersona();
    //Busco los datos del libro registral de nacimientos    
    $libroregistralbd = $libroregistral->getLibroByRubro('Nacimientos');
    if($libroregistralbd) {
        $arrayTomos = $libroregistralbd->getTomosAbiertos();
        if(!$arrayTomos) {
            $smarty->assign('notice', '<b>error:<b> No existe tomos abiertos asegurese de que existe el libro registral y que tiene algun tomo abierto');
            $smarty->assign('class','errornotice'); 
            $smarty->display('layout.tpl'); 
            die;
        } 
    } else {
        $smarty->assign('notice', '<b>error:<b> No existe definido el libro registral para este tipo de inscripcion');
        $smarty->assign('class','errornotice'); 
        $smarty->display('layout.tpl'); 
        die;    
    } 
    
    //Busco la inscripcion de nacimiento de la persona segun su cedula
    $reconocimiento = $persona->getReconocimiento();//este tiene el folio y la partida
    $inscripcion = $reconocimiento->getInscripcion();
    
    /*foreach($arrayTomos as $tomo) {
        $tomobd = $tomos->getTomo($tomo['idtomo']);
        $arrayPartFolio[$tomo['idtomo']]['partida'] = $tomobd->getLastPartida() + 1;
        $arrayPartFolio[$tomo['idtomo']]['folio'] = $tomobd->getLastFolio() + 1; 
        if($esprimero) {
            $folio = $tomobd->getLastFolio() + 1;
            $partida = $tomobd->getLastPartida() + 1;
            $esprimero = false;
        }    
    } */
    
    $smarty->assign('arrayTomos',$arrayTomos);
    $smarty->assign('folio',$folio); 
    $smarty->assign('partida',$partida);
    $smarty->assign('url','/modulos/certificaciones/addcertnacimiento');
    $smarty->assign('camino','>> Certificaciones >> Nacimientos >> Nueva');
    $smarty->assign('template','certificaciones/nacimiento.tpl');  
    $smarty->display('layout.tpl');
}else {
   header("location: /login.php"); 
}  
?>
