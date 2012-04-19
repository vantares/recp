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
    $formadepago = new formasdepagoTable();
    $arrayFormapago = $formadepago->readData();     
    if(isset($_POST['salvar'])){
        $solicitudtramite = new solicitudtramite();
        if(isset($_SESSION['patrocinio']) && ($_SESSION['patrocinio'] == true)){
            $_REQUEST['excento'] = true;  
        } else {
            $_REQUEST['excento'] = false;
            //determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general
            $monto = $recibobd->request['monto']; 
            $tipotramite =  $tipotramites->getTipotramite(2);
            $fecha = $tratamientofechas->recortar_fecha($_REQUEST['fechaentrega']); 
            $diasespera = $tratamientofechas->getCantDias($_REQUEST['fechaentrega'],date('Y-m-d'));
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
        $_REQUEST['estado'] = 'PENDIENTE'; 
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
         
        //Verifico si es patrocinado el tipo de tramite           
        if(isset($_SESSION['patrocinio']) && ($_SESSION['patrocinio'] == true)){
            $patrocinio = new patrocinio();
            $patrocinio->request['idsolicitudtramite'] = $solicitudtramite->getlastId();
            $patrocinio->request['idorganizacion'] = $_SESSION['idorganizacion'];
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
    $smarty->assign('arrayFormapago',$arrayFormapago);    
    $smarty->assign('recibo',$recibo);
    $smarty->assign('arrayRubros',$arrayRubros); 
    $smarty->assign('solicitudes',$solicitudes); 
    $smarty->assign('tipo','certificacion');
    $smarty->assign('tipotramite',2); 
    $smarty->assign('titular','Solicitudes de Certificacion para el recibo '.$_SESSION['idrecibo']);
    $smarty->assign('template','tramites/editsolicitud.tpl'); 
    $smarty->display('layout.tpl');
}else {
   header("location: /login.php"); 
}
?>
