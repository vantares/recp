<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Tramites'))) {  
    if(isset($_REQUEST['idrecibo'])) {
        $_SESSION['idrecibo'] = $_REQUEST['idrecibo'];
    }
    
    $tratamientofechas = new TFechas();
    $tipotramites = new tipotramite();
    $formadepago = new formasdepagoTable();
    $arrayFormapago = $formadepago->readData();     
    $recibo = new recibo();
    $recibobd = $recibo->getRecibo($_SESSION['idrecibo']);
    if((isset($_POST['salvar']))){
        $solicitudtramite = new solicitudtramite();
        if(isset($_SESSION['patrocinio']) && ($_SESSION['patrocinio'] == true)){
            $_REQUEST['excento'] = true;
        } else {
            $_REQUEST['excento'] = false;
            //determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general
            $monto = $recibobd->request['monto']; 
            $tipotramite =  $tipotramites->getTipotramite(1);
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
        $_REQUEST['estado'] = 'PENDIENTE'; 
        $solicitudtramite->readEnv();
        $solicitudtramite->addRecord();                   
            
        //Lleno las solicitud de inscripcion       
        $solicitudinsc = new solicitudinscripcion();               	
        $solicitudinsc->readEnv();
        $solicitudinsc->request['idsolicitudinscripcion'] = $solicitudtramite->getlastId();
        $solicitudinsc->addRecord();
        
        //Lleno tabla pago
        $pago = new pagoTable();    
        $_REQUEST['idsolicitudtramite'] =  $solicitudtramite->getlastId();
        $_REQUEST['idrecibo'] = $_SESSION['idrecibo'];           
        $pago->readEnv();
        $pago->addRecord(); 
                
        //Registro el evento
        $evento = new evento();
        $evento->request['tipoevento'] = 'Agregar Solicitud de Inscripcion';
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['descripcion'] = 'Se ha agregado la solicitud de inscripcion '.$solicitudinsc->request['idsolicitudinscripcion'].' al sistema'; 
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
    $tipotramite = new tipotramite(); 
    $arrayTipotramite = $tipotramite->getAll();
    $rubros = new rubro();
    $arrayRubros = $rubros->getAll();
    $solicitudes = $recibobd->getSolicitudesT();  
    $smarty->assign('arrayTipotramite',$arrayTipotramite); 
    $smarty->assign('recibo',$recibo);  
    $smarty->assign('arrayRubros',$arrayRubros);
    $smarty->assign('solicitudes',$solicitudes);
    $smarty->assign('tipo',"inscripcion");  
    $smarty->assign('tipotramite',1);   
    $smarty->assign('arrayFormapago',$arrayFormapago);    
    $smarty->assign('titular','Nueva Solicitud de Inscripcion para el recibo '.$_SESSION['idrecibo']);
    $smarty->assign('template','tramites/editsolicitud.tpl');
    $smarty->display('layout.tpl'); 
}else {
   header("location: /login.php"); 
}
?>