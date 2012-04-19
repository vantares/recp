<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
if($user->checkCredenciales(array('Administracion'))) { 
    $tarifas = new tarifa();   
    //Elimino la tarifa 
    if((isset($args[1])&&($args[1] !=''))){
        $tarifa = $tarifas->getTarifa($args[1]);
   	    $tarifas->deleteRecord($args[1]);
        //Registro el evento
        $evento = new evento();      
        $evento->request['descripcion'] = "Se ha eliminado la tarifa ".$tarifa->request['nombre']; 
        $evento->request['tipoevento'] = "Eliminar tarifa";
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();
    }
      
    $arrayTarifas = $tarifas->readData();
    $smarty->assign('arrayTarifas',$arrayTarifas); 
    $smarty->assign('titular','Listado de Tarifas ');
    $smarty->assign('template','tarifas/listadotarifas.tpl');
    $smarty->display('layout.tpl');
}else{
	header("location: /login.php");
} 
?>