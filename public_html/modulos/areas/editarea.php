<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
//echo $_REQUEST['padre'];die;
if($user->checkCredenciales(array('Administracion', 'Gestionar Areas'))) {
    $areas = new area();
    $area = new area();
    if(($args[2])&&($args[2] !='')){    
        $area = $areas->getArea($args[2]);
        $smarty->assign('titular','Editar Area '.$area->request['nombre']); 
        $smarty->assign('usuario',$usuario);     
    }else{
        $smarty->assign('titular','Nueva Area'); 
    }

    if(isset($_POST['salvar'])){
    
        if(isset($_REQUEST['check1'])){
            $_REQUEST['visible'] = 1;
        }else{
            $_REQUEST['visible'] = 0;
        }
        
        if(isset($_REQUEST['check2'])){
            $_REQUEST['independiente'] = 1;
        }else{
            $_REQUEST['independiente'] = 0;
        }

        if(isset($args[1])) {
            switch($args[1]) {
                case 'add':                    
                   $area->readEnv();
                   $area->addRecord();
                   //Registro el evento
                   $evento = new evento();      
                   $evento->request['tipoevento'] = "Agregar area";
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave'];  
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                   $evento->request['descripcion'] = "Se ha agregado el area ".$area->request['nombre']." al sistema"; 
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord();        
                break;
                case 'edit':
                   $area->readEnv();
                   $area->updateRecord();  
                   //Registro el evento
                   $evento = new evento();
                   $evento->request['descripcion'] = 'Se ha editado al area '.$area->request['nombre']; 
                   $evento->request['tipoevento'] = 'Editar area';
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave']; 
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR'];                   
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord();    
                break;
            }           
        } else {
            header("Location: /modulos/areas/");
        }
        
        header("Location: /modulos/areas/");
    }
    $arrayAreas = $areas->readData();

    $smarty->assign('area',$area); 
    $smarty->assign('args',$args);
    $smarty->assign('arrayAreas',$arrayAreas); 
    $smarty->assign('template','areas/editarea.tpl');
    $smarty->display('layout.tpl');
} else {
    header("Location: /login.php");  
}
?>
