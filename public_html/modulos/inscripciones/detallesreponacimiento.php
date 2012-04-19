<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if(isset($_REQUEST['accion'])) $args[1] = $_REQUEST['accion']; 
    if($usuario->checkCredenciales(array('Inscripciones'))) { 
        $smarty->assign('camino','>> Inscripciones >> Reposicion Nacimientos >> Editando');  
        $smarty->assign('template','inscripciones/reponacimiento.tpl');
        if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
            $libroregistral = new libroregistral();
            $libroregistralbd = $libroregistral->getLibroByRubro('Reposicion Nacimiento');
            $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
            $tomos = new tomo(); 
            $_REQUEST['idinscripcion'] = $_REQUEST['id'];
            $inscripcion = new inscripcion();
            $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
            $acta = $inscripcionbd->getActa();
            $repohechovital = $inscripcionbd->getRepoHechoVital();    
            $reponacimiento = $repohechovital->getReposicionnacimiento();
            $perfil = new Perfil();
            $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
            $smarty->assign('Perfil',$perfilbd);
            $smarty->assign('disabled','disabled=disabled');
            $smarty->assign('Municipio',$repohechovital->request['municipionacimiento']); 
            $smarty->assign('Provincia',$repohechovital->request['ciudadnacimiento']);
            $smarty->assign('Departamento',$repohechovital->request['departamentonacimiento']);   
            $smarty->assign('Pais',$repohechovital->request['paisnacimiento']);  
            $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
            $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
            $smarty->assign('inscripcion',$inscripcionbd);
            $smarty->assign('fechainscripcion',$acta->request['fecha']); 
            $smarty->assign('sexoinscrito',$repohechovital->request['sexoinscrito']);
            $smarty->assign('fechanacimiento',$repohechovital->request['fechanacimiento']); 
            $smarty->assign('fechadictament',$repohechovital->request['fechadictament']); 
             $tomobd = $tomos->getTomo($acta->request['idtomo']); 
            $smarty->assign('folio',$acta->request['folio']);
            $smarty->assign('tomo',$acta->request['idtomo']);   
            $smarty->assign('tomobd',$tomobd);
            $smarty->assign('partida',$acta->request['partida']);
            $smarty->assign('arrayPartFolio',$repohechovital);   
            $smarty->assign('repohechovital',$repohechovital); 
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

            $arrayPersona['padre']['nombre'] =  $repohechovital->request['padrenombre'];
            $arrayPersona['padre']['edad'] = $reponacimiento->request['edadpadre'];
            $arrayPersona['padre']['oficio'] = $reponacimiento->request['oficiopadre']; 
            $arrayPersona['padre']['domicilio'] = $reponacimiento->request['domiciliopadre'];
            $arrayPersona['padre']['nacionalidad'] = $reponacimiento->request['nacionalidadpadre'];  
            $arrayPersona['padre']['cedula'] = $reponacimiento->request['cedulapadre']; 
            //Madre
            $arrayPersona['madre']['nombre'] =  $repohechovital->request['nombremadre'];
            $arrayPersona['madre']['edad'] = $reponacimiento->request['edadmadre'];
            $arrayPersona['madre']['oficio'] = $reponacimiento->request['oficiomadre']; 
            $arrayPersona['madre']['domicilio'] = $reponacimiento->request['domiciliomadre'];
            $arrayPersona['madre']['nacionalidad'] = $reponacimiento->request['nacionalidadmadre'];  
            $arrayPersona['madre']['cedula'] = $reponacimiento->request['cedulamadre'];      
            $smarty->assign('persona',$arrayPersona);  
            $arrayNotasMarginales = $inscripcionbd->getNotasmarginales();
            $smarty->assign('notasmarginalesbd',$arrayNotasMarginales); 
            $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
            $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']);               
            $smarty->assign('etiqueta','edit');             
            $smarty->assign('url','/modulos/inscripciones/editreponacimiento.php?id='.$inscripcionbd->request['idinscripcion']);                                    
            $smarty->assign('camino','>> Inscripciones >> Reposicion Nacimiento >> Editando');  
            $smarty->display('layout.tpl');
        }
} else {
    header("Location: ./login.php");
}     
?>
