<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Varias >> Editando');  
        if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) {
             //Actualizo Inscripcion
            $inscripcion = new inscripcion();
            $inscripcion->readEnv();
            try {
                $inscripcion->updateRecord();  
            }  
            catch (Exception $e) {
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
                catch (Exception $e) {
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
                    catch (Exception $e) {
                        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                        $error = true;
                    }
                    if(!$error) {
                        //Actualizo Inscripcion Varia
                        $inscripcionvaria = new inscripcionvaria();
                        $_REQUEST['idinscripcionvaria'] = $actojuridico->request['idactojuridico'];
                        $tomo = new tomo();
                        $_REQUEST['titulo'] = $_REQUEST['titulo'];                        
                        $inscripcionvaria->readEnv();
                        try {
                            $inscripcionvaria->updateRecord();
                        }
                        catch (Exception $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        }                     
                    }               
                }                  
            } 
            $smarty->assign('notice',(!$error) ? 'La inscripcion fue actualizada correctamente desea volver a editar de click aqui <a href="/modulos/inscripciones/editinscripcionvaria.php?id='.$inscripcion->request['idinscripcion'].'"><b>aqui</b></a>' : '<b>error:<b> La Inscripcion no se pudo crear');
            $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
            if(!$error) {
                //Registro el evento
                $evento = new evento();
                $evento->request['tipoevento'] = 'Actualizar Inacripcion Varia';
                $evento->request['nombreusuario'] = $usuario->request['nombre']; 
                $evento->request['clave'] = $usuario->request['clave'];  
                $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                $evento->request['descripcion'] = 'Se actualizo una inscripcion varia con tomo '.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio'].' Se hizo el asiento correspondiente'; 
                $evento->request['fechaocurrencia'] = date('Y-m-d');
                $evento->addRecord();
            }               
        
        }  
        $libroregistral = new libroregistral();
        $libroregistralbd = $libroregistral->getLibroByRubro('Inscripciones Varias');
        $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
        $tomos = new tomo();           
        $_REQUEST['idinscripcion'] = $_REQUEST['id'];  
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
        $acta = $inscripcionbd->getActa();        
        $actojuridico = $inscripcionbd->getActojuridico();
        $inscripcionvaria = $actojuridico->getInscripcionVaria();
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
        $smarty->assign('fechainscripcion',$acta->request['fecha']);
        $smarty->assign('fechadictament',$actojuridico->request['fechadictament']);  
        $smarty->assign('inscripcion',$inscripcionbd); 
        $smarty->assign('inscripcionvaria',$inscripcionvaria); 
        $smarty->assign('notamarginal',$notamarginal); 
        //Compareciente1
        $arrayPersona['comparecientes1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
        $arrayPersona['comparecientes1']['edad'] = $inscripcionbd->request['compareciente1edad'];
        $arrayPersona['comparecientes1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
        $arrayPersona['comparecientes1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
        $arrayPersona['comparecientes1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
        $smarty->assign('persona',$arrayPersona); 
        $nacimiento = $inscripcionvaria->getInscripcionNacimiento();  
        if($nacimiento) {
            $actanacbd = $nacimiento->getActa();
            $arraynacimiento['inscrito']['tomo'] = $actanacbd->getNoTomo(); 
        } else {
            $actanacbd = new Acta();
            $actanacbd->request['idtomo'] = $inscripcionvaria->request['tomoinscripcionnacimiento'];
            $actanacbd->request['folio']  = $inscripcionvaria->request['folioinscripcionnacimiento'];
            $actanacbd->request['partida']  = $inscripcionvaria->request['partidainscripcionnacimiento'];
            $arraynacimiento['inscrito']['tomo'] = $inscripcionvaria->request['tomoinscripcionnacimiento'];
            $nacimiento = new inscripcion();
            $nacimiento = $inscripcionvaria;  
        }
        $inscripcionnacimiento = $actanacbd->getInscripcionByTomoFolio($inscripcionvaria->request['tomoinscripcionnacimiento'],$inscripcionvaria->request['folioinscripcionnacimiento']);         
	if(!empty($inscripcionnacimiento)){
        	$arraynacimiento['inscrito']['inscripcion'] = $inscripcionnacimiento; 
	}
	else{
        	$arraynacimiento['inscrito']['inscripcion'] = $inscripcion; 
	}
        $arraynacimiento['inscrito']['actabd'] = $actanacbd; 
        $hechovital = new hechovital();
        $hechovital->request['ciudadnacimiento'] = $inscripcionvaria->request['lugarinscripcionnacimiento'];
        $arraynacimiento['inscrito']['hechovital'] =  $hechovital;
        $arraynacimiento['inscrito']['anyo'] = $inscripcionvaria->request['anyoinscripcionnacimiento'];
        $arraynacimiento['inscrito']['anyo'] = $inscripcionvaria->request['anyoinscripcionnacimiento'];
        //Notas Marginales Asociadas
        $arrayNotasMarginales = $inscripcionbd->getNotasmarginales();
        //$reconocidosbd = $reconocidos->getReconocidosByInscripcion($inscripcionbd->request['idinscripcion']); 
        $smarty->assign('titular','Inscripci&oacute;n Varia');            
        $smarty->assign('arraynacimiento',$arraynacimiento);
        switch ($inscripcionvaria->request['tipootrainscripcion']) {
          case 'reconocimiento':
             $encabezado = 'Datos del Reconocido';
             $titulo = 'Reconocimiento de Filiacion';
          break; 
          case 'declarar mayor de edad':
             $encabezado = 'Datos del Declarado Mayor';
             $titulo = 'Declaracion de la mayoria de Edad';
          break; 
          case 'emancipar a un menor':
             $encabezado = 'Datos del Emancipado';
             $titulo = 'Emancipacion';
          break;    
          case 'otorgar la guarda':
             $encabezado = 'Datos de la Persona Sujeta a la Guarda';
             $titulo = 'De la Guarda'; 
          break;  
          case 'declarar ausente':
             $encabezado = 'Datos del Ausente';
             $titulo = 'Declaracion de Ausencia';   
          break; 
          case 'interdiccion civil':
             $encabezado = 'Datos de la Persona a la que se le suspenden sus derechos';
             $titulo = 'Interdiccion Civil'; 
          break;                      
        }          
        $smarty->assign('encabezado',$encabezado); 
        $smarty->assign('titulo',$titulo);         
        $smarty->assign('notasmarginalesbd',$arrayNotasMarginales);
        $smarty->assign('idinscripcionvaria',$inscripcionbd->request['idinscripcion']); 
        $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']);
        //$smarty->assign('visiblenacimiento','true');  
        $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
        $smarty->assign('url','/modulos/inscripciones/editinscripcionvaria.php/'.$inscripcionbd->request['idinscripcion']);
        $smarty->assign('urladd','/modulos/inscripciones/addinscripcionvaria.php');
        $smarty->assign('urllistado','/modulos/inscripciones/listarinscripcionvaria.php');
        $smarty->assign('etiqueta','edit');
        $smarty->assign('tipo','Inscripciones Varias');
        $smarty->assign('template','inscripciones/inscripcionvaria.tpl'); 
        $smarty->display('layout.tpl');       
    }    
} else {
    header("Location: ./login.php");
}   
?>
