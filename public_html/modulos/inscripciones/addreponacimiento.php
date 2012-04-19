<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    $libroregistral = new libroregistral();
    $libroregistralbd = $libroregistral->getLibroByRubro('Reposicion Nacimiento');
    $smarty->assign('template','inscripciones/reponacimiento.tpl');
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
    //Si vienen Variables por Post
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
            $_REQUEST['tipoinscripcion'] =  'Reposicion Nacimiento';
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
                $arrayPersonas = array('compareciente1','compareciente2','madre','padre');
                $_REQUEST['madrecedula'] = $_REQUEST['cedulamadre'];
                $_REQUEST['padrecedula'] = $_REQUEST['cedulapadre'];  
                $_REQUEST['madrenombre'] = $_REQUEST['nombremadre'];
                //Actualizo Persona asociadas a la inscripcion
                foreach($arrayPersonas as $valor) {
                    $persona = new persona();
                    $Id = ($_REQUEST[$valor.'cedula'] != '')  ? $persona->getIdByCedula($_REQUEST[$valor.'cedula']) : $persona->getIdByName($_REQUEST[$valor.'nombre']);
                    if($Id) {
                        $participacion = new participacionTable();
                        $_REQUEST['idinscripcion'] = $InscripcionLast;
                        $_REQUEST['idpersona'] = $Id; 
                        switch($valor) {
                            case 'compareciente1':
                            case 'compareciente2':
                               $forma = 'Compareciente';
                            break; 
                            case 'madre':
                            case 'padre':
                               $forma = 'Padre';
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
                    //Actualizo Repocicion Hecho vital
                    $repohechovital = new reposicionhechovital();
                    $_REQUEST['idreposicionhechovital'] = $InscripcionLast;
                    $repohechovital->readEnv();
                    try {
                        $repohechovital->addRecord();
                    }
                    catch (RepoHechoVital $e) {
                        $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                        $error = true;
                    }   
                    if(!$error) {             
                        //Actualizo Nacimiento
                        $reponacimiento = new reposicionnacimiento();
                        $_REQUEST['idreposicionnacimiento'] = $repohechovital->getlastId();
                        $reponacimiento->readEnv();
                        try {
                            $reponacimiento->addRecord();
                        }
                        catch (RepoNacimiento $e) {
                            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                            $error = true;
                        }  
                        //Actualizo el Inscrito
                        $IdInscrito =  $persona->getIdByName($_REQUEST['inscrito1nombre1'].' '.$_REQUEST['inscrito1nombre2'].' '.$_REQUEST['inscrito1apellido1'].' '.$_REQUEST['inscrito1apellido2']);
                        if(!$IdInscrito) {
                            //Inserto el Inscrito como persona
                            $inscrito = new persona();
                            $_REQUEST['nombre1'] = $_REQUEST['inscrito1nombre1'];
                            $_REQUEST['nombre2'] = $_REQUEST['inscrito1nombre2'];
                            $_REQUEST['apellido1'] = $_REQUEST['inscrito1apellido1'];
                            $_REQUEST['apellido2'] = $_REQUEST['inscrito1apellido2'];
                            $_REQUEST['ocupacion'] = $_REQUEST[$valor.'oficio'];
                            $_REQUEST['domicilio'] = $_REQUEST[$valor.'domicilio']; 
                            $_REQUEST['nacionalidad'] = $_REQUEST[$valor.'nacionalidad']; 
                            $_REQUEST['estadocivil'] = 'soltero'; 
                            $_REQUEST['sexo'] = $_REQUEST['sexoinscrito'];   
                            $_REQUEST['edad'] = $persona->getEdad();
                            $inscrito->readEnv();
                            $inscrito->addRecord();                        
                        }                          
                    }
                }
            }   
        }
        $smarty->assign('notice',(!$error) ? 'La reposicion de la inscripcion fue creada correctamente' : '<b>error:<b> La Inscripcion no se pudo crear');
        $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
        if(!$error) {
            //Registro el evento
            $evento = new evento();
            $evento->request['tipoevento'] = 'Crear Reposicion de Nacimiento';
            $evento->request['nombreusuario'] = $usuario->request['nombre']; 
            $evento->request['clave'] = $usuario->request['clave'];  
            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
            $evento->request['descripcion'] = 'Se creo una reposicion de nacimiento con tomo'.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio'].' Se hizo el asiento correspondiente'; 
            $evento->request['fechaocurrencia'] = date('Y-m-d');
            $evento->addRecord();
        }
                   
    }  
    $smarty->assign('Municipio',$perfilbd->getParametro('Municipio')); 
    $smarty->assign('Provincia',$perfilbd->getParametro('Provincia'));
    $smarty->assign('Departamento',$perfilbd->getParametro('Departamento'));   
    $smarty->assign('Pais',$perfilbd->getParametro('Pais'));  
    $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
    $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
    $smarty->assign('url','/modulos/inscripciones/addreponacimiento');
    $smarty->assign('fechainscripcion',date('Y-m-d H:m'));
    $smarty->assign('fechanacimiento',date('Y-m-d H:m'));
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
    $smarty->assign('camino','>> Inscripciones >> Reposicion Nacimiento >> Nueva');  
    $smarty->display('layout.tpl'); 
} else {
    header("Location: ./login.php");
}     
?>
