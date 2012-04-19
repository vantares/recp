<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
if($user->checkCredenciales(array('Pagos'))) {     
    $allpersonas = new persona();
    $allsolicitudes = new solicitudtramite();
    $tipotramites = new tipotramite();
    $tratamientofechas = new TFechas();        
    //determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general
    $monto = 0; 
    if((isset($_POST['salvar']))){ 
        $recibo = new recibo();
        $_REQUEST['nombrecliente'] = $_REQUEST['nombre'];
        $_REQUEST['monto'] = 0;
        $_REQUEST['estado'] = 0; 
        $_REQUEST['fecha']  = date('Y-m-d');
        $recibo->readEnv();  
        $recibo->addRecord(); 
        //Si existe la persona establezco el vinculo
        $persona = new Persona();
        $idpersona = $persona->getIdByCedula($_REQUEST['cedula']);
        if(($idpersona != '') && ($idpersona > 0)) {
           $cliente = new clienteTable();
           $_REQUEST['idpersona'] =  $idpersona;
           $_REQUEST['idrecibo'] =  $recibo->getlastId();
           $cliente->readEnv();
           $cliente->addRecord();
        }     
        $evento = new evento();      
        $evento->request['tipoevento'] = "Registrar recibo";
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['descripcion'] = "Se ha registrado el recibo ".$recibo->getlastId()." del cliente: ".$_REQUEST['nombre']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();
        if($_REQUEST['tipo'] == 'certificaciones') {
            header("Location: /modulos/tramites/solicitarcertificacion.php?idrecibo=".$recibo->getlastId());            
            $_SESSION['tipo'] = 'certificaciones';
        } elseif($_REQUEST['tipo'] = 'inscripciones') {
            header("Location: /modulos/tramites/solicitarinscripcion.php?idrecibo=".$recibo->getlastId()); 
            $_SESSION['tipo'] = 'inscripciones';    
        }    
    }    
    $smarty->assign('titular',($_REQUEST['tipo'] != '') ? 'Nuevo Recibo Para Solicitudes  de '.$_REQUEST['tipo'] : 'Nuevo Recibo Para Solicitudes ');   
    $recibos = new recibo(); 
    $smarty->assign('tipotramite',$tipotramite);
    $smarty->assign('arraySolicitud',$arraySolicitud);
    $smarty->assign('persona',$persona); 
    $smarty->assign('tipo',$_REQUEST['tipo']);
    $smarty->assign('nombrecliente',$nombrecliente);   
    $smarty->assign('template','pagos/editrecibo.tpl');
    $smarty->display('layout.tpl');    
       
}else {
   header("location: /login.php"); 
}

 
?>