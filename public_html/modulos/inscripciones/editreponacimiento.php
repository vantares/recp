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
                        //Actualizo Nacimiento
                        $reponacimiento = new reposicionnacimiento();
                        $_REQUEST['idreposicionnacimiento'] = $repohechovital->request['idreposicionhechovital'];
                        $reponacimiento->readEnv();
                        try {
                            $reponacimiento->updateRecord();
                        }
                        catch (Nacimiento $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        }                      
                    }
                }
                $smarty->assign('notice',(!$error) ? 'La inscripcion fue actualizada correctamente desea volver a editar pinche <a href="/modulos/inscripciones/editreponacimiento.php?id='.$inscripcion->request['idinscripcion'].'"><b>aqui</b></a>' : '<b>error:<b> La Inscripcion no se pudo crear');
                $smarty->assign('class',(!$error) ? 'notice' : 'errornotice');  
                if(!$error) {
                    //Registro el evento
                    $evento = new evento();
                    $evento->request['tipoevento'] = 'Actualizar Reposicion de Nacimiento';
                    $evento->request['nombreusuario'] = $usuario->request['nombre']; 
                    $evento->request['clave'] = $usuario->request['clave'];  
                    $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                    $evento->request['descripcion'] = 'Se actualizo una reposicion de nacimiento con tomo'.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio']; 
                    $evento->request['fechaocurrencia'] = date('Y-m-d');
                    $evento->addRecord();
                }
                $smarty->display('layout.tpl');
                die;                                                                                  
            }    
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
            $smarty->assign('disabled',((isset($_REQUEST['detalle'])) && ($_REQUEST['detalle'] == 1)) ? 'disabled=disabled' : '');
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
