<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Reposicion Defuncion >> Editando');  
        $smarty->assign('template','inscripciones/repodefuncion.tpl');            
        if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) {
             //Actualizo Inscripcion
            $inscripcion = new inscripcion();
            $inscripcion->readEnv();
            try {
                $inscripcion->updateRecord();  
            }  
            catch (Inscripcion $e) {
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                $error = true;
            } 
            if(!$error) {
                //Actualizo Datos Registrales
                $acta = $inscripcion->getActa();
                $_REQUEST['fecha'] = $_REQUEST['fechainscripcion'];  
                $_REQUEST['idacta'] = $acta->request['idacta']; 
                $acta->readEnv();
                try { 
                    $acta->updateRecord();
                }
                catch (Inscripcion $e) {
                    $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                    $error = true;
                }    
                if(!$error) {  
                    //Actualizo Hecho vital
                    $repohechovital = new reposicionhechovital();
                    $_REQUEST['idreposicionhechovital'] =  $inscripcion->request['idinscripcion'];
                    $repohechovital->readEnv();
                    try {
                        $repohechovital->updateRecord();
                    }
                    catch (RepoHechoVital $e) {
                        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                        $error = true;
                    }  
                    if(!$error) {
                        //Actualizo Defuncion
                        $repodefuncion = new reposiciondefuncion();
                        $_REQUEST['idreposiciondefuncion'] = $repohechovital->request['idreposicionhechovital'];
                        $repodefuncion->readEnv();
                        try {
                            $repodefuncion->updateRecord();
                        }
                        catch (RepoDefuncion $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        } 
                                               
                    }    
                    if(!$error) {
                        //Actualizo Nacimiento
                        $actanacimiento = new acta();
                        $reponacimientobd = $actanacimiento->getRepoNacimientoByTomoFolio($_REQUEST['tomoinscripcionnacimiento'],$_REQUEST['folioinscripcionnacimiento']);
                        if($reponacimientobd) {  
                            $reponacimientobd->request['lugarinscripciondefuncion'] = $_REQUEST['lugarinscripciondefuncion'];
                            $reponacimientobd->request['folioinscripciondefuncion'] = $_REQUEST['folio'];
                            $reponacimientobd->request['tomoinscripciondefuncion'] = $_REQUEST['idtomo']; 
                            $reponacimientobd->request['partidainscripciondefuncion'] = $_REQUEST['partida'];
                            $arrayaux = explode('-',$_REQUEST['fechadefuncion']);
                            $reponacimientobd->request['anyoinscripciondefuncion'] = $arrayaux[0]; 
                            try {
                                $reponacimientobd->updateRecord();
                            }
                            catch (RepoNacimiento $e) {
                                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                                $error = true;
                            }
                        }                         
                    } 
                }
            }
            $smarty->assign('notice',(!$error) ? 'La inscripcion fue actualizada correctamente desea volver a editar pinche <a href="/modulos/inscripciones/editrepodefuncion.php?id='.$inscripcion->request['idinscripcion'].'"><b>aqui</b></a>' : '<b>error:<b> La Inscripcion no se pudo crear');
            $smarty->assign('class',(!$error) ? 'notice' : 'errornotice');                                                                   
            if(!$error) {
                //Registro el evento
                $evento = new evento();
                $evento->request['tipoevento'] = 'Actualizar Partida de Defuncion';
                $evento->request['nombreusuario'] = $usuario->request['nombre']; 
                $evento->request['clave'] = $usuario->request['clave'];  
                $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                $evento->request['descripcion'] = 'Se actualizo una reposicion de defuncion con tomo '.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio']; 
                $evento->request['fechaocurrencia'] = date('Y-m-d');
                $evento->addRecord();
            } 
            $smarty->display('layout.tpl'); 
            die;                            
        }    
        $libroregistral = new libroregistral();
        $libroregistralbd = $libroregistral->getLibroByRubro('Reposicion Defuncion');
        $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
        $tomos = new tomo();           
        $_REQUEST['idinscripcion'] = $_REQUEST['id'];
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
        $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']); 
        $acta = $inscripcionbd->getActa();
        $repohechovital = $inscripcionbd->getRepoHechoVital();
        $repodefuncion = $repohechovital->getReposiciondefuncion($inscripcionbd->request['idinscripcion']);
        $inscripcionnacimiento = $repodefuncion->getInscripcionNacimiento();
       // $nacimiento = $inscripcionnacimiento->getRepoHechoVital()->getReposicionnacimiento();
        //$actanacimiento =  $inscripcionnacimiento->getActa();
        if($inscripcionnacimiento) {
            $nacimiento = $inscripcionnacimiento->getRepoHechoVital()->getReposicionnacimiento();
            $actanacimiento =  $inscripcionnacimiento->getActa();
        } else {
            $actanacimiento = new acta();
            $actanacimiento->request['idtomo'] = $repodefuncion->request['tomoinscripcionnacimiento'];
            $actanacimiento->request['partida'] = $repodefuncion->request['partidainscripcionnacimiento']; 
            $actanacimiento->request['folio'] = $repodefuncion->request['folioinscripcionnacimiento'];
        }          
        $perfil = new Perfil();
        $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
        $smarty->assign('Perfil',$perfilbd);
        $smarty->assign('disabled',((isset($_REQUEST['detalle'])) && ($_REQUEST['detalle'] == 1)) ? 'disabled=disabled' : '');
        $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
        $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
        $smarty->assign('inscripcion',$inscripcionbd);
        $smarty->assign('fechainscripcion',$acta->request['fecha']); 
        $smarty->assign('sexoinscrito',$repohechovital->request['sexoinscrito']);
        $smarty->assign('fechanacimiento',$repohechovital->request['fechanacimiento']); 
        $smarty->assign('fechadefuncion',$repodefuncion->request['fechadefuncion']);  
        $smarty->assign('fechadictament',$repohechovital->request['fechadictament']);
        /*if(is_array($arrayTomos)) {
            foreach($arrayTomos as $tomo) {
                $tomobd = $tomos->getTomo($tomo['idtomo']);
                $arrayPartFolio[$tomo['idtomo']]['partida'] = $tomobd->getLastPartida() + 1;
                $arrayPartFolio[$tomo['idtomo']]['folio'] = $tomobd->getLastFolio() + 1; 
            }  
        } else {*/
           $tomobd = $tomos->getTomo($acta->request['idtomo']); 
        //}                
        $smarty->assign('folio',$acta->request['folio']);
        $smarty->assign('tomo',$acta->request['idtomo']);   
        $smarty->assign('partida',$acta->request['partida']);
        $smarty->assign('arrayPartFolio',$arrayPartFolio);    
        $smarty->assign('arrayTomos',$arrayTomos);
        $smarty->assign('tomobd',$tomobd);
        //Compareciente1
        $arrayPersona['comparecientes1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
        $arrayPersona['comparecientes1']['edad'] = $inscripcionbd->request['compareciente1edad'];
        $arrayPersona['comparecientes1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
        $arrayPersona['comparecientes1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
        $arrayPersona['comparecientes1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
        //padre
        $arrayPersona['padre']['nombre'] =  $repohechovital->request['padrenombre'];
        //Madre
        $arrayPersona['madre']['nombre'] =  $repohechovital->request['nombremadre'];
        //Fallecido
        $arrayPersona['fallecido']['nombre1'] =  $inscripcionbd->request['inscrito1nombre1'];
        $arrayPersona['fallecido']['nombre2'] =  $inscripcionbd->request['inscrito1nombre2'];
        $arrayPersona['fallecido']['apellido1'] =  $inscripcionbd->request['inscrito1apellido1']; 
        $arrayPersona['fallecido']['apellido2'] =  $inscripcionbd->request['inscrito1apellido2']; 
        $arrayPersona['fallecido']['domicilio'] = $repodefuncion->request['domiciliofallecido'];
        $arrayPersona['fallecido']['nacionalidad'] = $repodefuncion->request['nacionalidadfallecido'];  
        $arrayPersona['fallecido']['cedula'] = $repodefuncion->request['cedulafallecido'];  
        $arrayPersona['fallecido']['estadocivil'] = $repodefuncion->request['estadocivil'];   
        $arrayPersona['fallecido']['oficio'] = $repodefuncion->request['oficiofallecido'];  
        $arrayPersona['fallecido']['edad'] = $repodefuncion->request['edadfallecido'];   
        $arrayPersona['fallecido']['ciudad'] = $repodefuncion->request['ciudaddefuncion'];  
        $arrayPersona['fallecido']['departamento'] = $repodefuncion->request['departamentodefuncion'];  
        $arrayPersona['fallecido']['pais'] = $repodefuncion->request['paisdefuncion'];   
        $arrayPersona['fallecido']['municipio'] = $repodefuncion->request['municipiodefuncion']; 
        //Causa de muertes
        $muertes = new causamuerteTable();
        $arrayCausaMuertes = $muertes->readData();
        $smarty->assign('arrayCausaMuertes',$arrayCausaMuertes);  
        $smarty->assign('url','/modulos/inscripciones/editrepodefuncion.php?id='.$inscripcionbd->request['idinscripcion']);
        $arraynacimiento['fallecido']['hechovital'] = $repohechovital;    
        $arraynacimiento['fallecido']['actabd'] = $actanacimiento; 
        $arraynacimiento['fallecido']['inscripcion'] = $inscripcionbd;   
        $arraynacimiento['fallecido']['numero'] = $repodefuncion->request['tomoinscripcionnacimiento'];        
        $smarty->assign('persona',$arrayPersona);  
        $smarty->assign('arraynacimiento',$arraynacimiento);
        $smarty->assign('defuncion',$repodefuncion); 
        $smarty->assign('repohechovital',$repohechovital); 
        $arrayNotasMarginales = $inscripcionbd->getNotasmarginales();
        $smarty->assign('notasmarginalesbd',$arrayNotasMarginales); 
        $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
         
        $smarty->assign('etiqueta','edit');          
        $smarty->display('layout.tpl');
    }
} else {
    header("Location: ./login.php");
}     
?>