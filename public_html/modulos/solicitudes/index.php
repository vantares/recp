<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Atender Recibos'))) {
    $recibos = new recibo();
    $pagos = new pago(); 
	$arrayRecibos = $recibos->readDataFilter("recibo.estado = '1'");
    
    if(is_array($arrayRecibos)){
        foreach($arrayRecibos as $key => $valor){
           $valor['cant'] = $pagos->getCantidadbyIdRecibo($valor['idrecibo']);
           $arrayRecibos[$key] = $valor; 
        }
    }
    		        	
	$smarty->assign('arrayRecibos',$arrayRecibos); 
    $smarty->assign('titular','Listado de recibos emitidos');
    $smarty->assign('template','solicitudes/listadorecibos.tpl');
    $smarty->display('layout.tpl');    	
} else {
	header("location: /login.php"); 
}
?>