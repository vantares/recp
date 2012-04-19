<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Defunciones >> Editando');  
        $smarty->assign('template','inscripciones/defuncion.tpl');            
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
                catch (Acta $e) {
                    $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                    $error = true;
                }    
                if(!$error) {  
                    //Actualizo Hecho vital
                    $hechovital = new hechovital();
                    $_REQUEST['idhechovital'] =  $inscripcion->request['idinscripcion'];
                    $hechovital->readEnv();
                    try {
                        $hechovital->updateRecord();
                    }
                    catch (HechoVital $e) {
                        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                        $error = true;
                    }  
                    if(!$error) {
                        //Actualizo Defuncion
                        $defuncion = new defuncion();
                        $_REQUEST['iddefuncion'] = $hechovital->request['idhechovital'];
                        $defuncion->readEnv();
                        try {
                            $defuncion->updateRecord();
                        }
                        catch (Defuncion $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        } 
                                               
                    }    
                    if(!$error) {
                        //Actualizo Nacimiento
                        $actanacimiento = new acta();
                        $nacimientobd = $actanacimiento->getNacimientoByTomoFolio($_REQUEST['tomoinscripcionnacimiento'],$_REQUEST['folioinscripcionnacimiento']);
                        if($nacimientobd) {  
                            $nacimientobd->request['lugarinscripciondefuncion'] = $_REQUEST['lugarinscripciondefuncion'];
                            $nacimientobd->request['folioinscripciondefuncion'] = $_REQUEST['folio'];
                            $nacimientobd->request['tomoinscripciondefuncion'] = $_REQUEST['idtomo']; 
                            $nacimientobd->request['partidainscripciondefuncion'] = $_REQUEST['partida'];
                            $arrayaux = explode('-',$_REQUEST['fechadefuncion']);
                            $nacimientobd->request['anyoinscripciondefuncion'] = $arrayaux[0]; 
                            try {
                                $nacimientobd->updateRecord();
                            }
                            catch (Nacimiento $e) {
                                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                                $error = true;
                            }
                            //Elimino el asiento que tiene que ver con la inscripcion 
                            //$asientonacimiento = new asientoregistral();
                            //$asientonacimiento->deleteRecord($nacimientobd->request['idnacimiento']);
                        }                         
                    } 
                }
            }
            $smarty->assign('notice',(!$error) ? 'La inscripcion fue actualizada correctamente desea volver a editar pinche <a href="/modulos/inscripciones/editdefuncion.php?id='.$inscripcion->request['idinscripcion'].'"><b>aqui</b></a>' : '<b>error:<b> La Inscripcion no se pudo crear');
            $smarty->assign('class',(!$error) ? 'notice' : 'errornotice');                                                                   
            if(!$error) {
                //Registro el evento
                $evento = new evento();
                $evento->request['tipoevento'] = 'Actualizar Partida de Defuncion';
                $evento->request['nombreusuario'] = $usuario->request['nombre']; 
                $evento->request['clave'] = $usuario->request['clave'];  
                $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                $evento->request['descripcion'] = 'Se actualizo una partida de defuncion con tomo'.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio']; 
                $evento->request['fechaocurrencia'] = date('Y-m-d');
                $evento->addRecord();
            } 
            $smarty->display('layout.tpl'); 
            die;                            
        }    
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
        $smarty->assign('disabled',((isset($_REQUEST['detalle'])) && ($_REQUEST['detalle'] == 1)) ? 'disabled=disabled' : '');
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