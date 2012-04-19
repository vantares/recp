<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion'))) {
    $tarifas = new tarifa();
    if(($args[2])&&($args[2] !='')){
        $tarifa = $tarifas->getTarifa($args[2]);
        $smarty->assign('tarifa',$tarifa);
        $smarty->assign('titular','Editar Tarifa: '.$perfil->request['idtarifa']);
    } else {
        $smarty->assign('titular','Nueva Tarifa');
    }

    if(isset($_POST['salvar'])){
    	if(isset($args[1])) {
            switch($args[1]) {
                case 'add':
                   $tarifa = new tarifa();
                   $tarifa->readEnv(); 
                   $tarifa->addRecord();
                   //Registro el evento
                   $evento = new evento();
                   $evento->request['tipoevento'] = 'Agregar tarifa';
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave'];  
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                   $evento->request['descripcion'] = 'Se ha agregado la tarifa '.$tarifa->request['idtarifa'].' al sistema'; 
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord();       
                break;
                case 'edit':
                   $tarifa = $tarifas->getTarifa($args[2]);	
                   $tarifa->readEnv(); 
                   $tarifa->updateRecord();
                   //Registro el evento
                   $evento = new evento();
                   $evento->request['tipoevento'] = 'Editar tarifa';
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave'];  
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                   $evento->request['descripcion'] = 'Se ha editado la tarifa '.$tarifa->request['idtarifa']; 
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord(); 
                break;
            }           
        } else {
            header("Location: /modulos/tarifas/");
        }        
        header("Location: /modulos/tarifas/");
    }
    $tipotramites = new tipotramite();
    $arrayTipotramites = $tipotramites->readData();

    $smarty->assign('idtarifa',$args[2]);
    $smarty->assign('arrayTipotramites',$arrayTipotramites);
    $smarty->assign('template','tarifas/edittarifa.tpl');
    $smarty->display('layout.tpl');
} else {
    header("Location: /login.php");  
}
?>