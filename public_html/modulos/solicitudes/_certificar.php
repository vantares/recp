<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Atender Recibos'))) {
    $idrecibo = $args[2];
    $solicitudes = new solicitudcertificacion();
    $solicitud = $solicitudes->getSolicitudcertificacion($args[1]);
    $perfil = new Perfil();
    $perfilbd = $perfil->getPerfil($user->request['idperfil']);
    
    if(isset($_POST['salvar'])){
        $certificacion = new certificacion();
        
        $certificacion->request['codigo'] = $_REQUEST['codigo'];
        $certificacion->request['departamentoregistro'] = $perfilbd->getParametro('Departamento');
        $certificacion->request['anyoregistro'] = $_REQUEST['anyoregistro'];   
        $certificacion->request['nombreregistrador'] = $_REQUEST['nombreregistrador'];   
        $certificacion->request['nombresecretario'] = $_REQUEST['nombresecretario'];
        $certificacion->request['fechaemision'] = date('Y-m-d');            
        $certificacion->request['lugaremision'] = $perfilbd->getParametro('Ciudad');   
        $certificacion->request['idsolicitud'] = $solicitud->request['idsolicitudcertificacion'];   
        $certificacion->request['tipocertificado'] = $solicitud->request['tipocertificacion'];
        $certificacion->addRecord();   
        //Registro el evento
        $evento = new evento();      
        $evento->request['tipoevento'] = "Certificar solicitud";
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['descripcion'] = "Se ha certificado la solicitud ".$args[1]; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();    
        header("location: /modulos/solicitudes/_finalizar.php/".$args[1]."/".$idrecibo);    
    }
    $smarty->assign('idrecibo',$idrecibo);
    $smarty->assign('titular','Certificar solicitud');
    $smarty->assign('template','solicitudes/certificar.tpl');
    $smarty->display('layout.tpl');
} else {
    header("location: /login.php"); 
}  
?>
