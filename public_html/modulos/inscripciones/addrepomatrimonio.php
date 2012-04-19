<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    $libroregistral = new libroregistral();
    $libroregistralbd = $libroregistral->getLibroByRubro('Reposicion Matrimonio');
    $smarty->assign('template','inscripciones/repomatrimonio.tpl');
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
    $a = new inscripcion();
    if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) {
        $error = false; 
        //Asiento la inscripcion
        $asiento = new asientoregistral();
        $_REQUEST['fecha'] = date('Y-m-d');
        $asiento->readEnv();
        try {
            $asiento->addRecord();
        }
        catch (Asiento $e) {
            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            $error = true;
        } 
        if(!$error) { 
            //Actualizo Incripcion
            $inscripcion = new inscripcion();
            $_REQUEST['idinscripcion'] =  $asiento->getlastId();
            $_REQUEST['tipoinscripcion'] =  'Reposicion Matrimonio';
            $_REQUEST['numeroserie'] =  $inscripcion->getLastNoserie() + 1;
            $_REQUEST['ciudadinscripcion'] = $perfilbd->getParametro('Ciudad');
            $_REQUEST['municipioinscripcion'] = $perfilbd->getParametro('Municipio');
            $_REQUEST['departamentoinscripcion'] = $perfilbd->getParametro('Departamento');
            $_REQUEST['paisinscripcion'] = $perfilbd->getParametro('Pais');
            $inscripcion->readEnv();
            try {
                $inscripcion->addRecord();
            }
            catch (Inscripcion $e) {
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                $error = true;
            }
            if(!$error) { 
                $InscripcionLast = $inscripcion->getlastId();
                $arrayPersonas = array('compareciente1','testigo1','testigo2','conyuge1','conyuge2');
                foreach($arrayPersonas as $valor) {
                    $persona = new persona();
                    $Id = ($_REQUEST[$valor.'cedula'] != '')  ? $persona->getIdByCedula($_REQUEST[$valor.'cedula']) : $persona->getIdByName($_REQUEST[$valor.'nombre']);
                    if($Id) {
                        $participacion = new participacionTable();
                        $_REQUEST['idinscripcion'] = $InscripcionLast;
                        $_REQUEST['idpersona'] = $Id; 
                        switch($valor) {
                            case 'compareciente1cedula':
                               $forma = 'Compareciente';
                            break; 
                            case 'testigo1cedula':
                            case 'testigo2cedula':
                               $forma = 'Testigos';
                            break;                             
                            case 'conyuge1':
                            case 'conyuge2':
                               $forma = 'Conyuges';
                            break; 
                        }
                        $exist =  $participacion->readRecord($_REQUEST['idpersona'],$_REQUEST['idinscripcion']);
                        if(!$exist) {
                           $_REQUEST['formaparticipacion'] = $forma;
                           $participacion->readEnv();
                           $participacion->addRecord();    
                        } else {
                           $_REQUEST['formaparticipacion'] = $exist['formaparticipacion'].' '.$forma;
                           $participacion->readEnv();
                           $participacion->updateRecord();                       
                        }                    
                    }
                }
                //Actualizo Datos Registrales
                $acta = new acta();
                $_REQUEST['fecha'] = $_REQUEST['fechainscripcion'];
                $_REQUEST['idinscripcion'] = $InscripcionLast; 
                $acta->readEnv();
                try { 
                    $acta->addRecord();
                }
                catch (Inscripcion $e) {
                    $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                    $error = true;
                } 
                if(!$error) {
                    //Actualizo Acto juridico
                    $actojuridico = new actojuridico();
                    $_REQUEST['idactojuridico'] = $InscripcionLast;
                    $actojuridico->readEnv();
                    try {
                        $actojuridico->addRecord();
                    }
                    catch (ActoJuridico $e) {
                        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                        $error = true;
                    }
                    if(!$error) {             
                        //Actualizo Matrimonio
                        $repomatrimonio = new reposicionmatrimonio();
                        $_REQUEST['idreposicionmatrimonio'] = $actojuridico->getlastId();
                        //Obtener nombre Inscrito2
                        $_REQUEST['conyuge2nombre'] = $_REQUEST['inscrito2nombre1'].' '.$_REQUEST['inscrito2nombre2'].' '.$_REQUEST['inscrito2apellido1'].' '.$_REQUEST['inscrito2apellido2']; 
                        $_REQUEST['conyuge1nombre'] = $_REQUEST['inscrito1nombre1'].' '.$_REQUEST['inscrito1nombre2'].' '.$_REQUEST['inscrito1apellido1'].' '.$_REQUEST['inscrito1apellido2']; 
                        $repomatrimonio->readEnv();
                        try {
                            $repomatrimonio->addRecord();
                        }
                        catch (RepoMatrimonio $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        } 
			//acciones postriores a la indesrcion de registro
			include_once("__marginacionesresultantes.php");
                        //Actualizo conyugue varon
                        $IdConyugeVaron =  ($_REQUEST['conyuge1cedula'] != '')  ? $persona->getIdByCedula($_REQUEST['conyuge1cedula']) : $persona->getIdByName($_REQUEST['inscrito1nombre1'].' '.$_REQUEST['inscrito1nombre2'].' '.$_REQUEST['inscrito1apellido1'].' '.$_REQUEST['inscrito1apellido2']);
                        if(!$IdConyugeVaron) {
                            //Inserto el Inscrito como persona
                            $_REQUEST['nombre1'] = $_REQUEST['inscrito1nombre1'];  
                            $_REQUEST['nombre1'] = $_REQUEST['inscrito1nombre1'];
                            $_REQUEST['nombre2'] = $_REQUEST['inscrito1nombre2'];
                            $_REQUEST['apellido1'] = $_REQUEST['inscrito1apellido1'];
                            $_REQUEST['apellido2'] = $_REQUEST['inscrito1apellido2'];
                            $_REQUEST['edad'] = $_REQUEST['conyuge1edad'];
                            $_REQUEST['ocupacion'] = $_REQUEST['conyuge1oficio'];
                            $_REQUEST['domicilio'] = $_REQUEST['conyuge1domicilio']; 
                            $_REQUEST['nacionalidad'] = $_REQUEST['conyuge1nacionalidad']; 
                            $_REQUEST['estadocivil'] = $_REQUEST['conyuge1estadocivilanterior'];
                            $_REQUEST['sexo'] = 'm';
                            $conyuge1 = new persona();    
                            $conyuge1->readEnv();
                            $conyuge1->addRecord();
                            if($_REQUEST['conyuge1cedula'] != '') {
                                $conyuge1cuidadano = new ciudadano();
                                $_REQUEST['idciudadano'] = $conyuge1->getlastId();
                                $_REQUEST['cedula'] = $_REQUEST['conyuge1cedula'];
                                $conyuge1cuidadano->readEnv();
                                $conyuge1cuidadano->addRecord();
                            }                        
                        } 
                        //Actualizo conyugue mujer 
                        $IdConyugeMujer =  ($_REQUEST['conyuge2cedula'] != '')  ? $persona->getIdByCedula($_REQUEST['conyuge2cedula']) : $persona->getIdByName($_REQUEST['inscrito1nombre1'].' '.$_REQUEST['inscrito1nombre2'].' '.$_REQUEST['inscrito1apellido1'].' '.$_REQUEST['inscrito1apellido2']);
                        if(!$IdConyugeMujer) {
                            //Inserto el Inscrito como persona
                            $conyuge2 = new persona();
                            $_REQUEST['nombre1'] = $_REQUEST['inscrito2nombre1'];  
                            $_REQUEST['nombre1'] = $_REQUEST['inscrito2nombre1'];
                            $_REQUEST['nombre2'] = $_REQUEST['inscrito2nombre2'];
                            $_REQUEST['apellido1'] = $_REQUEST['inscrito2apellido1'];
                            $_REQUEST['apellido2'] = $_REQUEST['inscrito2apellido2'];
                            $_REQUEST['edad'] = $_REQUEST['conyuge2edad'];
                            $_REQUEST['ocupacion'] = $_REQUEST['conyuge2oficio'];
                            $_REQUEST['domicilio'] = $_REQUEST['conyuge2domicilio']; 
                            $_REQUEST['nacionalidad'] = $_REQUEST['conyuge2nacionalidad']; 
                            $_REQUEST['estadocivil'] = $_REQUEST['conyuge2estadocivilanterior'];
                            $_REQUEST['sexo'] = 'f';   
                            $conyuge2->readEnv();
                            $conyuge2->addRecord();
                            if($_REQUEST['conyuge2cedula'] != '') {
                                $conyuge2cuidadano = new ciudadano();
                                $_REQUEST['idciudadano'] = $conyuge2->getlastId();
                                $_REQUEST['cedula'] = $_REQUEST['conyuge2cedula'];
                                $conyuge2cuidadano->readEnv();
                                $conyuge2cuidadano->addRecord();
                            }                        
                        }                        
                        
                                             
                    }                       
                }    
            }         
        }
        $smarty->assign('notice',(!$error) ? 'La inscripcion fue creada correctamente<br>' . $textmessage : '<b>error:<b> La Inscripcion no se pudo crear' );
        $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
        if(!$error) {
            //Registro el evento
            $evento = new evento();
            $evento->request['tipoevento'] = 'Crear Reposicion de Matrimonio';
            $evento->request['nombreusuario'] = $usuario->request['nombre']; 
            $evento->request['clave'] = $usuario->request['clave'];  
            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
            $evento->request['descripcion'] = 'Se creo una reposicion de matrimonio con tomo '.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio'].' Se hizo el asiento correspondiente'; 
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
    $smarty->assign('urladd','/modulos/inscripciones/addrepomatrimonio.php');
    $smarty->assign('urllistado','/modulos/inscripciones/listarrepomatrimonios.php');
    $smarty->assign('url','/modulos/inscripciones/addrepomatrimonio.php'); 
    $smarty->assign('fechainscripcion',date('Y-m-d H:m'));
    $smarty->assign('fechadictament',date('Y-m-d H:m'));
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
    $smarty->assign('titular','Reposicion de matrimonio');   
    $smarty->assign('camino','>> Inscripciones >> Reposicion Matrimonio >> Nueva');  
    $smarty->display('layout.tpl'); 
} else {
    header("Location: ./login.php");
}     
?>
