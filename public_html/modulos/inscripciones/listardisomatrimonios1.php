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
                                                         acta.*,
                                                         tomo.numero 
                                                    FROM inscripcion 
                                              INNER JOIN acta
                                                      ON acta.idinscripcion=inscripcion.idinscripcion
                                              INNER JOIN tomo
                                                      ON acta.idtomo=tomo.idtomo                                                          
                                                   WHERE inscripcion.tipoinscripcion='Disolucion Vinculo Matrimonial' ".
                                                         $filter.' ORDER BY acta.fecha DESC');

    $cadena = new TCadena();   
    $smarty->assign('nombre',$_REQUEST['nombre']);   
    $smarty->assign('apellido1',$_REQUEST['apellido1']); 
    $smarty->assign('apellido2',$_REQUEST['apellido2']); 
    $smarty->assign('idtomo',$_REQUEST['idtomo']);
    $smarty->assign('folio',$_REQUEST['folio']);
    $smarty->assign('pagina','editdisolucionmatrimonio.php');   
    $smarty->assign('fechainicial',$_REQUEST['fechainicial']);
    $smarty->assign('fechafinal',$_REQUEST['fechafinal']);  
    $smarty->assign('arrayInscripcion',$cadena->convert_sqlData_toString($inscripcionesbd));
    $smarty->assign('urlnueva','/modulos/inscripciones/adddisolucionmatrimonio.php');
    $smarty->assign('template','inscripciones/listadoinscripciones.tpl'); 
    $smarty->assign('titular','Listado de Disolucion de Matrimonios'); 
    $smarty->assign('camino','Inscripcion >> Disolucion de Matrimonios >> Listado'); 
    $smarty->display('layout.tpl');  
} else {
    header("Location: ./login.php");
}  
?>
