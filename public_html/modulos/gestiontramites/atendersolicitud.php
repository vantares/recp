<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
if($user->checkCredenciales(array('Pagos'))) {     
	// datos de la solicitud
	$action=$_REQUEST['action'];
	if(isset($action) and !empty($action)){

	}
	if(isset($_GET['idsolicitud'])){
		$solicitud=new solicitudtramite();
		$solicitud->readEnv();
		$solicitud->getSolicitudtramite($_REQUEST['idsolicitud']);
		$smarty->assign('solicitud',$solicitud->request);


		$tiposolicitud= $solicitud->request['tipotramite'];
		// echo "tiposolicitud: ". $tiposolicitud;
		switch ($tiposolicitud){
			case 1: 
				$solicitudtramite= new solicitudinscripcion();
				$solicitudtramite->getSolicitudInscripcion($solicitud->request['idsolicitudtramite']);
				$tipoinscripcion=$solicitudtramite->request['tipoinscripcion'];
				//salvar la respuesta a la solicitud 
				if(isset($action) and !empty($action)){
					if($action=="respond"){
						$respuesta= new respuestasolicitudinscripcion(); 
						$idinscripcion= $_REQUEST['idinscripcion'];
						if(!empty($idinscripcion)){
							$respuesta->getRespuestaSolicitudInscripcion($idinscripcion,$solicitud->request['idsolicitudtramite']);
							$respuesta->addRecord();
							$solicitud->request['estado']="PROCESANDOSE";
							$solicitud->updateRecord();
							header("location: /modulos/gestiontramites/"); 

						}
					}
				}
				break;	
			case 2: 
				$solicitudtramite= new solicitudcertificacion();
				$solicitudtramite->getSolicitudCertificacion($solicitud->request['idsolicitudtramite']);
				$tipoinscripcion=$solicitudtramite->request['tipocertificacion'];
				// redireccionar a la toma de datos de la certificacion: (fecha de registro, registrador y secretario, tipo de certificacion)
				$certificacion= new certificacion();
				$certificaciones= $certificacion->readDataFilter("idsolicitud=".$solicitud->request['idsolicitudtramite']);

				$smarty->assign('Secretarios',$usuarios->getUsersByRol('secretario'));
				$smarty->assign('Registradores',$usuarios->getUsersByRol('registrador'));

				if(count($certificaciones)>0){
					$smarty->assign("certificacion",$certificaciones[0]);
				}
				if(isset($action) and !empty($action)){
					if($action=="respond"){
						$respuesta= new respuestasolicitudcertificacion(); 
						$idinscripcion= $_REQUEST['idinscripcion'];
						if(!empty($idinscripcion)){
							//agregar certificacion
							$certificacion= new certificacion();
							if(sizeof($certificaciones)<=0){
								$certificacion->readEnv();
								$certificacion->addRecord();
								$idcertificacion= $certificacion->getVar("SELECT last_value FROM certificacion_idcertificacion_seq");
								//error_log(print_r($certificacion,1));
								//agregar respuesta a solicitud
								$respuesta->getRespuestaSolicitudCertificacion($idcertificacion,$solicitud->request['idsolicitudtramite']);
								$respuesta->addRecord();
								$solicitud->request['estado']="PROCESANDOSE";
								$solicitud->updateRecord();
							}
							header("location: /modulos/gestiontramites/"); 

						}
					}
				}
				break;	
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
			//error_log(print_r($relatedsolicitudes,1));
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

	$formadepago = new formasdepagoTable();
	$arrayFormapago = $formadepago->readData();               
	$smarty->assign('arrayFormapago',$arrayFormapago);

	$tipotramite = new tipotramite(); 
	$arrayTipotramite = $tipotramite->getAll();
	$smarty->assign('arrayTipotramite',$arrayTipotramite); 

	$rubros = new rubro();
	$arrayRubros = $rubros->getAll();
	$smarty->assign('arrayRubros',$arrayRubros);

	$filter="";
	//$tipoinscripcion="Nacimientos";
	$inscripcion = new inscripcion();
	$inscripcionesbd = $inscripcion->readDataSQL("SELECT inscripcion.*, acta.*, tomo.numero FROM inscripcion INNER JOIN acta ON acta.idinscripcion=inscripcion.idinscripcion INNER JOIN tomo ON acta.idtomo=tomo.idtomo WHERE inscripcion.tipoinscripcion='".$tipoinscripcion."' ". $filter.' ORDER BY acta.fecha DESC');
#$inscripcionesbd = $inscripcion->readDataSQL("SELECT inscripcion.*, acta.*, tomo.numero FROM inscripcion INNER JOIN acta ON acta.idinscripcion=inscripcion.idinscripcion INNER JOIN tomo ON acta.idtomo=tomo.idtomo ORDER BY acta.fecha DESC");
	$smarty->assign('inscripciones',$inscripcionesbd);
	$smarty->assign('tipoinscripcion',$tipoinscripcion);
	/*  aca evaluarel tipo de inscripcion  */
	$arr_addnew= array(
			1=>"nacimiento",
			3=>"defuncion",
			2=>"matrimonio",
			4=>"reponacimeinto",
			5=>"repodefuncion",
			8=>"repomatrimonio",
			6=>"disolucionmatrimonio",
			7=>"inscripcionvaria"
			);

	foreach($arrayRubros as $rubro){
		if($rubro['nombre']==$solicitudtramite->request['tipoinscripcion'] or $rubro['nombre']==$solicitudtramite->request['tipocertificacion']){
			$solicitud_rubro= $rubro['idrubro'];
			break;
		}
	}


	$url_addinscripcion= "/modulos/inscripciones/add".$arr_addnew[$solicitud_rubro];
	$smarty->assign('urlnueva',$url_addinscripcion);
	$smarty->assign('rubrosolicitud',$arr_addnew[$solicitud_rubro]);

	//$smarty->debugging = true;
	$smarty->assign('template','gestiontramites/atendersolicitud.tpl');
	$smarty->display('layout.tpl');    
} 
else {
	header("location: /login.php"); 
}
?>
