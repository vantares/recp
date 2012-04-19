<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    $inscripcion = new inscripcion();
    $filter = '';
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
    $inscripcionesbd = $inscripcion->readDataSQL("SELECT inscripcion.*,
                                                         matrimonio.inscrito2nombre1,
                                                         matrimonio.inscrito2nombre2,
                                                         matrimonio.inscrito2apellido1,
                                                         matrimonio.inscrito2apellido2,
                                                         acta.*,
                                                         tomo.numero
                                                    FROM inscripcion 
                                              INNER JOIN acta
                                                      ON acta.idinscripcion=inscripcion.idinscripcion
                                              INNER JOIN matrimonio
                                                      ON inscripcion.idinscripcion=matrimonio.idmatrimonio                                                      
                                              INNER JOIN tomo
                                                      ON acta.idtomo=tomo.idtomo                                                          
                                                   WHERE inscripcion.tipoinscripcion='Matrimonios' ".
                                                         $filter.' ORDER BY acta.fecha DESC');
    $cadena = new TCadena();    
    $smarty->assign('nombre',$_REQUEST['nombre']);   
    $smarty->assign('apellido1',$_REQUEST['apellido1']); 
    $smarty->assign('apellido2',$_REQUEST['apellido2']); 
    $smarty->assign('idtomo',$_REQUEST['idtomo']);
    $smarty->assign('folio',$_REQUEST['folio']);
    $smarty->assign('pagina','editmatrimonio.php');
    $smarty->assign('paginad','detallesmatrimonio.php');
    $smarty->assign('fechainicial',$_REQUEST['fechainicial']);
    $smarty->assign('fechafinal',$_REQUEST['fechafinal']);  
    $smarty->assign('inscripcion','matrimonio'); 
    if($inscripcionesbd) { 
        $smarty->assign('arrayInscripcion',$cadena->convert_sqlData_toString($inscripcionesbd));
        $smarty->assign('arrayPosiciones',$cadena->getPosArrayByObject($inscripcionesbd,array('idinscripcion','numero','folio','inscrito1nombre1','inscrito1nombre2','inscrito1apellido1','inscrito1apellido2','inscrito2nombre1','inscrito2nombre2','inscrito2apellido1','inscrito2apellido2','fecha','partida')));
    }
    $smarty->assign('urlnueva','/modulos/inscripciones/addmatrimonio.php');
    $smarty->assign('template','inscripciones/listadomatrimonio.tpl'); 
    $smarty->assign('titular','Listado de Inscripciones de Matrimonio'); 
    $smarty->assign('camino','Inscripcion >> Matrimonios >> Listado'); 
    $smarty->display('layout.tpl');  
} else {
    header("Location: ./login.php");
}
?>
