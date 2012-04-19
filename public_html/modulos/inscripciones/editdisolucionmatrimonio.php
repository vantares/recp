<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Disolucion de Matrimonio >> Editando');  
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
                        //Actualizo Disolucion Matrimonio
                        $disolucionmatrimonio = new disolucionmatrimonio();
                        $_REQUEST['iddisolucionmatrimonio'] = $actojuridico->request['idactojuridico'];
                        //Obtener nombre Inscrito2
                        $_REQUEST['conyuge2nombre'] = $_REQUEST['inscrito2nombre1'].' '.$_REQUEST['inscrito2nombre2'].' '.$_REQUEST['inscrito2apellido1'].' '.$_REQUEST['inscrito2apellido2']; 
                        $_REQUEST['conyuge1nombre'] = $_REQUEST['inscrito1nombre1'].' '.$_REQUEST['inscrito1nombre2'].' '.$_REQUEST['inscrito1apellido1'].' '.$_REQUEST['inscrito1apellido2']; 
                        $_REQUEST['tomomatrimonio'] = $_REQUEST['tomom'];
                        $_REQUEST['foliomatrimonio'] = $_REQUEST['foliom'];
                        $_REQUEST['partidamatrimonio'] = $_REQUEST['partidam'];                        
                        $disolucionmatrimonio->readEnv();
                        try { 
                            $disolucionmatrimonio->updateRecord();
                        }
                        catch (Exception $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        } 
                        
                                           
                    }               
                }                  
            } 
            $disolucion = $disolucionmatrimonio->getDisolucionmatrimonio($actojuridico->getlastId());
            $idmatrimonio = $disolucion->getIdMatrimonio();
            $textomatrimonio = (($idmatrimonio != '')&&($idmatrimonio > 0)) ? 'Para asentar la modificacion en el matrimonio correspondiente de click <a href="/modulos/inscripciones/editmatrimonio?id='.$idmatrimonio.'"><b>aqui</b></a>' :  '';
            $smarty->assign('notice',(!$error) ? 'La inscripcion fue actualizada correctamente desea volver a editar de click <a href="/modulos/inscripciones/editdisolucionmatrimonio?id='.$inscripcion->request['idinscripcion'].'"><b>aqui</b></a><br>' . $textomatrimonio : '<b>error:<b> La Inscripcion no se pudo crear' );
            $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
            if(!$error) {
                //Registro el evento
                $evento = new evento();
                $evento->request['tipoevento'] = 'Actualozar Partida de Matrimonio';
                $evento->request['nombreusuario'] = $usuario->request['nombre']; 
                $evento->request['clave'] = $usuario->request['clave'];  
                $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                $evento->request['descripcion'] = 'Se actualizo una partida de matrimonio con tomo '.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio'].' Se hizo el asiento correspondiente'; 
                $evento->request['fechaocurrencia'] = date('Y-m-d');
                $evento->addRecord();
            }               
        
        }  
        $libroregistral = new libroregistral();
        $libroregistralbd = $libroregistral->getLibroByRubro('Disolucion Vinculo Matrimonial');
        $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
        $tomos = new tomo();           
        $_REQUEST['idinscripcion'] = $_REQUEST['id'];  
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
        $acta = $inscripcionbd->getActa();  
        $actojuridico = $inscripcionbd->getActojuridico();
        $disolucionmatrimonio = $actojuridico->getDisolucionMatrimonio();
        $perfil = new Perfil();
        $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
        $smarty->assign('Perfil',$perfilbd);
        $smarty->assign('disabled',((isset($_REQUEST['detalle'])) && ($_REQUEST['detalle'] == 1)) ? 'disabled=disabled' : '');        
        $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
        $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
        $tomobd = $tomos->getTomo($acta->request['idtomo']); 

        $smarty->assign('tomobd',$tomobd);              
        $smarty->assign('folio',$acta->request['folio']);
        $smarty->assign('tomo',$acta->request['idtomo']);   
        $smarty->assign('partida',$acta->request['partida']);
        $smarty->assign('arrayPartFolio',$arrayPartFolio);    
        $smarty->assign('arrayTomos',$arrayTomos);
        $smarty->assign('actojuridico',$actojuridico); 
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
        $arrayPersona['conyuge1']['edad'] = $disolucionmatrimonio->request['conyuge1edad'];
        $arrayPersona['conyuge1']['oficio'] = $disolucionmatrimonio->request['conyuge1oficio']; 
        $arrayPersona['conyuge1']['domicilio'] = $disolucionmatrimonio->request['conyuge1domicilio'];
        $arrayPersona['conyuge1']['nacionalidad'] = $disolucionmatrimonio->request['conyuge1nacionalidad'];
        $arrayPersona['conyuge1']['cedula'] = $disolucionmatrimonio->request['conyuge1cedula'];   
        $arrayPersona['conyuge1']['estadocivil'] = $disolucionmatrimonio->request['conyuge1estadocivilanterior']; 
        //Conyuge2
        $arrayNombre = explode(' ',trim($disolucionmatrimonio->request['conyuge2nombre']));
        $arrayPersona['conyuge2']['nombre1'] =  $arrayNombre[0];
        $arrayPersona['conyuge2']['nombre2'] =  $arrayNombre[1];
        $arrayPersona['conyuge2']['apellido1'] =  $arrayNombre[2]; 
        $arrayPersona['conyuge2']['apellido2'] =  $arrayNombre[3];
        $arrayPersona['conyuge2']['edad'] = $disolucionmatrimonio->request['conyuge2edad'];
        $arrayPersona['conyuge2']['oficio'] = $disolucionmatrimonio->request['conyuge2oficio']; 
        $arrayPersona['conyuge2']['domicilio'] = $disolucionmatrimonio->request['conyuge2domicilio'];
        $arrayPersona['conyuge2']['nacionalidad'] = $disolucionmatrimonio->request['conyuge2nacionalidad'];
        $arrayPersona['conyuge2']['cedula'] = $disolucionmatrimonio->request['conyuge2cedula'];   
        $arrayPersona['conyuge2']['estadocivil'] = $disolucionmatrimonio->request['conyuge2estadocivilanterior'];   
        //Nacimiento conyuge1
        $actaConyuge1 = new acta();
        $actaConyuge1->request['idtomo'] = $disolucionmatrimonio->request['conyuge1tomoinscripcion'];
        $actaConyuge1->request['folio'] = $disolucionmatrimonio->request['conyuge1folioinscripcion'];
        $actaConyuge1->request['partida'] = $disolucionmatrimonio->request['conyuge1partidainscripcion'];
        $anyo1 = $disolucionmatrimonio->request['conyuge1anyoinscripcion'];
        $arraynacimiento['conyuge1']['actabd'] = $actaConyuge1;
        $arraynacimiento['conyuge1']['hechovital'] = $hechovitalConyuge1;
        $arraynacimiento['conyuge1']['numero'] = $disolucionmatrimonio->request['conyuge1tomoinscripcion']; 
        $arraynacimiento['conyuge1']['anyo'] = $anyo1;   
        $arraynacimiento['conyuge1']['inscripcion'] = $nacimientoconyuge1; 
        $arraynacimiento['conyuge1']['tomo'] = $actaConyuge1->getNoTomo();
        $nacimientoconyuge1 = new inscripcion();
        $nacimientoconyuge1->request['municipioinscripcion'] =  $disolucionmatrimonio->request['conyuge1lugarinscripcion']; 
        $arraynacimiento['conyuge1']['inscripcion'] = $nacimientoconyuge1;
        //Nacimiento conyuge2
        $actaConyuge2 = new acta();
        $actaConyuge2->request['idtomo'] = $disolucionmatrimonio->request['conyuge2tomoinscripcion'];
        $actaConyuge2->request['folio'] = $disolucionmatrimonio->request['conyuge2folioinscripcion'];
        $actaConyuge2->request['partida'] = $disolucionmatrimonio->request['conyuge2partidainscripcion'];
        $anyo2 = $disolucionmatrimonio->request['conyuge2anyoinscripcion'];
        $nacimientoconyuge2 = new inscripcion();
        $nacimientoconyuge2->request['municipioinscripcion'] =  $disolucionmatrimonio->request['conyuge2lugarinscripcion']; 
        $arraynacimiento['conyuge2']['actabd'] = $actaConyuge2;
        $arraynacimiento['conyuge2']['anyo'] = $anyo2; 
         $arraynacimiento['conyuge2']['numero'] = $disolucionmatrimonio->request['conyuge2tomoinscripcion'];
        $arraynacimiento['conyuge2']['inscripcion'] = $nacimientoconyuge2; 
        $arraynacimiento['conyuge2']['tomo'] = $actaConyuge2->getNoTomo(); 
        
        //Hijos Reconocidos
        $reconocidos = new guarda();
        $idmatrimonio = $disolucionmatrimonio->request['iddisolucionmatrimonio']; 
        if($idmatrimonio){
            $reconocidosbd = $reconocidos->getGuardadosByInscripcion($idmatrimonio); 
		//print_r($reconocidosbd);
            $smarty->assign('reconocidosbd',$reconocidosbd); 
        }
               
        $arrayNotasMarginales = $inscripcionbd->getNotasmarginales(); 
        $smarty->assign('notasmarginalesbd',$arrayNotasMarginales); 
        $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
        $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']); 
        $smarty->assign('titular','Disolucion Vinculo Matrimonial');            
        $smarty->assign('arraynacimiento',$arraynacimiento);
        $smarty->assign('visiblehijo',($reconocidosbd) ? 'true' : '');  
        $smarty->assign('persona',$arrayPersona);
        $smarty->assign('idtomom',$disolucionmatrimonio->request['tomomatrimonio']); 
        $smarty->assign('foliom',$disolucionmatrimonio->request['foliomatrimonio']);
        $smarty->assign('partidam',$disolucionmatrimonio->request['partidamatrimonio']);
        $smarty->assign('disolucionmatrimonio',$disolucionmatrimonio);
        $smarty->assign('iddisolucionmatrimonio',$inscripcionbd->request['idinscripcion']); 
        $smarty->assign('visiblenacimiento','true');  
        $smarty->assign('url','/modulos/inscripciones/editdisolucionmatrimonio.php/'.$inscripcionbd->request['idinscripcion']);
        $smarty->assign('urladd','/modulos/inscripciones/adddisolucionmatrimonio.php');
        $smarty->assign('urllistado','/modulos/inscripciones/listardisomatrimonios.php');
        $smarty->assign('etiqueta','edit');
        $smarty->assign('tipo','Disolucion Vinculo Matrimonial');
        $smarty->assign('template','inscripciones/disolucionmatrimonio.tpl'); 
        $smarty->display('layout.tpl');       
    }    
} else {
    header("Location: ./login.php");
}   
?>
