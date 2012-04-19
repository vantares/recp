<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion','Monitoreo Trazas'))) {
    if(($args[1])&&($args[1] !='')){
        $eventos = new evento();
        
        $usuario = $usuarios->getUserByLogin($args[1]); 
        $idusuario = $usuario[0]['idusuario'];
        $usuariobd = $usuarios->getUser($idusuario);
        $arrayEventos = $usuariobd->getEvents();
        
        $filter = '';
        $filter .= " AND (usuario.nombreusuario LIKE '%".$usuariobd->request['nombreusuario']."%' OR evento.nombreusuario LIKE '%".$usuariobd->request['nombreusuario']."%')";
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
        $smarty->assign('arrayPerfiles',$arrayPerfiles); 
        $smarty->assign('arrayRoles',$arrayRoles);
        $smarty->assign('arrayEventos',$cadena->convert_sqlData_toString($eventosbd));  
        $smarty->assign('value',true); 
        $smarty->assign('titular','ultimas trazas realizadas');
        $smarty->assign('template','eventos/listadoeventos.tpl');
        $smarty->display('layout.tpl');    
    }else{
        header("location: /modulo/eventos/");    
    }
    
    
} else {
   header("location: /login.php"); 
}   
?>
