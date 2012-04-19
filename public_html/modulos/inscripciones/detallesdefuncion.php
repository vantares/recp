<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Defunciones >> Editando');  
        $smarty->assign('template','inscripciones/defuncion.tpl');            
        $libroregistral = new libroregistral();
        $libroregistralbd = $libroregistral->getLibroByRubro('Defunciones');
        $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
        $tomos = new tomo();           
        $_REQUEST['idinscripcion'] = $_REQUEST['id'];
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
        $acta = $inscripcionbd->getActa();
        $hechovital = $inscripcionbd->getHechoVital();
        $defuncion = $hechovital->getDefuncion();
        $inscripcionnacimiento = $defuncion->getInscripcionNacimiento();
        if($inscripcionnacimiento) {
            $nacimiento = $inscripcionnacimiento->getHechoVital()->getNacimiento();
            $actanacimiento =  $inscripcionnacimiento->getActa();
        } else {
            $actanacimiento = new acta();
            $actanacimiento->request['idtomo'] = $defuncion->request['tomoinscripcionnacimiento'];
            $actanacimiento->request['partida'] = $defuncion->request['partidainscripcionnacimiento']; 
            $actanacimiento->request['folio'] = $defuncion->request['folioinscripcionnacimiento'];
        }    
        $perfil = new Perfil();
        $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
        $smarty->assign('Perfil',$perfilbd);
        $smarty->assign('disabled','disabled=disabled');
        $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
        $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
        $smarty->assign('inscripcion',$inscripcionbd);
        $smarty->assign('fechainscripcion',$acta->request['fecha']); 
        $smarty->assign('sexoinscrito',$hechovital->request['sexoinscrito']);
        $smarty->assign('fechanacimiento',$hechovital->request['fechanacimiento']); 
        $smarty->assign('fechadefuncion',$defuncion->request['fechadefuncion']); 
        $tomobd = $tomos->getTomo($acta->request['idtomo']); 
        $smarty->assign('folio',$acta->request['folio']);
        $smarty->assign('tomo',$acta->request['idtomo']);   
        $smarty->assign('partida',$acta->request['partida']);
        $smarty->assign('tomobd',$tomobd);
        $smarty->assign('arrayPartFolio',$arrayPartFolio);    
        $smarty->assign('arrayTomos',$arrayTomos);
        //Compareciente1
        $arrayPersona['comparecientes1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
        $arrayPersona['comparecientes1']['edad'] = $inscripcionbd->request['compareciente1edad'];
        $arrayPersona['comparecientes1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
        $arrayPersona['comparecientes1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
        $arrayPersona['comparecientes1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
        //padre
        $arrayPersona['padre']['nombre'] =  $hechovital->request['padrenombre'];
        //Madre
        $arrayPersona['madre']['nombre'] =  $hechovital->request['nombremadre'];
        //Fallecido
        $arrayPersona['fallecido']['nombre1'] =  $inscripcionbd->request['inscrito1nombre1'];
        $arrayPersona['fallecido']['nombre2'] =  $inscripcionbd->request['inscrito1nombre2'];
        $arrayPersona['fallecido']['apellido1'] =  $inscripcionbd->request['inscrito1apellido1']; 
        $arrayPersona['fallecido']['apellido2'] =  $inscripcionbd->request['inscrito1apellido2']; 
        $arrayPersona['fallecido']['domicilio'] = $defuncion->request['domiciliofallecido'];
        $arrayPersona['fallecido']['nacionalidad'] = $defuncion->request['nacionalidadfallecido'];  
        $arrayPersona['fallecido']['cedula'] = $defuncion->request['cedulafallecido'];  
        $arrayPersona['fallecido']['estadocivil'] = $defuncion->request['estadocivil'];   
        $arrayPersona['fallecido']['oficio'] = $defuncion->request['oficiofallecido'];  
        $arrayPersona['fallecido']['edad'] = $defuncion->request['edadfallecido'];   
        $arrayPersona['fallecido']['ciudad'] = $defuncion->request['ciudaddefuncion'];  
        $arrayPersona['fallecido']['departamento'] = $defuncion->request['departamentodefuncion'];  
        $arrayPersona['fallecido']['pais'] = $defuncion->request['paisdefuncion'];   
        $arrayPersona['fallecido']['municipio'] = $defuncion->request['municipiodefuncion']; 
        //Causa de muertes
        $muertes = new causamuerteTable();
        $arrayCausaMuertes = $muertes->readData();
        $smarty->assign('arrayCausaMuertes',$arrayCausaMuertes);  
        $smarty->assign('url','/modulos/inscripciones/editdefuncion.php?id='.$inscripcionbd->request['idinscripcion']);
        $arraynacimiento['fallecido']['hechovital'] = $hechovital;    
        $arraynacimiento['fallecido']['actabd'] = $actanacimiento; 
        $arraynacimiento['fallecido']['numero'] = $defuncion->request['tomoinscripcionnacimiento'];   
        $arraynacimiento['fallecido']['inscripcion'] = $inscripcionbd;          
        $smarty->assign('persona',$arrayPersona);  
        $smarty->assign('arraynacimiento',$arraynacimiento);
        //$smarty->assign('hechovital',$hechovital); 
        //$smarty->assign('actabd',$actanacimiento); 
        $smarty->assign('defuncion',$defuncion);
        $smarty->assign('defuncionb','ok');
        $smarty->display('layout.tpl');
    }
} else {
    header("Location: ./login.php");
}     
?>