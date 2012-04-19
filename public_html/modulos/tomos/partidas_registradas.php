<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);
if($usuario->checkCredenciales(array('Gestionar Tomos', 'Partidas Registradas'))) { 
    $tomo = $tomo = new tomo();
    $tomobd = $tomo->getTomo($args[1]);
    $rubro = $tomobd->getRubro();
    $partidas = $tomobd->getPartidas();
    $smarty->assign('arrayPartidas',$partidas);
    $smarty->assign('idtomo',$tomobd->request['idtomo']);
    $smarty->assign('tomo_numero',$tomobd->request['numero']);
    $smarty->assign('libroregistral',$rubro); 
    switch($rubro) {
        case 'Nacimientos':
           $url = 'detallesnacimiento.php';
        break;
        case 'Matrimonios':
           $url = 'detallesmatrimonio.php';
        break; 
        case 'Defunciones':
           $url = 'detallesdefuncion.php';
        break;
        case 'Reposicion Nacimiento':
           $url = 'detallesreponacimiento.php';
        break;                             
        case 'Reposicion Defuncion':
           $url = 'detallesrepodefuncion.php';
        break;
        case 'Disolucion Vinculo Matrimonial':
           $url = 'detallesdisolucionmatrimonio.php';
        break; 
        case 'Inscripciones Varias':
           $url = 'detallesinscripcionvaria.php';
        break;        
    }    
    $smarty->assign('url','/modulos/inscripciones/'.$url.'?id=');     
    $smarty->assign('template','tomos/listadopartidas.tpl');
    $smarty->display('layout.tpl');    
} else {
    header("Location: /login.php"); 
}    
?>
