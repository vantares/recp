<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Atender Recibos'))) {
    $idrecibo = $args[2];
    $idsolicitud = $args[1];
    
    $arrSolicitudCert = new solicitudcertificacion();
    $arrSolicitud = new solicitudtramite();
    $arrRecibos = new recibo();
    
    $solicitudtramite = $arrSolicitud->getSolicitudtramite($idsolicitud);
    $solicitudcert =  $arrSolicitudCert->getSolicitudcertificacion($idsolicitud);
    $recibo = $arrRecibos->getRecibo($idrecibo); 
    
    //cambio el estado de la solicitud 
    $solicitudtramite->request['estado'] = '2';
    $solicitudtramite->updateRecord();
        
    $solicitudes = $recibo->getSolicitudesT();
    $i = 0;
    foreach($solicitudes as $key => $valor){ 
        if($valor->request['estado'] != '2'){    
            $i++;       
        }
    }     
    if($i == 0){        
        //actualizo el estado del recibo
        $recibo->request['estado'] = 2;
        $recibo->updateRecord();
        
        header("Location: /modulos/solicitudes/");               
    }else{
        header("Location: /modulos/solicitudes/chequearrecibo.php/".$idrecibo);
    } 
} else {
    header("location: /login.php"); 
}  
?>
