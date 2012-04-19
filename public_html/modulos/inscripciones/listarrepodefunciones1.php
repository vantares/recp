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

    if($filter == ''){    
        $inscripcionesbd = $inscripcion->readDataFilter("inscripcion.tipoinscripcion='Reposicion Defuncion' ");
        foreach($inscripcionesbd as $key => $inscripcionvalor) {
            $inscripcionbd = $inscripcion->getInscripcion($inscripcionvalor);  
            $actabd = $inscripcionbd->getActa();
            $inscripcionvalor['numero'] = $actabd->getNoTomo();  
            $inscripcionvalor['folio'] = $actabd->request['folio'];  
            $inscripcionesbd[$key] = $inscripcionvalor;
        }     
    } else {
        $inscripcionesbd = $inscripcion->readDataSQL("SELECT inscripcion.*,
                                                             acta.*,
                                                             tomo.numero 
                                                        FROM inscripcion 
                                                  INNER JOIN acta
                                                          ON acta.idinscripcion=inscripcion.idinscripcion
                                                  INNER JOIN tomo
                                                          ON acta.idtomo=tomo.idtomo                                                          
                                                       WHERE inscripcion.tipoinscripcion='Reposicion Defuncion' ".
                                                             $filter);
    }  
    $cadena = new TCadena();  
    $smarty->assign('nombre',$_REQUEST['nombre']);   
    $smarty->assign('apellido1',$_REQUEST['apellido1']); 
    $smarty->assign('apellido2',$_REQUEST['apellido2']); 
    $smarty->assign('idtomo',$_REQUEST['idtomo']);
    $smarty->assign('folio',$_REQUEST['folio']);
    $smarty->assign('pagina','editrepodefuncion.php');   
    $smarty->assign('fechainicial',$_REQUEST['fechainicial']);
    $smarty->assign('fechafinal',$_REQUEST['fechafinal']); 
    $smarty->assign('inscripcion','repodefuncion');  
    $smarty->assign('arrayInscripcion',$cadena->convert_sqlData_toString($inscripcionesbd));
    $smarty->assign('urlnueva','/modulos/inscripciones/addrepodefuncion.php');
    $smarty->assign('template','inscripciones/listadoinscripciones.tpl'); 
    $smarty->assign('titular','Listado de Repociciones de Defuncion'); 
    $smarty->assign('camino','Inscripcion >> Reposicion Defuncion >> Listado'); 
    $smarty->display('layout.tpl'); 
} else {
    header("Location: ./login.php");
} 
?>
