<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    $libroregistral = new libroregistral();
    $libroregistralbd = $libroregistral->getLibroByRubro('Inscripciones Varias');
    $smarty->assign('template','inscripciones/inscripcionvaria.tpl');  
    if($libroregistralbd) {
        $arrayTomos = $libroregistralbd->getTomosAbiertos();
        if(!$arrayTomos) {
            $smarty->assign('notice', '<b>error:<b> No existe tomos abiertos asegurese de que existe el libro registral y que tiene algun tomo abierto');
            $smarty->assign('class','errornotice'); 
            $smarty->display('layout.tpl'); 
            die;
        } 
    } else {
        $smarty->assign('notice', '<b>error:<b> No existe definido el libro registral para este tipo de inscripcion');
        $smarty->assign('class','errornotice'); 
        $smarty->display('layout.tpl'); 
        die;    
    }      
    $tomos = new tomo();
    $esprimero = true;
    $perfil = new Perfil();
    $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
    if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) {
        $error = false; 
        //Asiento la inscripcion
        $asiento = new asientoregistral();
        $_REQUEST['fecha'] = date('Y-m-d');
        $asiento->readEnv();
        try {
            $asiento->addRecord();
        }
        catch (Exception $e) {
            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            $error = true;
        } 
        if(!$error) { 
            //Actualizo Incripcion
            $inscripcion = new inscripcion();
            $_REQUEST['idinscripcion'] =  $asiento->getlastId();
            $_REQUEST['tipoinscripcion'] =  'Inscripciones Varias';
            $_REQUEST['numeroserie'] =  $inscripcion->getLastNoserie() + 1;
            $_REQUEST['ciudadinscripcion'] = $perfilbd->getParametro('Ciudad');
            $_REQUEST['municipioinscripcion'] = $perfilbd->getParametro('Municipio');
            $_REQUEST['departamentoinscripcion'] = $perfilbd->getParametro('Departamento');
            $_REQUEST['paisinscripcion'] = $perfilbd->getParametro('Pais');
            $inscripcion->readEnv();
            try {
                $inscripcion->addRecord();
            }
            catch (Exception $e) {
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                $error = true;
            }
            if(!$error) { 
                //Actualizo Datos Registrales
                $acta = new acta();
                $_REQUEST['fecha'] = $_REQUEST['fechainscripcion'];
                $_REQUEST['idinscripcion'] = $inscripcion->getlastId(); 
                $acta->readEnv();
                try { 
                    $acta->addRecord();
                }
                catch (Exception $e) {
                    $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                    $error = true;
                } 
                if(!$error) {
                    //Actualizo Acto juridico
                    $actojuridico = new actojuridico();
                    $_REQUEST['idactojuridico'] = $inscripcion->getlastId();
                    $actojuridico->readEnv();
                    try {
                        $actojuridico->addRecord();
                    }
                    catch (Exception $e) {
                        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                        $error = true;
                    }
                    if(!$error) {             
                        //Actualizo Inscripcion Varia
                        $inscripcionVaria = new inscripcionVaria();
                        $_REQUEST['idinscripcionvaria'] = $actojuridico->getlastId();
						$InscripcionLast=  $_REQUEST['idinscripcionvaria'];
                        //$_REQUEST['tomoinscripcionnacimiento'] = $tomo->getIdTomoByLibroNumero('Nacimientos',$_REQUEST['tomoinscripcionnacimiento']);
                        $_REQUEST['titulo'] = $_REQUEST['titulo'];
                        $inscripcionVaria->readEnv();
                        try {
                            $inscripcionVaria->addRecord();
                        }
                        catch (Exception $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        } 
						// TODO: fata incluir las relaciones de participacion del compareciente e inscrito
                    }                       
                }    
            }         
        }
		/*
        $tomo = new tomo();  
        $idtomo = $tomo->getIdTomoByLibroNumero('Nacimientos',$_REQUEST['tomoinscripcionnacimiento']);
        if($idtomo) {
            $actabd = $acta->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio='.$_REQUEST['folioinscripcionnacimiento'].' AND acta.partida='.$_REQUEST['partidainscripcionnacimiento']);
            $textonacimiento = 'Para asentar la modificacion en el nacimiento correspondiente de click <a href="/modulos/inscripciones/editnacimiento?id='.$actabd[0]['idinscripcion'].'"><b>aqui</b></a>';
        } else {
             $textonacimiento = 'La inscripcion a marginar no se encuentra en este registro civil';
        }
        $smarty->assign('notice',(!$error) ? 'La inscripcion fue actualizada correctamente desea volver a editar de click <a href="/modulos/inscripciones/editdisolucionmatrimonio?id='.$inscripcion->request['idinscripcion'].'"><b>aqui</b></a><br>' . $textonacimiento : '<b>error:<b> La Inscripcion no se pudo crear' );
		*/
		include_once("__marginacionesresultantes.php");
        $smarty->assign('notice',(!$error) ? 'La inscripcion fue creada correctamente'.$textmessage : '<b>error:<b> La Inscripcion no se pudo crear');
        $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
        if(!$error) {
            //Registro el evento
            $evento = new evento();
            $evento->request['tipoevento'] = 'Crear Inscripcion varia';
            $evento->request['nombreusuario'] = $usuario->request['nombre']; 
            $evento->request['clave'] = $usuario->request['clave'];  
            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
            $evento->request['descripcion'] = 'Se creo una inscripcion varia con tomo '.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio'].' Se hizo el asiento correspondiente'; 
            $evento->request['fechaocurrencia'] = date('Y-m-d');
            $evento->addRecord();
        }
    }    
    //Si vienen Variables por Post
    $smarty->assign('Municipio',$perfilbd->getParametro('Municipio')); 
    $smarty->assign('Provincia',$perfilbd->getParametro('Provincia'));
    $smarty->assign('Departamento',$perfilbd->getParametro('Departamento'));   
    $smarty->assign('Pais',$perfilbd->getParametro('Pais'));  
    $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
    $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
    $smarty->assign('urllistado','/modulos/inscripciones/listarinscripcionvaria.php');
    $smarty->assign('url','/modulos/inscripciones/addinscripcionvaria.php'); 
    $smarty->assign('fechainscripcion',date('Y-m-d H:m'));
    $smarty->assign('fechadictament',date('Y-m-d H:m'));
    $smarty->assign('encabezado','Datos del Declarado Mayor'); 
    $smarty->assign('titulo','Declaracion de la mayoria de Edad'); 
    foreach($arrayTomos as $tomo) {
        $tomobd = $tomos->getTomo($tomo['idtomo']);
        $arrayPartFolio[$tomo['idtomo']]['partida'] = $tomobd->getLastPartida() + 1;
        $arrayPartFolio[$tomo['idtomo']]['folio'] = $tomobd->getLastFolio() + 1; 
        if($esprimero) {
            $folio = $tomobd->getLastFolio() + 1;
            $partida = $tomobd->getLastPartida() + 1;
            $esprimero = false;
        }    
    }    
    $smarty->assign('folio',$folio); 
    $smarty->assign('partida',$partida);   
    $smarty->assign('add','add');
    $smarty->assign('arrayPartFolio',$arrayPartFolio);    
    $smarty->assign('arrayTomos',$arrayTomos);
    $smarty->assign('camino','>> Inscripciones >> Varias >> Nueva'); 
    $smarty->assign('titular','Inscripciones Varias');
    $smarty->display('layout.tpl'); 
} else {
    header("Location: ./login.php");
}     
?>
