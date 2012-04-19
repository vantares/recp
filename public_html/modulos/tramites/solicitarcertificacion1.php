<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
session_start();

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Tramites'))) {
    if(isset($_REQUEST['idrecibo'])) {
        $_SESSION['idrecibo'] = $_REQUEST['idrecibo'];
    }
    
    $tratamientofechas = new TFechas();
    $tipotramites = new tipotramite();
       
    $recibo = new recibo();
    $recibobd = $recibo->getRecibo($_SESSION['idrecibo']); 
    if(isset($_POST['salvar'])){
        $solicitudtramite = new solicitudtramite();
        if(isset($_REQUEST['check'])){
            $_REQUEST['excento'] = true;  
        }else{
            $_REQUEST['excento'] = false;
            
            //determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general
            $monto = $recibobd->request['monto']; 
            $tipotramitedb = $tipotramites->getTipotramitebyname($_REQUEST['tipotramite']);      
            $tipotramite =  $tipotramites->getTipotramite($tipotramitedb[0]['idtipotramite']); 
            $fecha = $tratamientofechas->recortar_fecha($_REQUEST['fechaentrega']);       
            $diasespera = $tratamientofechas->getCantDias($fecha[0],date('Y-m-d')); 
            $monto += $tipotramite->getMonto($diasespera); 
            $recibobd->request['monto'] = $monto;          
            $recibobd->updateRecord(); 
            
            //lleno el itempagado
            $itempagado = new itempagado();
            $itempagado->readEnv();
            $itempagado->request['tarifa'] = $tipotramite->getMonto($diasespera);
            $itempagado->addRecord();  
        }
        $_REQUEST['fecha'] = date('Y-m-d');  
        $solicitudtramite->readEnv();
        $solicitudtramite->addRecord();
        
        //Lleno la solicitud de certificacion
        $solicitudcert = new solicitudcertificacion();                 
        $solicitudcert->readEnv();
        $solicitudcert->request['idsolicitudcertificacion'] = $solicitudtramite->getlastId();  
        $solicitudcert->addRecord();
        
        //Lleno el pago
        $pago = new pagoTable();    
        $_REQUEST['idsolicitudtramite'] =  $solicitudtramite->getlastId();
        $_REQUEST['idrecibo'] = $_SESSION['idrecibo'];           
        $pago->readEnv();
        $pago->addRecord();
        
        //Registro el evento
        $evento = new evento();
        $evento->request['tipoevento'] = 'Agregar Solicitud de Certificacion';
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['descripcion'] = 'Se ha agregado la solicitud de certificacion '.$solicitudcert->request['idsolicitudcertificacion'].' al sistema'; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();   
        if(isset($_REQUEST['check'])){
            $patrocinio = new patrocinio();
            $patrocinio->request['idsolicitudtramite'] = $solicitudtramite->getlastId();
            $patrocinio->request['idorganizacion'] = $_REQUEST['idorganizacion'];
            $patrocinio->addRecord();
        }  
    }
        
    $solicitudes = $recibobd->getSolicitudesT();
    $tipotramite = new tipotramiteTable();
    $arrayTipotramite = $tipotramite->readData(); 
    $rubros = new rubro(); 
    $arrayRubros = $rubros->readData();
    $organizaciones = new organizacion(); 
    $arrayOrganizacion = $organizaciones->readData(); 
    $anyo = date('Y');    
    $smarty->assign('anyo',$anyo); 
    $smarty->assign('fin',$fin);
    $smarty->assign('arrayTipotramite',$arrayTipotramite);   
    $smarty->assign('arrayOrganizacion',$arrayOrganizacion);     
    $smarty->assign('recibo',$recibo);
    $smarty->assign('arrayRubros',$arrayRubros); 
    $smarty->assign('solicitudes',$solicitudes); 
    $smarty->assign('tipo','certificacion');
    $smarty->assign('titular','Solicitudes de Certificacion para el recibo '.$_SESSION['idrecibo']);
    $smarty->assign('template','tramites/editsolicitud.tpl'); 
    $smarty->display('layout.tpl');
}else {
   header("location: /login.php"); 
}
?>
