<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

#if($user->checkCredenciales(array('Atender Recibos'))) { 
    $arrSolicitud = new solicitudtramite();
    $arrSolicitudCert = new solicitudcertificacion();
    $solicitudtramite = $arrSolicitud->getSolicitudtramite($args[1]);
    $solicitudtramite->request['estado'] = 'EN TRAMITE';
    $solicitudtramite->updateRecord();    
    $solicitudcert =  $arrSolicitudCert->getSolicitudcertificacion($args[1]); 
      
    //lleno la solicitud q es lo que se manda para el tpl
    $solicitud['tiposolicitudcertificado'] = $solicitudcert->request['tipocertificacion'];
    $solicitud['fechasolicitud'] = $solicitudtramite->request['fecha'];
    $solicitud['interesado1nombre1'] = $solicitudtramite->request['solicitante1'];
    $solicitud['interesado2nombre1'] = $solicitudtramite->request['solicitante2'];
    $solicitud['fecha'] = $solicitudcert->request['fechanacimiento'];
    $solicitud['padrenombre1'] = $solicitudcert->request['nombrepadre'];
    $solicitud['madrenombre1'] = $solicitudcert->request['nombremadre']; 
    $solicitud['tomo'] = $solicitudcert->request['tomo'];
    $solicitud['folio'] = $solicitudcert->request['folio'];
    $solicitud['partida'] = $solicitudcert->request['partida'];
    $solicitud['anyo'] = $solicitudcert->request['anyo'];
    
    $template = 'actas/solcertificado.tpl'; 
    $smarty->assign('solicitud',$solicitud);
    $smarty->display($template);  
#} else {
#    header("location: /login.php"); 
#}  
?>
