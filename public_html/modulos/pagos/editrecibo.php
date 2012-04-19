<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
if($user->checkCredenciales(array('Pagos'))) {     
    if($args[1] == 'add'){
        $allpersonas = new persona();
        $allsolicitudes = new solicitudtramite();
        $tipotramites = new tipotramite();
        $tratamientofechas = new TFechas();        

        if($args[2]=='certificacion'){    
            $arraySolicitud = $_SESSION['arrayCert'];   
        }else{
            $arraySolicitud = $_SESSION['arrayInsc'];  
        }
        //determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general
        $monto = 0;
          
        foreach($arraySolicitud as $id => $sol){            
            $solicitud = $allsolicitudes->getSolicitudtramite($id);
            $tipo = $solicitud->getTipotramite();
            $idtipotramite = $tipo[0]['idtipotramite'];            
            $tipotramite = $tipotramites->getTipotramite($idtipotramite);
            $fecha = $tratamientofechas->recortar_fecha($solicitud->request['fechaentrega']);       
            $diasespera = $tratamientofechas->getCantDias($fecha[0],date('Y-m-d')); 
            $monto += $tipotramite->getMonto($diasespera);
        }       
        $smarty->assign('titular','Nuevo Recibo');
    }else{
        $clientes = new cliente();
        $persona = $clientes->getPersonaByIdrecibo($args[2]); //lo que paso es el id del recibo  
        $allpagos = new pago();
        $solicitud = $allpagos->getSolicitudtramiteByIdrecibo($args[2]); //lo que paso es el id del recibo  
        $tipo = $solicitud->getTipotramite();
        $idtipotramite = $tipo[0]['idtipotramite']; 
        $tipotramites = new tipotramite();
        $tipotramite = $tipotramites->getTipotramite($idtipotramite);
        $smarty->assign('titular','Editar Recibo');         
    }
   
    if($monto > 0) {
        $smarty->assign('monto',$monto);                
    }else{ 
        $smarty->assign('excento','excento'); 
    }  
     
	$recibos = new recibo();
	if((isset($_POST['salvar']))){
        //creo el nombre completo del cliente
        $nombrecliente = $_REQUEST['nombre'];
        $persona = $allpersonas->getPersona($_REQUEST['cedula']); 
        //establesco de donde viene la solicitud  
        if($args[2]=='certificacion'){
            $url = "solicitarcertificacion.php";
        }else{
            $url = "solicitarinscripcion.php";
        }
        if(isset($args[1])) {
            switch($args[1]) {
                case 'add':
                	$recibo = new recibo();                     
                    $_REQUEST['monto'] = $monto;
                    $_REQUEST['nombrecliente'] = $nombrecliente;
                    $_REQUEST['fecha']  = date('Y-m-d');
                    $recibo->readEnv();  
                    $recibo->addRecord();
                    //Registro el evento
                    $evento = new evento();      
                    $evento->request['tipoevento'] = "Registrar recibo";
                    $evento->request['nombreusuario'] = $user->request['nombre']; 
                    $evento->request['clave'] = $user->request['clave'];  
                    $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                    $evento->request['descripcion'] = "Se ha registrado el recibo ".$recibo->getlastId()." del cliente: ".$nombrecliente; 
                    $evento->request['fechaocurrencia'] = date('Y-m-d');
                    $evento->addRecord();
                    //creo el cliente
                    $cliente = new cliente();
                    $cliente->request['idpersona'] = $_REQUEST['cedula'];
                    $cliente->request['idrecibo'] = $recibo->getlastId(); 
                    $cliente->addRecord();
                    //creo el pago    
                    foreach($arraySolicitud as $sol => $sol1){             
                        $pago = new pago();
                        $pago->request['idsolicitudtramite'] = $sol;
                        $pago->request['idrecibo'] = $recibo->getlastId(); 
                        $pago->addRecord();
                    }
                    //Borro la variable de session 
                    if($args[2]=='certificacion'){       
                        session_unregister('arrayCert');
                    }else{
                        session_unregister('arrayInsc');
                    }                  
                    //Registro el item de pago del recibo si no es excento de pago
                    if($monto != 0){
                        $rec = $recibos->getRecibo($recibo->getlastId());
                        $item = $rec->getItempagado();
                        if(is_null($item)){
                            $item = new itempagado();
                            $item->request['idrecibo'] = $rec->request['idrecibo']; 
                            $item->request['tarifa'] = $rec->request['monto'];
                            $item->request['tipotramite'] = $tipotramite->request['nombre'];
                            $item->request['cant'] = $_REQUEST['cant'];
                            $item->addRecord();
                            //Registro el evento
                            $evento = new evento();      
                            $evento->request['tipoevento'] = "Registrar pago de recibo";
                            $evento->request['nombreusuario'] = $user->request['nombre']; 
                            $evento->request['clave'] = $user->request['clave'];  
                            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                            $evento->request['descripcion'] = "Se ha registrado pago del recibo ".$rec->request['idrecibo']." del cliente: ".$nombrecliente; 
                            $evento->request['fechaocurrencia'] = date('Y-m-d');
                            $evento->addRecord();                     
                        }else{
                            $cantacumulada =  $item->request['cant'];
                            $item->request['cant'] = $cantacumulada + $_REQUEST['cant'];
                            $item->updateRecord();
                            //Registro el evento
                            $evento = new evento();      
                            $evento->request['tipoevento'] = "Registrar pago de recibo";
                            $evento->request['nombreusuario'] = $user->request['nombre']; 
                            $evento->request['clave'] = $user->request['clave'];  
                            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                            $evento->request['descripcion'] = "Se ha registrado pago del recibo ".$rec->request['idrecibo']." del cliente: ".$nombrecliente; 
                            $evento->request['fechaocurrencia'] = date('Y-m-d');
                            $evento->addRecord();
                        }
                    }       
                break;
                case 'edit':
                	$recibo = $recibos->getRecibo($idrecibo);  
                    $_REQUEST['fecha']  = date('Y-m-d');
                    $recibo->readEnv();
                    $recibo->updateRecord();  
                    //Registro el evento
                    $evento = new evento();
                    $evento->request['descripcion'] = 'Se ha editado al recibo '.$recibo->request['idrecibo']; 
                    $evento->request['tipoevento'] = 'Editar recibo';
                    $evento->request['nombreusuario'] = $user->request['nombre']; 
                    $evento->request['clave'] = $user->request['clave']; 
                    $evento->request['cliente'] = $_SERVER['REMOTE_ADDR'];                   
                    $evento->request['fechaocurrencia'] = date('Y-m-d');
                    $evento->addRecord();                    
                    //Registro el item de pago del recibo
                    if(!isset($args[6])){
                        $rec = $recibo;
                        $item = $rec->getItempagado();
                        if(is_null($item)){
                            $item = new itempagado();
                            $item->request['idrecibo'] = $rec->request['idrecibo']; 
                            $item->request['tarifa'] = $rec->request['monto'];
                            $item->request['tipotramite'] = $tipotramite->request['nombre'];
                            $item->request['cant'] = $_REQUEST['cant'];
                            $item->addRecord();     
                            //Registro el evento
                            $evento = new evento();      
                            $evento->request['tipoevento'] = "Registrar pago de recibo";
                            $evento->request['nombreusuario'] = $user->request['nombre']; 
                            $evento->request['clave'] = $user->request['clave'];  
                            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                            $evento->request['descripcion'] = "Se ha registrado pago del recibo ".$rec->request['idrecibo']." del cliente: ".$nombrecliente."."; 
                            $evento->request['fechaocurrencia'] = date('Y-m-d');
                            $evento->addRecord();                     
                        }else{
                            $cantacumulada =  $item->request['cant'];
                            $item->request['cant'] = $cantacumulada + $_REQUEST['cant'];
                            $item->updateRecord();
                            //Registro el evento
                            $evento = new evento();      
                            $evento->request['tipoevento'] = "Registrar pago de recibo";
                            $evento->request['nombreusuario'] = $user->request['nombre']; 
                            $evento->request['clave'] = $user->request['clave'];  
                            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                            $evento->request['descripcion'] = "Se ha registrado pago del recibo ".$rec->request['idrecibo']." del cliente: ".$nombrecliente."."; 
                            $evento->request['fechaocurrencia'] = date('Y-m-d');
                            $evento->addRecord();
                        }
                    }  
                break;
            }                         
        } else {
            header("Location: /modulos/tramites/".$url);
        }
        header("Location: /modulos/tramites/".$url);                   
	}
    $smarty->assign('tipotramite',$tipotramite);
    $smarty->assign('arraySolicitud',$arraySolicitud);
    $smarty->assign('persona',$persona); 
    $smarty->assign('nombrecliente',$nombrecliente);   
    $smarty->assign('template','pagos/editrecibo.tpl');
    $smarty->display('layout.tpl');
}else {
   header("location: /login.php"); 
}

 
?>
