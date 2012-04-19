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
    $organizaciones = new organizacion();
    $arrayOrganizacion = $organizaciones->getAll();   
    $formadepago = new formasdepagoTable();
    $arrayFormapago = $formadepago->readData();               
    //determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general
    //$monto = 0;
		/*
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
        $idpersona = $_REQUEST['idpersona'];
        $personabd = ($idpersona != '')  ? $persona->getIdByCedula($idpersona) : $persona->getIdByName($_REQUEST['nombre']);
        if(!$personabd) {
           $personabd = new Persona();
           $nombrebd = explode(' ',trim($_REQUEST['nombre']));
           switch (count($nombrebd)) {
               case 4:
                    $nombre1 = $nombrebd[0];
                    $nombre2 = $nombrebd[1];
                    $apellido1 = $nombrebd[2];
                    $apellido2 = $nombrebd[3];
                    break;
               case 3:
                    $nombre1 = $nombrebd[0];
                    $apellido1 = $nombrebd[1];
                    $apellido2 = $nombrebd[2];
                    break;
               case 2:
                    $nombre1 = $nombrebd[0];
                    $apellido1 = $nombrebd[1];
                    break;
               default:
                    break;
           }
           $personabd->readEnv();
           $personabd->request['nombre1']   = trim($nombre1);
           $personabd->request['nombre2']   = trim($nombre2);
           $personabd->request['apellido1'] = trim($apellido1);
           $personabd->request['apellido2'] = trim($apellido2);
           $personabd->addRecord();
        } else {
            $personabd = $persona->getPersona($personabd);
        }
        if(isset($_POST['check'])) {
           $_SESSION['patrocinio'] = true;
           $organizaciones->readEnv();
           $_SESSION['idorganizacion'] = $organizaciones->request['idorganizacion']; 
        }     
        $cliente = new clienteTable();
        $_REQUEST['idrecibo'] =  $recibo->getlastId();
        $_REQUEST['idpersona'] =  $personabd->getlastId();
        $cliente->readEnv();
        $cliente->addRecord(); 
        //evento       
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
        } elseif ($_REQUEST['tipo'] == 'inscripciones') {
            header("Location: /modulos/tramites/solicitarinscripcion.php?idrecibo=".$recibo->getlastId()); 
            $_SESSION['tipo'] = 'inscripciones';    
        }    
    }    
	*/
	/* bloque de aciones */
	// variebles
	$idsolicitud=0;
	$idrecibo=0;
	$_REQUEST['fecha']  = date('Y-m-d');
	// acciones
	$action=(isset($_REQUEST['action']))?$_REQUEST['action']:"new";
	
	switch($action){
		case 'new':
			break;
		case 'add':
			$solicitud=new solicitudtramite();
			$solicitud->readEnv();
			$solicitud->request['estado']= 'PENDIENTE';
			$solicitud->addRecord();
			// $print_r($_REQUEST);
			$tiposolicitud= $_REQUEST['tipotramite'];
			// echo "tiposolicitud: ". $tiposolicitud;
			switch ($tiposolicitud){
				case 1: 
					$solicitudtramite= new solicitudinscripcion();
					// print_r($solicitudtramite);
					// set attribute value
					$solicitudtramite->readEnv();
					$solicitudtramite->request['idsolicitudinscripcion'] = $solicitud->getlastId();  
					$solicitudtramite->addRecord();
					// echo "ingresando solicitud inscripcion";
					break;	
				case 2: 
					$solicitudtramite= new solicitudcertificacion();
					// set attribute value
					$solicitudtramite->readEnv();
					$solicitudtramite->request['idsolicitudcertificacion'] = $solicitud->getlastId();  
					$solicitudtramite->addRecord();
					// echo "ingresando solicitud certificacion";
					break;
			}
			$excento= (isset($_REQUEST['estaexcento']))?$_REQUEST['estaexcento']:false;
			if($excento){
				$patrocinio = new patrocinio();
				$patrocinio->request['idsolicitudtramite'] = $solicitud->getlastId();
				$patrocinio->request['idorganizacion'] = $_REQUEST['idorganizacion'];
				$patrocinio->addRecord();
			}
			else{
				// echo "creando recibo";
				$recibo= new recibo();
				if(isset($_REQUEST['idrecibo'])){
					$recibobd = $recibo->getRecibo($_REQUEST['idrecibo']); 
				}
				else{
					$_REQUEST['nombrecliente'] = $_REQUEST['nombre'];
					$_REQUEST['monto'] = 0;
					$_REQUEST['estado'] = 0; 
					$_REQUEST['fecha']  = date('Y-m-d');
					$recibo->readEnv();  
					$recibo->addRecord();
					$_REQUEST['idrecibo'] = $recibo->getlastId();           
				}
				$pago = new pagoTable();    
				$_REQUEST['idsolicitudtramite'] =  $solicitud->getlastId();
				$pago->readEnv();
				$pago->addRecord(); 
			}
			break;
		case 'edit':
			if(isset($_GET['idsolicitud'])){
				$solicitud=new solicitudtramite();
				$solicitud->readEnv();
				$solicitud->getSolicitudtramite($_REQUEST['idsolicitud']);
				$smarty->assign('solicitud',$solicitud);


				$tiposolicitud= $solicitud->request['tipotramite'];
				// echo "tiposolicitud: ". $tiposolicitud;
				switch ($tiposolicitud){
					case 1: 
						$solicitudtramite= new solicitudinscripcion();
						$solicitudtramite->getSolicitudInscripcion($solicitud->request['idsolicitudtramite']);
						break;	
					case 2: 
						$solicitudtramite= new solicitudcertificacion();
						$solicitudtramite->getSolicitudCertificacion($solicitud->request['idsolicitudtramite']);
						break;
				}
				$smarty->assign('solicitudtramite',$solicitudtramite->request);
				
				$pago = new pagoTable();    
				$existpago=$pago->getVar("SELECT count(idrecibo) FROM pago WHERE idsolicitudtramite=".$solicitud->request['idsolicitudtramite']);
				if($existpago>0){
					$pago_data= $pago->readDataSQL("SELECT * FROM pago  WHERE idsolicitudtramite=".$solicitud->request['idsolicitudtramite']);
					$recibo= new recibo();
					$recibo->getRecibo($pago_data[0]['idrecibo']);
					$smarty->assign('recibo',$recibo->request);
					$relatedsolicitudes= $recibo->getSolicitudesTramites();
					$smarty->assign('solicitudes',$relatedsolicitudes);
				}
				else{
					$patrocinio= new patrocinio();
					$patrocinio_data= $patrocinio->readDataSQL("SELECT * FROM patrocinio WHERE idsolicitudtramite=".$solicitud->request['idsolicitudtramite']);
					$p_data= $patrocinio_data[0];
					$patrocinio->getPatrocinio($p_data['idsolicitudtramite'],$p_data['idorganizacion']);
					$smarty->assign('patrocinio',$patrocinio->request);
				}
			}
			elseif(!isset($_REQUEST['idsolicitud']) and isset($_REQUEST['idrecibo'])){
					$recibo= new recibo();
					$recibo->getRecibo($_REQUEST['idrecibo']);
					$smarty->assign('recibo',$recibo->request);
					$relatedsolicitudes= $recibo->getSolicitudesTramites();
					$smarty->assign('solicitudes',$relatedsolicitudes);
			}
			break;
		case 'del':
			break;
		case 'save':
			break;
		default:
			break;
	}

	/* fin: bloque de aciones */
    #$smarty->assign('titular',($_REQUEST['tipo'] != '') ? 'Nuevo Recibo Para Solicitudes  de '.$_REQUEST['tipo'] : 'Nuevo Recibo Para Solicitudes ');   
    $smarty->assign('titular','Solicitud de tramite');   
    $recibos = new recibo(); 
    $smarty->assign('tipotramite',$tipotramite);
    $smarty->assign('arrayFormapago',$arrayFormapago);
    $smarty->assign('numero',$recibos->getlastCodigo() + 1);
    $smarty->assign('arraySolicitud',$arraySolicitud);
    $smarty->assign('persona',$persona); 
    $smarty->assign('tipo',$_REQUEST['tipo']);
    $smarty->assign('nombrecliente',$nombrecliente); 
    $smarty->assign('arrayOrganizacion',$arrayOrganizacion);   
    $smarty->assign('template','gestiontramites/editsolicitudtramite.tpl');

	
    $tipotramite = new tipotramite(); 
    $arrayTipotramite = $tipotramite->getAll();
    $smarty->assign('arrayTipotramite',$arrayTipotramite); 

    $rubros = new rubro();
    $arrayRubros = $rubros->getAll();
    $smarty->assign('arrayRubros',$arrayRubros);

	//$smarty->debugging = true;
    $smarty->display('layout.tpl');    
       
} else {
   header("location: /login.php"); 
}

 
?>
