<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
session_start();

$recibos = new recibo();
$recibo = $recibos->getRecibo($args[1]);

$recibo->request['estado'] = 1;
$recibo->updateRecord();

if($_SESSION['tipo'] == 'certificaciones') {
    $url = 'certificaciones';    
} elseif($_SESSION['tipo'] == 'inscripciones') {
    $url = 'inscripciones';    
}
//limpio las variables de session
session_unregister('tipo');
session_unregister('idrecibo');
session_unregister('patrocinio');

header("Location: /modulos/pagos/addrecibo.php?tipo=".$url);   
?>
