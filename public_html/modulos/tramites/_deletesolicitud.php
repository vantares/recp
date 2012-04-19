<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$tratamientofechas = new TFechas();
$tipotramites = new tipotramite();
$solicitudes = new solicitudtramite();
$recibos = new recibo();

$solicitudtramite = $solicitudes->getSolicitudtramite($args[1]);
$recibo = $recibos->getRecibo($_SESSION['idrecibo']);
print_r($_SESSION);
//print_r($recibos);
//print_r($recibo);

//descuento la tarifa
//determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general 
//decrementandolo
if(!isset($_SESSION['patrocinio'])){
    $monto = $recibo->request['monto']; 
    $tipotramite =  $tipotramites->getTipotramite($solicitudtramite->request['tipotramite']);
    $fecha = $tratamientofechas->recortar_fecha($solicitudtramite->request['fechaentrega']);       
    $diasespera = $tratamientofechas->getCantDias($fecha[0],date('Y-m-d')); 
    $monto2 = $monto - $tipotramite->getMonto($diasespera); 
    $recibo->request['monto'] = $monto2;          
    $recibo->updateRecord(); 
}
$solicitudtramite->delete();

if($_SESSION['tipo'] == 'certificaciones') {
    header("Location: /modulos/tramites/solicitarcertificacion.php?idrecibo=".$_SESSION['idrecibo']);
} else {
     header("Location: /modulos/tramites/solicitarinscripcion.php?idrecibo=".$_SESSION['idrecibo']); 
}  
?>
