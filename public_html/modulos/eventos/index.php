<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion','Monitoreo Trazas'))) {
    $eventos = new evento();
    $arrayEventos =  $eventos->readData();
    
    $filter = '';
    if($_REQUEST['nombre'] != '') $filter .= " AND (usuario.nombreusuario LIKE '%".$_REQUEST['nombre']."%' OR evento.nombreusuario LIKE '%".$_REQUEST['nombre']."%')";
    //if($_REQUEST['nombre'] != '') $filter .= " AND (usuario.nombreusuario LIKE '%".$_REQUEST['nombre']."%' OR evento.nombreusuario LIKE '%".$_REQUEST['nombre']."%')";
    if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] != ''){
         $filter .= " AND (evento.fechaocurrencia>='".$_REQUEST['fechainicial']."' AND evento.fechaocurrencia<='".$_REQUEST['fechafinal']."')";
    } else if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] == ''){   
        $filter .= " AND evento.fechaocurrencia>='".$_REQUEST['fechainicial']."'";
    } elseif($_REQUEST['fechainicial'] == '' && $_REQUEST['fechafinal'] != ''){  
       $filter .= " AND evento.fechaocurrencia<='".$_REQUEST['fechafinal']."'";
    }
    
    if($filter == ''){    
        $eventosbd = $eventos->readDataFilter("evento.idevento != -1 ");     
    } else {
        $eventosbd = $eventos->readDataSQL("SELECT evento.*
                                              FROM evento
                                        INNER JOIN usuario
                                                ON evento.nombreusuario=usuario.nombre
                                             WHERE evento.idevento != -1 ".$filter);
    }
    $cadena = new TCadena(); 
    $smarty->assign('arrayEventos',$cadena->convert_sqlData_toString($eventosbd));
    $smarty->assign('fechainicial',$_REQUEST['fechainicial']);
    $smarty->assign('fechafinal',$_REQUEST['fechafinal']);   
    $smarty->assign('titular','Listado de Usuarios');
    $smarty->assign('template','eventos/listadoeventos.tpl');
    $smarty->display('layout.tpl');  
} else {
   header("location: /login.php"); 
}   

   
?>
