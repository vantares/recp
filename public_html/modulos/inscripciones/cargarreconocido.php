<?php
include_once('../../common.inc.php');
$folio = $_REQUEST['folio'];  
$numero = $_REQUEST['idtomo'];
$smarty->assign('add','add'); 
$filter = '';
if($_REQUEST['nombre1'] != '') $filter .= " AND (inscripcion.inscrito1nombre1 ILIKE '%".$_REQUEST['nombre1']."%')";
if($_REQUEST['nombre2'] != '') $filter .= " AND (inscripcion.inscrito1nombre2 ILIKE '%".$_REQUEST['nombre2']."%')";
if($_REQUEST['apellido1'] != '') $filter .= " AND (inscripcion.inscrito1apellido1 ILIKE '%".$_REQUEST['apellido1']."%')";
if($_REQUEST['apellido2'] != '') $filter .= " AND (inscripcion.inscrito1apellido2 ILIKE '%".$_REQUEST['apellido2']."%')";
if($_REQUEST['folio'] > 0) $filter .= " AND acta.folio=".$_REQUEST['folio'];
if($_REQUEST['idtomo'] > 0) {
    $tomo = new tomo();
    $idtomo = $tomo->getIdTomoByLibroNumero(1,$numero); 
    if($idtomo != '') {     
         $filter .= " AND acta.idtomo=".$idtomo;
    } else {
        $smarty->assign('error','No hay nacimiento registrado con esos datos en el sistema');
        die;
    } 
}    
if($_REQUEST['partida'] > 0) $filter .= " AND acta.partida=".$_REQUEST['partida'];
if($_REQUEST['lugarnacimiento'] > 0) $filter .= " AND hechovital.ciudadnacimiento=".$_REQUEST['lugarnacimiento'];
if($_REQUEST['fechanacimiento'] > 0) $filter .= " AND hechovital.fechanacimiento=".$_REQUEST['fechanacimiento'];
//if($_REQUEST['anyo'] > 0) $filter .= " AND reconocimiento.anyo=".$_REQUEST['anyo'];
$sql = "SELECT inscripcion.inscrito1nombre1,
               inscripcion.inscrito1nombre2,
               inscripcion.inscrito1apellido1,
               inscripcion.inscrito1apellido2,
               inscripcion.idinscripcion,
               acta.folio,
               tomo.numero,
               acta.partida,
               hechovital.fechanacimiento
          FROM inscripcion
    INNER JOIN acta
            ON inscripcion.idinscripcion = acta.idinscripcion
    INNER JOIN hechovital
            ON inscripcion.idinscripcion = hechovital.idhechovital
    INNER JOIN tomo
            ON acta.idtomo = tomo.idtomo            
         WHERE  inscripcion.idinscripcion != -1 ".$filter;
$reconocidos = new reconocido();
$arrayResultados = $reconocidos->readDataSQL($sql);
if(count($arrayResultados) > 0) {
    $smarty->assign('visiblehijo',$_REQUEST['visiblehijo']);
    $smarty->assign('idinscripcionmatrimonio',$_REQUEST['id']);  
    $smarty->assign('arrayreconocidos',$arrayResultados); 
} else {
    $smarty->assign('error','No hay nacimiento registrado con esos datos en el sistema');
} 
$smarty->display($_REQUEST['template']);   
?>
