<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Atender Recibos'))) {
    $arrRecibos = new recibo();
    $recibo = $arrRecibos->getRecibo($args[1]);         
    $idrecibo = $args[1];
    
    $solicitudes = $recibo->getSolicitudesT();        
    $tiposolicitud = $recibo->getTipoSolicitud();
    
    foreach($solicitudes as $key => $valor){ 
        if($valor->request['estado'] != 'Atendido'){
            $arraySolicitudes[$key] = $valor;         
        }
    }

    $smarty->assign('recibo',$recibo); 
    $smarty->assign('idrecibo',$idrecibo);
    $smarty->assign('solicitudes',$arraySolicitudes);
    $smarty->assign('tiposolicitud',$tiposolicitud);
    $smarty->assign('titular','Recibo del cliente: '.$recibo->request['nombrecliente']); 
    $smarty->assign('template','solicitudes/chequearrecibo.tpl');
    $smarty->display('layout.tpl');        
} else {
    header("location: /login.php"); 
}
?>
