<?php
include_once('../../../common.inc.php');
require_once('../../../../classes/function.numeros.php'); 
if(isset($_REQUEST['solicitudes_seleccionadas'])){
	$solicitudes= explode(",",trim($_REQUEST['solicitudes_seleccionadas'],","));
	$solicitudesProcesadas= array();
	foreach($solicitudes as $id=>$item){
		$solicitud = new solicitudTramite();
		$solicitud->getSolicitudtramite($item);
		$solicitudesProcesadas[]= $solicitud;

	}

	foreach($solicitudesProcesadas as &$solicitudespecifica ){
		$tiposol= $solicitudespecifica->request['tipotramite'];
		if($tiposol=='1'){
			$solicitud_tramite= $solicitudespecifica->getSolicitudInscripcion();
			$solicitudespecifica->solicitudTramite= $solicitud_tramite;
			$solicitudespecifica->respuesta= $solicitud_tramite->getRespuesta();
			$inscripcion= new inscripcion();
			$inscripcion->getInscripcion($solicitudespecifica->respuesta->request['idinscripcion']);
			//print_r($inscripcion->request);
			$solicitudespecifica->inscripcion= $inscripcion;
			//print_r($solicitudespecifica->inscripcion->request);
			//$solicitudespecifica->inscripcion= $inscripcion->getInscripcion($solicitudespecifica->respuesta->request['idinscripcion']);
		}
		else{
			$solicitud_tramite= $solicitudespecifica->getSolicitudcertificacion();
			$solicitudespecifica->solicitudTramite= $solicitud_tramite;
			$solicitudespecifica->respuesta= $solicitud_tramite->getRespuesta();
			$inscripcion= new inscripcion();
			$inscripciones_coincidentes= $inscripcion->readDataSQL("SELECT inscripcion.idinscripcion FROM inscripcion INNER JOIN acta ON acta.idinscripcion=inscripcion.idinscripcion INNER JOIN tomo ON acta.idtomo=tomo.idtomo WHERE inscripcion.tipoinscripcion='".$solicitud_tramite->request['tipocertificacion']."' AND acta.folio=".$solicitud_tramite->request['folio']." AND tomo.numero=".$solicitud_tramite->request['tomo']." and acta.partida=".$solicitud_tramite->request['partida']." ORDER BY acta.fecha DESC");
			if(sizeof($inscripciones_coincidentes) > 0){
				$solicitudespecifica->inscripcion= $inscripcion->getInscripcion($inscripciones_coincidentes[0]['idinscripcion']);
			}
			else{
			}
		}
		$rubros = new rubro();
		$arrayRubros = $rubros->getAll();
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
			if($rubro['nombre']==$solicitudespecifica->solicitudTramite->request['tipoinscripcion'] or $rubro['nombre']==$solicitudespecifica->solicitudTramite->request['tipocertificacion']){
				$solicitudespecifica->tipo= $arr_addnew[$rubro['idrubro']];
				break;
			}
		}

		$solicitudespecifica->solicitudTramite= $solicitud_tramite;
		$solicitudespecifica->respuesta= $solicitud_tramite->getRespuesta();
	}
	foreach($solicitudesProcesadas as $index=>$solicitud_print ){
		$_REQUEST['inscripcion']= $solicitud_print->inscripcion->request['idinscripcion'];
		$_REQUEST['tipo'] = $solicitud_print->tipo;
		//print_r($_REQUEST['tipo']);
		$_REQUEST['action'] = 'imprimir';
		$data=  $solicitud_print->inscripcion;
		//print_r($solicitud_print->inscripcion->request);
		if($_REQUEST['tipobloque']=='2'){
			require_once("certificaciones_start_pdf.php");
			if(isset($solicitud_print->inscripcion)){
				require("../certificados/certification_data.php");
			}
			else{
			}
		}
		elseif($_REQUEST['tipobloque']=='1'){
			require_once("inscripciones_start_pdf.php");
			if(isset($solicitud_print->inscripcion)){
				require("select_insc_pdf.php");
			}
			else{
			}
		}
		unset($data);
	}
	$pdf->Output();
}
?>
