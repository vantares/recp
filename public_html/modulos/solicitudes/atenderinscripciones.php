<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Atender Recibos'))) {    
    $arrSolicitud = new solicitudtramite();
    $arrSolicitudInsc = new solicitudinscripcion();

    $solicitudtramite = $arrSolicitud->getSolicitudtramite($args[1]);
    $solicitudinsc =  $arrSolicitudInsc->getSolicitudinscripcion($args[1]);
    $solicitudtramite->request['estado'] = 'EN TRAMITE';
    $solicitudtramite->updateRecord();
    $arrayAreas = new area();

    if(!is_null($solicitudinsc->request['idsolicitudinscripcion'])){ 
        $areaInscrip = $arrayAreas->getAreaByNombre("Inscripciones"); 
        $area = $arrayAreas->getAreaByNombreAndPadre($solicitudinsc->request['tipoinscripcion'],$areaInscrip->request['idarea']);
        header("Location: ".$area->request['url']);       
    }
} else {
    header("location: /login.php"); 
}  
?>
