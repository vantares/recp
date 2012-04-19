<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Reposicion Matrimonios >> Editando');  
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
                     //Actualizo Acto juridico
                    $actojuridico = new actojuridico();
                    $_REQUEST['idactojuridico'] = $inscripcion->request['idinscripcion'];
                    $actojuridico->readEnv();
                    try {
                        $actojuridico->updateRecord();
                    }
                    catch (ActoJuridico $e) {
                        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                        $error = true;
                    }
                    if(!$error) {
                        //Actualizo Matrimonio
                        $repomatrimonio = new reposicionmatrimonio();
                        $_REQUEST['idreposicionmatrimonio'] = $actojuridico->request['idactojuridico'];
                        //Obtener nombre Inscrito2
                        $_REQUEST['conyuge2nombre'] = $_REQUEST['inscrito2nombre1'].' '.$_REQUEST['inscrito2nombre2'].' '.$_REQUEST['inscrito2apellido1'].' '.$_REQUEST['inscrito2apellido2']; 
                        $_REQUEST['conyuge1nombre'] = $_REQUEST['inscrito1nombre1'].' '.$_REQUEST['inscrito1nombre2'].' '.$_REQUEST['inscrito1apellido1'].' '.$_REQUEST['inscrito1apellido2']; 
                        $repomatrimonio->readEnv();
                        try {
                            $repomatrimonio->updateRecord();
                        }
                        catch (RepoMatrimonio $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        }                     
                    }               
                }                  
            } 
            $smarty->assign('notice',(!$error) ? 'La inscripcion fue actualizada correctamente desea volver a editar pinche <a href="/modulos/inscripciones/editrepomatrimonio.php?id='.$inscripcion->request['idinscripcion'].'"><b>aqui</b></a>' : '<b>error:<b> La Inscripcion no se pudo crear');
            $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
            if(!$error) {
                //Registro el evento
                $evento = new evento();
                $evento->request['tipoevento'] = 'Actualizar Reposicion de Matrimonio';
                $evento->request['nombreusuario'] = $usuario->request['nombre']; 
                $evento->request['clave'] = $usuario->request['clave'];  
                $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                $evento->request['descripcion'] = 'Se actualizo una reposicion de matrimonio con tomo '.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio'].' Se hizo el asiento correspondiente'; 
                $evento->request['fechaocurrencia'] = date('Y-m-d');
                $evento->addRecord();
            }               
        
        }  
        $libroregistral = new libroregistral();
        $libroregistralbd = $libroregistral->getLibroByRubro('Reposicion Matrimonio');
        $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
        $tomos = new tomo();           
        $_REQUEST['idinscripcion'] = $_REQUEST['id'];  
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
        $acta = $inscripcionbd->getActa();        
        $actojuridico = $inscripcionbd->getActojuridico();
        $matrimonio = $actojuridico->getReposicionmatrimonio();
        $repomatrimonio = $actojuridico->getReposicionmatrimonio();
        $perfil = new Perfil();
        $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
        $smarty->assign('Perfil',$perfilbd);
        $smarty->assign('disabled',((isset($_REQUEST['detalle'])) && ($_REQUEST['detalle'] == 1)) ? 'disabled=disabled' : '');        
        $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
        $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
        $tomobd = $tomos->getTomo($acta->request['idtomo']); 
                
        $smarty->assign('folio',$acta->request['folio']);
        $smarty->assign('tomo',$acta->request['idtomo']);   
        $smarty->assign('partida',$acta->request['partida']);
        $smarty->assign('arrayPartFolio',$arrayPartFolio);    
        $smarty->assign('arrayTomos',$arrayTomos);
        $smarty->assign('tomobd',$tomobd);
        $smarty->assign('actojuridico',$actojuridico); 
        $smarty->assign('repomatrimonio',$repomatrimonio); 
        $smarty->assign('fechainscripcion',$acta->request['fecha']);
        $smarty->assign('fechadictament',$actojuridico->request['fechadictament']);  
        $smarty->assign('inscripcion',$inscripcionbd); 
        //Compareciente1
        $arrayPersona['comparecientes1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
        $arrayPersona['comparecientes1']['edad'] = $inscripcionbd->request['compareciente1edad'];
        $arrayPersona['comparecientes1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
        $arrayPersona['comparecientes1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
        $arrayPersona['comparecientes1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
        //Conyuge1
        $arrayPersona['conyuge1']['nombre1'] =  $inscripcionbd->request['inscrito1nombre1'];
        $arrayPersona['conyuge1']['nombre2'] =  $inscripcionbd->request['inscrito1nombre2'];
        $arrayPersona['conyuge1']['apellido1'] =  $inscripcionbd->request['inscrito1apellido1']; 
        $arrayPersona['conyuge1']['apellido2'] =  $inscripcionbd->request['inscrito1apellido2'];  
        $arrayPersona['conyuge1']['edad'] = $matrimonio->request['conyuge1edad'];
        $arrayPersona['conyuge1']['oficio'] = $matrimonio->request['conyuge1oficio']; 
        $arrayPersona['conyuge1']['domicilio'] = $matrimonio->request['conyuge1domicilio'];
        $arrayPersona['conyuge1']['nacionalidad'] = $matrimonio->request['conyuge1nacionalidad'];
        $arrayPersona['conyuge1']['cedula'] = $matrimonio->request['conyuge1cedula'];   
        $arrayPersona['conyuge1']['estadocivil'] = $matrimonio->request['conyuge1estadocivilanterior']; 
        //Conyuge2
        $arrayPersona['conyuge2']['nombre1'] =  $matrimonio->request['inscrito2nombre1'];
        $arrayPersona['conyuge2']['nombre2'] =  $matrimonio->request['inscrito2nombre2'];
        $arrayPersona['conyuge2']['apellido1'] =  $matrimonio->request['inscrito2apellido1']; 
        $arrayPersona['conyuge2']['apellido2'] =  $matrimonio->request['inscrito2apellido2'];              
        $arrayPersona['conyuge2']['edad'] = $matrimonio->request['conyuge2edad'];
        $arrayPersona['conyuge2']['oficio'] = $matrimonio->request['conyuge2oficio']; 
        $arrayPersona['conyuge2']['domicilio'] = $matrimonio->request['conyuge2domicilio'];
        $arrayPersona['conyuge2']['nacionalidad'] = $matrimonio->request['conyuge2nacionalidad'];
        $arrayPersona['conyuge2']['cedula'] = $matrimonio->request['conyuge2cedula'];   
        $arrayPersona['conyuge2']['estadocivil'] = $matrimonio->request['conyuge2estadocivilanterior'];   
        //Testigo1
        $arrayPersona['testigo1']['nombre'] =  $matrimonio->request['testigo1nombre'];
        $arrayPersona['testigo1']['edad'] = $matrimonio->request['testigo1edad'];
        $arrayPersona['testigo1']['oficio'] = $matrimonio->request['testigo1oficio']; 
        $arrayPersona['testigo1']['domicilio'] = $matrimonio->request['testigo1domicilio'];
        $arrayPersona['testigo1']['nacionalidad'] = $matrimonio->request['testigo1nacionalidad'];
        $arrayPersona['testigo1']['cedula'] = $matrimonio->request['testigo1cedula'];   
        $arrayPersona['testigo1']['estadocivil'] = $matrimonio->request['testigo1estadocivil'];   
        //Testigo2
        $arrayPersona['testigo2']['nombre'] =  $matrimonio->request['testigo2nombre'];
        $arrayPersona['testigo2']['edad'] = $matrimonio->request['testigo2edad'];
        $arrayPersona['testigo2']['oficio'] = $matrimonio->request['testigo2oficio']; 
        $arrayPersona['testigo2']['domicilio'] = $matrimonio->request['testigo2domicilio'];
        $arrayPersona['testigo2']['nacionalidad'] = $matrimonio->request['testigo2nacionalidad'];
        $arrayPersona['testigo2']['cedula'] = $matrimonio->request['testigo2cedula'];   
        $arrayPersona['testigo2']['estadocivil'] = $matrimonio->request['testigo2estadocivil']; 
        $smarty->assign('persona',$arrayPersona); 
        //Nacimiento conyuge1
        $nacimientoconyuge1 = $matrimonio->getNacimientoConyuge('conyuge1');
        if($nacimientoconyuge1) {
            $actaConyuge1 = $nacimientoconyuge1->getActa();
            $hechovitalConyuge1 = $nacimientoconyuge1->getHechoVital();
            $fecha = explode('-',$hechovitalConyuge1->request['fechanacimiento']);
            $anyo1 = $fecha[0];
        } else {
            $actaConyuge1 = new acta();
            $actaConyuge1->request['idtomo'] = $matrimonio->request['conyuge1tomoinscripcion'];
            $actaConyuge1->request['folio'] = $matrimonio->request['conyuge1folioinscripcion'];
            $actaConyuge1->request['partida'] = $matrimonio->request['conyuge1partidainscripcion'];
            $anyo1 = $matrimonio->request['conyuge1anyoinscripcion'];
            $nacimientoconyuge1 = new inscripcion();
            $nacimientoconyuge1->request['municipioinscripcion'] =  $matrimonio->request['conyuge1lugarinscripcion']; 
        }    
        $arraynacimiento['conyuge1']['actabd'] = $actaConyuge1;
        $arraynacimiento['conyuge1']['hechovital'] = $hechovitalConyuge1;
        $arraynacimiento['conyuge1']['anyo'] = $anyo1; 
        $arraynacimiento['conyuge1']['numero'] = $matrimonio->request['conyuge1tomoinscripcion'];
        $arraynacimiento['conyuge1']['inscripcion'] = $nacimientoconyuge1; 
        //Nacimiento conyuge2
        $nacimientoconyuge2 = $matrimonio->getNacimientoConyuge('conyuge2');
        if($nacimientoconyuge2) {
            $actaConyuge2 = $nacimientoconyuge2->getActa();
            $hechovitalConyuge2 = $nacimientoconyuge2->getHechoVital();
            $fecha = explode('-',$hechovitalConyuge2->request['fechanacimiento']);
            $anyo2 = $fecha[0];
        } else {
            $actaConyuge2 = new acta();
            $actaConyuge2->request['idtomo'] = $matrimonio->request['conyuge2tomoinscripcion'];
            $actaConyuge2->request['folio'] = $matrimonio->request['conyuge2folioinscripcion'];
            $actaConyuge2->request['partida'] = $matrimonio->request['conyuge2partidainscripcion'];
            $anyo2 = $matrimonio->request['conyuge1anyoinscripcion'];
            $nacimientoconyuge2 = new inscripcion();
            $nacimientoconyuge2->request['municipioinscripcion'] =  $matrimonio->request['conyuge2lugarinscripcion']; 
        }         
        $arraynacimiento['conyuge2']['actabd'] = $actaConyuge2;
        $arraynacimiento['conyuge2']['hechovital'] = $hechovitalConyuge2;
        $arraynacimiento['conyuge2']['anyo'] = $anyo2; 
        $arraynacimiento['conyuge2']['numero'] = $matrimonio->request['conyuge2tomoinscripcion']; 
        $arraynacimiento['conyuge2']['inscripcion'] = $nacimientoconyuge2; 
        //Hijos Reconocidos
        $reconocidos = new reconocimiento();
        $reconocidosbd = $reconocidos->getReconocidosByInscripcion($inscripcionbd->request['idinscripcion']); 
        $smarty->assign('titular','Reposiciones de matrimonio');            
        $smarty->assign('arraynacimiento',$arraynacimiento);
        $smarty->assign('reconocidosbd',$reconocidosbd);
        $smarty->assign('idinscripcionmatrimonio',$inscripcionbd->request['idinscripcion']); 
        $smarty->assign('visiblenacimiento','true');  
        $smarty->assign('visiblehijo',($reconocidosbd) ? 'true' : '');
        $smarty->assign('url','/modulos/inscripciones/editrepomatrimonio.php/'.$inscripcionbd->request['idinscripcion']);
        $smarty->assign('urladd','/modulos/inscripciones/addrepomatrimonio.php');
        $smarty->assign('urllistado','/modulos/inscripciones/listarrepomatrimonios.php');
        $arrayNotasMarginales = $inscripcionbd->getNotasmarginales(); 
        $smarty->assign('notasmarginalesbd',$arrayNotasMarginales); 
        $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
        $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']);         
        $smarty->assign('etiqueta','edit');
        $smarty->assign('tipo','Reposicion Matrimonio'); 
        $smarty->assign('template','inscripciones/repomatrimonio.tpl'); 
        $smarty->display('layout.tpl');       
    }    
} else {
    header("Location: ./login.php");
}   
?>
