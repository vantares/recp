<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);  

if($usuario->checkCredenciales(array('Tramites'))) { 
	$solicitud = new solicitudTramite();
	$filter = '';
	/**
	if($_REQUEST['nombre'] != '') $filter .= " AND (inscripcion.inscrito1nombre1 LIKE '%".$_REQUEST['nombre']."%' OR inscripcion.inscrito1nombre2 LIKE '%".$_REQUEST['nombre']."%')";
	if($_REQUEST['apellido1'] != '') $filter .= " AND inscripcion.inscrito1apellido1 LIKE '%".$_REQUEST['apellido1']."%'";
	if($_REQUEST['apellido2'] != '') $filter .= " AND inscripcion.inscrito1apellido2 LIKE '%".$_REQUEST['apellido2']."%'";  
	if($_REQUEST['folio'] > 0) $filter .= " AND acta.folio=".$_REQUEST['folio'];
	if($_REQUEST['idtomo'] > 0) $filter .= " AND tomo.numero=".$_REQUEST['idtomo'];
	if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] != ''){
		$filter .= " AND (acta.fecha>='".$_REQUEST['fechainicial']."' AND acta.fecha<='".$_REQUEST['fechafinal']."')";
	} else if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] == ''){   
		$filter .= " AND acta.fecha>='".$_REQUEST['fechainicial']."'";
	} elseif($_REQUEST['fechainicial'] == '' && $_REQUEST['fechafinal'] != ''){  
		$filter .= " AND acta.fecha<='".$_REQUEST['fechafinal']."'";
	} 
	*/

	// $inscripcionesbd = $inscripcion->readDataSQL("SELECT inscripcion.*,acta.*, tomo.numero FROM inscripcion INNER JOIN acta	ON acta.idinscripcion=inscripcion.idinscripcion	INNER JOIN tomo	ON acta.idtomo=tomo.idtomo WHERE inscripcion.tipoinscripcion='Nacimientos' ".$filter." ORDER BY acta.fecha DESC");
	// $solicitudesbd= $solicitud->readDataSQL("SELECT t.idsolicitudtramite as id, t.tipotramite as tipo,	to_char(t.fecha, 'DD-MM-YYYY') as fechasolicitud, to_char(t.fechaentrega, 'DD-MM-YYYY') as fecharetiro, t.estado, t.solicitante1 FROM solicitudtramite t ORDER BY t.fechaentrega DESC, t.fecha DESC");
	// $solicitudesbd= $solicitud->readDataSQL("SELECT t.idsolicitudtramite as id, tt.tipotramite as tipo, to_char(t.fecha, 'DD-MM-YYYY') as fechasolicitud, to_char(t.fechaentrega, 'DD-MM-YYYY') as fecharetiro, t.estado, t.solicitante1 FROM solicitudtramite t left join tipotramite tt on t.tipotramite=ltrim(to_char(tt.idtipotramite,'9')) ORDER BY t.fechaentrega DESC, t.fecha DESC");
	$solicitudesbd= $solicitud->readDataSQL("SELECT t.idsolicitudtramite as id, tt.tipotramite as tipo, COALESCE(si.tipoinscripcion, sc.tipocertificacion) as sub_tipo, to_char(t.fecha, 'DD-MM-YYYY') as fechasolicitud, to_char(t.fechaentrega, 'DD-MM-YYYY') as fecharetiro, t.estado, t.solicitante1 FROM solicitudtramite t left join tipotramite tt on t.tipotramite=ltrim(to_char(tt.idtipotramite,'9')) left outer join solicitudinscripcion si on t.idsolicitudtramite=si.idsolicitudinscripcion left outer join solicitudcertificacion sc on t.idsolicitudtramite=sc.idsolicitudcertificacion ORDER BY t.estado ASC, t.fechaentrega DESC");
	// print_r($solicitudesbd);
	$cadena = new TCadena();
	/*
	$smarty->assign('nombre',$_REQUEST['nombre']);   
	$smarty->assign('apellido1',$_REQUEST['apellido1']); 
	$smarty->assign('apellido2',$_REQUEST['apellido2']); 
	$smarty->assign('idtomo',$_REQUEST['idtomo']);
	$smarty->assign('folio',$_REQUEST['folio']);
	$smarty->assign('paginad','detallesnacimiento.php');
	$smarty->assign('pagina','editnacimiento.php');
	$smarty->assign('inscripcion','nacimiento'); 
	$smarty->assign('fechainicial',$_REQUEST['fechainicial']);
	$smarty->assign('fechafinal',$_REQUEST['fechafinal']); 
	*/
	if($solicitudesbd) {  
		$smarty->assign('arraySolicitud',$cadena->convert_sqlData_toString($solicitudesbd));
		$smarty->assign('arrayPosiciones',$cadena->getPosArrayByObject($solicitudesbd,array('id','tipo','sub_tipo','fechasolicitud','fecharetiro','estado','solicitante1')));
		// print_r($cadena->getPosArrayByObject($solicitudesbd,array('id','tipo','fecha','fechaentrega','estado','solicitante1')));
	}
	$opciones= array("option"=>array("opt1"=>"value1","opt2"=>"value2"));
	$smarty->assign('urlnueva','/modulos/gestiontramites/editsolicitudtramite.php?action=new');
	$smarty->assign('template','gestiontramites/listadosolicitudes.tpl'); 
	$smarty->assign('titular','Listado de Solicitudes'); 
	$smarty->assign('camino','Tramites >> Solicitudes >> Listado'); 
	$smarty->assign('callback','generic_callback');
	// $smarty->assign('options',json_encode($opciones));

	$smarty->display('layout.tpl');  
} else {
	header("Location: ./login.php");
}
?>
