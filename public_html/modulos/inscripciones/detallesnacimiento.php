<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if(isset($_REQUEST['accion'])) $args[1] = $_REQUEST['accion']; 
    if($usuario->checkCredenciales(array('Inscripciones'))) { 
        $smarty->assign('camino','>> Inscripciones >> Nacimientos >> Editando');  
        $smarty->assign('template','inscripciones/nacimiento.tpl');
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $libroregistral = new libroregistral();
            $libroregistralbd = $libroregistral->getLibroByRubro('Nacimientos');
            $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
            $tomos = new tomo();           
            $_REQUEST['idinscripcion'] = $_REQUEST['id'];
            $inscripcion = new inscripcion();
            $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
            $acta = $inscripcionbd->getActa();
            $hechovital = $inscripcionbd->getHechoVital();
            $nacimiento = $hechovital->getNacimiento();
            $perfil = new Perfil();
            $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
            $smarty->assign('Perfil',$perfilbd);
            $smarty->assign('disabled', 'disabled=disabled');
            $smarty->assign('Municipio',$hechovital->request['municipionacimiento']); 
            $smarty->assign('Provincia',$hechovital->request['ciudadnacimiento']);
            $smarty->assign('Departamento',$hechovital->request['departamentonacimiento']);   
            $smarty->assign('Pais',$hechovital->request['paisnacimiento']);  
            $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
            $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
            $smarty->assign('inscripcion',$inscripcionbd);
            $smarty->assign('fechainscripcion',$acta->request['fecha']); 
            $smarty->assign('sexoinscrito',$hechovital->request['sexoinscrito']);
            $smarty->assign('fechanacimiento',$hechovital->request['fechanacimiento']); 
            /*if(is_array($arrayTomos)) {
                foreach($arrayTomos as $tomo) {
                    $tomobd = $tomos->getTomo($tomo['idtomo']);
                    $arrayPartFolio[$tomo['idtomo']]['partida'] = $tomobd->getLastPartida() + 1;
                    $arrayPartFolio[$tomo['idtomo']]['folio'] = $tomobd->getLastFolio() + 1; 
                }
            } else { */
               $tomobd = $tomos->getTomo($acta->request['idtomo']); 
            //}  
            $smarty->assign('folio',$acta->request['folio']);
            $smarty->assign('tomo',$acta->request['idtomo']); 
            $smarty->assign('tomobd',$tomobd);  
            $smarty->assign('partida',$acta->request['partida']);
            $smarty->assign('arrayPartFolio',$arrayPartFolio);    
            $smarty->assign('arrayTomos',$arrayTomos);
            //Compareciente1
            $arrayPersona['comparecientes1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
            $arrayPersona['comparecientes1']['edad'] = $inscripcionbd->request['compareciente1edad'];
            $arrayPersona['comparecientes1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
            $arrayPersona['comparecientes1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
            $arrayPersona['comparecientes1']['nacionalidad'] = $nacimiento->request['compareciente1nacionalidad'];
            $arrayPersona['comparecientes1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
            //Compareciente2
            $arrayPersona['comparecientes2']['nombre'] =  $nacimiento->request['compareciente2nombre'];
            $arrayPersona['comparecientes2']['edad'] = $nacimiento->request['compareciente2edad'];
            $arrayPersona['comparecientes2']['oficio'] = $nacimiento->request['compareciente2oficio']; 
            $arrayPersona['comparecientes2']['domicilio'] = $nacimiento->request['compareciente2domicilio'];
            $arrayPersona['comparecientes2']['nacionalidad'] = $nacimiento->request['compareciente2nacionalidad'];
            $arrayPersona['comparecientes2']['cedula'] = $nacimiento->request['compareciente2cedula']; 
            //padre
            $arrayPersona['padre']['nombre'] =  $hechovital->request['padrenombre'];
            $arrayPersona['padre']['edad'] = $nacimiento->request['edadpadre'];
            $arrayPersona['padre']['oficio'] = $nacimiento->request['oficiopadre']; 
            $arrayPersona['padre']['domicilio'] = $nacimiento->request['domiciliopadre'];
            $arrayPersona['padre']['nacionalidad'] = $nacimiento->request['nacionalidadpadre'];  
            $arrayPersona['padre']['cedula'] = $nacimiento->request['cedulapadre']; 
            //Madre
            $arrayPersona['madre']['nombre'] =  $hechovital->request['nombremadre'];
            $arrayPersona['madre']['edad'] = $nacimiento->request['edadmadre'];
            $arrayPersona['madre']['oficio'] = $nacimiento->request['oficiomadre']; 
            $arrayPersona['madre']['domicilio'] = $nacimiento->request['domiciliomadre'];
            $arrayPersona['madre']['nacionalidad'] = $nacimiento->request['nacionalidadmadre'];  
            $arrayPersona['madre']['cedula'] = $nacimiento->request['cedulamadre']; 
            $smarty->assign('persona',$arrayPersona); 
            $arrayNotasMarginales = $inscripcionbd->getNotasmarginales();
            $smarty->assign('notasmarginalesbd',$arrayNotasMarginales); 
            $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
            $smarty->assign('etiqueta','edit'); 
            $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']);             
            $smarty->assign('url','/modulos/inscripciones/editnacimiento.php?id='.$inscripcionbd->request['idinscripcion']);                                    
            $smarty->assign('camino','>> Inscripciones >> Nacimientos >> Editando');  
            $smarty->display('layout.tpl');
        }
} else {
    header("Location: ./login.php");
}     
?>
