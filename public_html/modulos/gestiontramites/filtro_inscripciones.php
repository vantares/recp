<?php
include_once('../../common.inc.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    $inscripcion = new inscripcion();
    $filter = '';
    if($_REQUEST['nombre'] != '') $filter .= " AND (inscripcion.inscrito1nombre1 ILIKE '%".$_REQUEST['nombre']."%' OR inscripcion.inscrito1nombre2 ILIKE '%".$_REQUEST['nombre']."%' OR '".$_REQUEST['nombre']."' ILIKE '%'||inscripcion.inscrito1nombre1||'%')";
    if($_REQUEST['apellido1'] != '') $filter .= " AND inscripcion.inscrito1apellido1 ILIKE '%".$_REQUEST['apellido1']."%'";
    if($_REQUEST['apellido2'] != '') $filter .= " AND inscripcion.inscrito1apellido2 ILIKE '%".$_REQUEST['apellido2']."%'";  
    if($_REQUEST['folio'] > 0) $filter .= " AND acta.folio=".$_REQUEST['folio'];
    if($_REQUEST['idtomo'] > 0) $filter .= " AND tomo.numero=".$_REQUEST['idtomo'];
    if($_REQUEST['tipoinscripcion'] != '') $filter .= " AND inscripcion.tipoinscripcion='".$_REQUEST['tipoinscripcion']."'";
    if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] != ''){
         $filter .= " AND (acta.fecha>='".$_REQUEST['fechainicial']."' AND acta.fecha<='".$_REQUEST['fechafinal']."')";
    } else if($_REQUEST['fechainicial'] != '' && $_REQUEST['fechafinal'] == ''){   
        $filter .= " AND acta.fecha>='".$_REQUEST['fechainicial']."'";
    } elseif($_REQUEST['fechainicial'] == '' && $_REQUEST['fechafinal'] != ''){  
        $filter .= " AND acta.fecha<='".$_REQUEST['fechafinal']."'";
    } 

    $inscripcionesbd = $inscripcion->readDataSQL("SELECT inscripcion.*, acta.*, tomo.numero FROM inscripcion INNER JOIN acta ON acta.idinscripcion=inscripcion.idinscripcion INNER JOIN tomo ON acta.idtomo=tomo.idtomo WHERE  inscripcion.idinscripcion>0 ".$filter.' ORDER BY acta.fecha DESC');
    #$inscripcionesbd = $inscripcion->readDataSQL("SELECT inscripcion.*, acta.*, tomo.numero FROM inscripcion INNER JOIN acta ON acta.idinscripcion=inscripcion.idinscripcion INNER JOIN tomo ON acta.idtomo=tomo.idtomo WHERE inscripcion.tipoinscripcion='".$tipoinscripcion."' ". $filter.' ORDER BY acta.fecha DESC');
    $cadena = new TCadena();
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
	$smarty->assign('tipoinscripcion',$_REQUEST['tipoinscripcion']);
    if($inscripcionesbd) {  
        $smarty->assign('inscripciones',$inscripcionesbd);
        //$smarty->assign('arrayInscripcion',$cadena->convert_sqlData_toString($inscripcionesbd));
        //$smarty->assign('arrayPosiciones',$cadena->getPosArrayByObject($inscripcionesbd,array('idinscripcion','numero','folio','inscrito1nombre1','inscrito1nombre2','inscrito1apellido1','inscrito1apellido2','fecha','partida')));
    }
    //$smarty->assign('urlnueva','/modulos/inscripciones/addnacimiento.php');
    //$smarty->assign('template','inscripciones/listadoinscripciones.tpl'); 
    //$smarty->assign('titular','Listado de Inscripciones de Nacimiento'); 
   // $smarty->assign('camino','Inscripcion >> Nacimiento >> Listado'); 
   $smarty->display('gestiontramites/listainscripciones.tpl');  
} else {
    header("Location: ./login.php");
}
?>
