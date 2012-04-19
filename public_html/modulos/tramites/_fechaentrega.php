<?php
  include_once('../../common.inc.php'); 
  $tipotramite = new tipotramite();
  $tipotramitedb = $tipotramite->getTipotramitebyname($_REQUEST['valorcombo']);
  $tipotramite =  $tipotramite->getTipotramite($tipotramitedb[0]); 
  $tratamientofechas = new TFechas(); 
  $tarifa = new tarifa();
  $DiasDefault = $tarifa->getDiasDefaultbyTipotramite($tipotramite->request['idtipotramite']);
  $fechaentrega = $tratamientofechas->suma_fechas(date('Y-m-d'),$DiasDefault);
  $smarty->assign(fechaentrega,$fechaentrega);
  $smarty->display('tramites/_fechaentrega.tpl');
?>
