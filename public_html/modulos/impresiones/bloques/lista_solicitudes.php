<?php
include_once('../../../common.inc.php');
include_once(HOMEDIR.'/menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);  

if($usuario->checkCredenciales(array('Tramites'))) { 
	$solicitud = new solicitudTramite();
	$filter = '';
	if(isset($_REQUEST['tipotramite']) and !empty($_REQUEST['tipotramite'])){
		$filter.="tipotramite='".$_REQUEST['tipotramite']."'";
	}
	if(!empty($_REQUEST['tipotramite']) and isset($_REQUEST['sub_tipo']) and !empty($_REQUEST['sub_tipo'])){
		$filter.=" AND sub_tipo='".$_REQUEST['sub_tipo']."'";
	}

	$query= "SELECT t.idsolicitudtramite as id, t.tipotramite, tt.tipotramite as tipo, COALESCE(si.tipoinscripcion, sc.tipocertificacion) as sub_tipo, to_char(t.fecha, 'DD-MM-YYYY') as fechasolicitud, to_char(t.fechaentrega, 'DD-MM-YYYY') as fecharetiro, t.estado, t.solicitante1 FROM solicitudtramite t left join tipotramite tt on t.tipotramite=ltrim(to_char(tt.idtipotramite,'9')) left outer join solicitudinscripcion si on t.idsolicitudtramite=si.idsolicitudinscripcion left outer join solicitudcertificacion sc on t.idsolicitudtramite=sc.idsolicitudcertificacion WHERE t.estado='PROCESANDOSE'  ORDER BY t.fechaentrega DESC, t.fecha DESC, t.estado ASC";
	if(!empty($filter)){
		$filter= "WHERE ".$filter;
		$query= "SELECT * from (".$query.") tp ".$filter;
	}
	# $solicitudesbd= $solicitud->readDataSQL("SELECT t.idsolicitudtramite as id, t.tipotramite, tt.tipotramite as tipo, COALESCE(si.tipoinscripcion, sc.tipocertificacion) as sub_tipo, to_char(t.fecha, 'DD-MM-YYYY') as fechasolicitud, to_char(t.fechaentrega, 'DD-MM-YYYY') as fecharetiro, t.estado, t.solicitante1 FROM solicitudtramite t left join tipotramite tt on t.tipotramite=ltrim(to_char(tt.idtipotramite,'9')) left outer join solicitudinscripcion si on t.idsolicitudtramite=si.idsolicitudinscripcion left outer join solicitudcertificacion sc on t.idsolicitudtramite=sc.idsolicitudcertificacion WHERE t.estado='PROCESANDOSE'  ORDER BY t.fechaentrega DESC, t.fecha DESC, t.estado ASC");
	$solicitudesbd= $solicitud->readDataSQL($query);
	$cadena = new TCadena();
	if($solicitudesbd) {  
		$smarty->assign('arraySolicitud',$cadena->convert_sqlData_toString($solicitudesbd));
		$smarty->assign('arrayPosiciones',$cadena->getPosArrayByObject($solicitudesbd,array('id','tipo','sub_tipo','fechasolicitud','fecharetiro','estado','solicitante1')));
		// print_r($cadena->getPosArrayByObject($solicitudesbd,array('id','tipo','fecha','fechaentrega','estado','solicitante1')));
	}

	$tipotramite = new tipotramite(); 
	$arrayTipotramite = $tipotramite->getAll();
	$smarty->assign('arrayTipotramite',$arrayTipotramite); 

	$rubros = new rubro();
	$arrayRubros = $rubros->getAll();
	$smarty->assign('arrayRubros',$arrayRubros);

	$opciones= array("option"=>array("opt1"=>"value1","opt2"=>"value2"));
	$smarty->assign('urlnueva','/modulos/impresiones/bloques/imprimir');
	$smarty->assign('template','impresiones/listado_atenciones.tpl'); 
	$smarty->assign('titular','Listado de Solicitudes'); 
	$smarty->assign('camino','Tramites >> Solicitudes en proceso >> Listado'); 
	$smarty->assign('callback','generic_callback');
	$smarty->display('layout.tpl');  
} else {
	header("Location: ./login.php");
}
?>
